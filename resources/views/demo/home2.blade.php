@extends('layouts.themeNew')

@section('content')
 <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        table { border-collapse: collapse; }
        th, td { border: 1px solid #e5e7eb; }
        .dark th, .dark td { border: 1px solid #374151; }
    </style>
    <div class="flex flex-col min-h-screen">
        <!-- <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">school</span>
                    </div>
                    <h2 class="text-xl font-bold">UniClassroom</h2>
                </div>
                <div class="flex items-center gap-4">
                    <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full relative">
                        <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">notifications</span>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-purple-500"></div>
                </div>
            </div>
        </div> -->

        <div class="flex-1 max-w-7xl mx-auto w-full px-4 py-6 space-y-6">
            <div class="flex justify-between items-start border-b border-gray-200 dark:border-gray-700 pb-4">
                <div>
                    <h1 class="text-3xl font-bold mb-2">ตารางการใช้ห้องเรียน</h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">ตรวจสอบสถานะรายชั่วโมงและจองห้องเรียนสำหรับกิจกรรม</p>
                </div>
                <div class="flex gap-2">
                    <div class="flex items-center gap-2 px-3 py-1 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        <span class="text-xs font-medium text-green-700 dark:text-green-400">ว่าง (ชี้เพื่อจอง)</span>
                    </div>
                    <div class="flex items-center gap-2 px-3 py-1 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
                        <div class="w-2 h-2 rounded-full bg-red-500"></div>
                        <span class="text-xs font-medium text-red-700 dark:text-red-400">ไม่ว่าง</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex gap-4 mb-4">
                    <!-- <div class="flex-1">
                        <label class="block text-sm font-medium mb-2">เลือกอาคาร</label>
                        <select id="building" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 h-11 px-4">
                            <option>อาคารเทคโนโลยีสารสนเทศ (IT)</option>
                            <option>อาคารเรียนรวม 1</option>
                        </select>
                    </div> -->
                    <div class="flex-1">
                        <label class="block text-sm font-medium mb-2">เลือกวันที่</label>
                        <input id="date" type="date" value="2023-10-27" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 h-11 px-4"/>
                    </div>
                    <div class="flex items-end">
                        <button onclick="searchRooms()" class="h-11 px-6 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center gap-2">
                            <span class="material-symbols-outlined">search</span> ค้นหา
                        </button>
                    </div>
                </div>
                <div class="flex gap-2 pt-2 border-t border-gray-200 dark:border-gray-700">
                    <span class="text-sm text-gray-600 dark:text-gray-400 self-center mr-2">ชั้น:</span>
                    <button onclick="filterFloor('all')" id="floor-all" class="px-4 py-1.5 rounded-full bg-blue-600 text-white text-xs font-medium">ทั้งหมด</button>
                    <button onclick="filterFloor('4')" id="floor-4" class="px-4 py-1.5 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs font-medium">ชั้น 4</button>
                    <button onclick="filterFloor('5')" id="floor-5" class="px-4 py-1.5 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs font-medium">ชั้น 5</button>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <div class="min-w-[1400px]"> <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th class="p-6 text-sm font-semibold text-left sticky left-0 bg-gray-50 dark:bg-gray-900 z-10 w-56 border">ห้องเรียน</th>
                                    <script>
                                        const times = ["07:30-08:30", "08:30-09:30", "09:30-10:30", "10:30-11:30", "11:30-12:30", "12:30-13:30", "13:30-14:30", "14:30-15:30", "15:30-16:30", "16:30-17:30", "17:30-18:30", "18:30-20:30", "20:30-21:30", "21:30-22:30", "22:30-23:30", "23:30-00:30", "00:30-01:30"];
                                        times.forEach((t, i) => {
                                            document.write(`
                                                <th class="p-3 text-xs font-semibold text-center text-gray-600 dark:text-gray-400 min-w-[100px]">
                                                    <div class="mb-1">${i+1}</div>
                                                    <div class="text-[10px] font-normal opacity-70">${t}</div>
                                                </th>
                                            `);
                                        });
                                    </script>
                                </tr>
                            </thead>
                            <tbody id="roomTable" class="bg-white dark:bg-gray-800">
                                </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex justify-between items-center px-4 py-3 border-t border-gray-200 dark:border-gray-700">
                    <span class="text-sm text-gray-600 dark:text-gray-400">แสดง <span id="roomCount">0</span> ห้อง</span>
                </div>

                <div id="bookingSummary" class="hidden p-4 bg-blue-50 dark:bg-blue-900/20 border-t border-blue-200 dark:border-blue-800 flex justify-between items-center">
                    <div>
                        <span class="text-sm font-semibold">รายการที่เลือก: <span id="selectedCount">0</span> ช่วงเวลา</span>
                        <div id="selectedList" class="text-xs text-gray-600 dark:text-gray-400 mt-1"></div>
                    </div>
                    <button onclick="confirmBooking()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center gap-2">
                        ดำเนินการจอง <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const timeSlots = [
            { period: 1, start: "07:30", end: "08:30" }, { period: 2, start: "08:30", end: "09:30" },
            { period: 3, start: "09:30", end: "10:30" }, { period: 4, start: "10:30", end: "11:30" },
            { period: 5, start: "11:30", end: "12:30" }, { period: 6, start: "12:30", end: "13:30" },
            { period: 7, start: "13:30", end: "14:30" }, { period: 8, start: "14:30", end: "15:30" },
            { period: 9, start: "15:30", end: "16:30" }, { period: 10, start: "16:30", end: "17:30" },
            { period: 11, start: "17:30", end: "18:30" }, { period: 12, start: "18:30", end: "20:30" },
            { period: 13, start: "20:30", end: "21:30" }, { period: 14, start: "21:30", end: "22:30" },
            { period: 15, start: "22:30", end: "23:30" }, { period: 16, start: "23:30", end: "00:30" },
            { period: 17, start: "00:30", end: "01:30" }
        ];

        const roomData = [
            { floor: 4, name: "IT 401", type: "Lab Computer", capacity: 40, schedule: [
                { period: 1, status: "available" },
                { period: 2, status: "occupied", subject: "INT101 Programming I", teacher: "อ.สมชาย วงศ์ใหญ่", span: 3 },
                { period: 5, status: "available" }, { period: 6, status: "available" },
                { period: 7, status: "occupied", subject: "INT202 Network", teacher: "อ.วิชัย ศรีสุข", span: 2 },
                { period: 9, status: "available" }, { period: 10, status: "available" }, { period: 11, status: "available" },
                { period: 12, status: "available" }, { period: 13, status: "available" }, { period: 14, status: "available" },
                { period: 15, status: "available" }, { period: 16, status: "available" }, { period: 17, status: "available" }
            ]},
            { floor: 4, name: "IT 402", type: "Lab Computer", capacity: 40, schedule: Array.from({length: 17}, (_, i) => ({ period: i + 1, status: "available" })) },
            { floor: 5, name: "IT 501", type: "Lab Computer", capacity: 45, schedule: [
                { period: 1, status: "occupied", subject: "INT301 Database", teacher: "อ.ประภา แสงทอง", span: 2 },
                { period: 3, status: "available" }, { period: 4, status: "available" },
                { period: 5, status: "occupied", subject: "Research Seminar", teacher: "ดร.มานะ", span: 4 }
            ]}
        ];

        let currentFloor = 'all';
        let selectedSlots = [];

        function renderTable() {
            const tbody = document.getElementById('roomTable');
            tbody.innerHTML = '';
            
            const filteredRooms = currentFloor === 'all' ? roomData : roomData.filter(room => room.floor === parseInt(currentFloor));
            document.getElementById('roomCount').textContent = filteredRooms.length;
            
            filteredRooms.forEach(room => {
                const tr = document.createElement('tr');
                tr.className = 'h-32 transition-colors'; // เพิ่มความสูงช่อง
                
                // Room info cell
                const roomCell = document.createElement('td');
                roomCell.className = 'p-6 sticky left-0 bg-white dark:bg-gray-800 z-10 border-r-2 shadow-[2px_0_5px_rgba(0,0,0,0.05)]';
                roomCell.innerHTML = `
                    <div class="flex flex-col">
                        <span class="font-bold text-xl text-blue-600 dark:text-blue-400">${room.name}</span>
                        <span class="text-xs font-medium text-gray-500 uppercase mt-1">${room.type}</span>
                        <div class="flex items-center gap-1 mt-2 text-gray-400">
                            <span class="material-symbols-outlined text-sm">groups</span>
                            <span class="text-xs">${room.capacity}</span>
                        </div>
                    </div>
                `;
                tr.appendChild(roomCell);
                
                // Schedule cells
                let skipNext = 0;
                // สร้างให้ครบ 17 คาบตามหัวตาราง
                for(let i=1; i<=17; i++) {
                    if (skipNext > 0) { skipNext--; continue; }

                    const slot = room.schedule.find(s => s.period === i) || { status: 'available', period: i };
                    const td = document.createElement('td');
                    td.className = 'p-2 align-middle'; // เพิ่ม padding ในช่อง
                    
                    if (slot.span) {
                        td.setAttribute('colspan', slot.span);
                        skipNext = slot.span - 1;
                    }
                    
                    if (slot.status === 'available') {
                        const slotId = `${room.name}-P${i}`;
                        const isSelected = selectedSlots.includes(slotId);
                        
                        td.innerHTML = `
                            <button onclick="toggleSlot('${slotId}', '${room.name}', ${i})" 
                                    class="group w-full h-24 rounded-lg flex items-center justify-center transition-all duration-200
                                    ${isSelected 
                                        ? 'bg-blue-500 text-white shadow-lg shadow-blue-200 dark:shadow-none font-bold' 
                                        : ' dark:bg-green-900/10 hover:bg-green-500 hover:text-white dark:hover:bg-green-600'}">
                                <span class="${isSelected ? 'opacity-100' : 'opacity-0 group-hover:opacity-100'}">
                                    ${isSelected ? '✓ จองแล้ว' : 'จอง'}
                                </span>
                            </button>
                        `;
                    } else {
                        td.innerHTML = `
                            <div class="w-full h-24 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800/50 p-3 flex flex-col justify-center overflow-hidden">
                                <span class="text-xs font-bold text-red-700 dark:text-red-400 leading-tight mb-1">${slot.subject}</span>
                                <span class="text-[10px] text-red-600/70 dark:text-red-400/60 truncate">${slot.teacher}</span>
                            </div>
                        `;
                    }
                    tr.appendChild(td);
                }
                tbody.appendChild(tr);
            });
        }

        function toggleSlot(slotId) {
            const index = selectedSlots.indexOf(slotId);
            if (index > -1) selectedSlots.splice(index, 1);
            else selectedSlots.push(slotId);
            updateBookingSummary();
            renderTable();
        }

        function updateBookingSummary() {
            const summary = document.getElementById('bookingSummary');
            if (selectedSlots.length > 0) {
                summary.classList.remove('hidden');
                document.getElementById('selectedCount').textContent = selectedSlots.length;
                document.getElementById('selectedList').textContent = selectedSlots.join(', ');
            } else {
                summary.classList.add('hidden');
            }
        }

        function filterFloor(floor) {
            currentFloor = floor;
            ['all', '4', '5'].forEach(f => {
                const btn = document.getElementById(`floor-${f}`);
                if(!btn) return;
                btn.className = f === floor 
                    ? 'px-4 py-1.5 rounded-full bg-blue-600 text-white text-xs font-medium' 
                    : 'px-4 py-1.5 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs font-medium hover:bg-gray-300';
            });
            renderTable();
        }

        function confirmBooking() {
            alert('จองสำเร็จ: ' + selectedSlots.join('\n'));
            selectedSlots = [];
            updateBookingSummary();
            renderTable();
        }

        // Initial render
        renderTable();
    </script>
@endsection