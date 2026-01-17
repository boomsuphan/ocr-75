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
        <div class="flex-1 max-w-7xl mx-auto w-full px-4 py-6 space-y-6">
            
            <!-- Room Header -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-3xl">meeting_room</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white" id="roomName">IT 401</h1>
                        <div class="flex items-center gap-4 mt-2">
                            <span class="text-sm text-gray-600 dark:text-gray-400" id="roomType">Lab Computer</span>
                            <div class="flex items-center gap-1 text-gray-500">
                                <span class="material-symbols-outlined text-sm">groups</span>
                                <span class="text-sm" id="roomCapacity">40 ที่นั่ง</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Schedule Table -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <div class="min-w-[1400px]">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th class="p-4 text-sm font-semibold text-left w-32 border">คาบ</th>
                                    <script>
                                        const times = ["07:30-08:30", "08:30-09:30", "09:30-10:30", "10:30-11:30", "11:30-12:30", "12:30-13:30", "13:30-14:30", "14:30-15:30", "15:30-16:30", "16:30-17:30", "17:30-18:30", "18:30-20:30", "20:30-21:30", "21:30-22:30", "22:30-23:30", "23:30-00:30", "00:30-01:30"];
                                        times.forEach((t, i) => {
                                            document.write(`
                                                <th class="p-3 text-xs font-semibold text-center text-gray-600 dark:text-gray-400 min-w-[100px]">
                                                    <div class="mb-1">คาบ ${i+1}</div>
                                                    <div class="text-[10px] font-normal opacity-70">${t}</div>
                                                </th>
                                            `);
                                        });
                                    </script>
                                </tr>
                            </thead>
                            <tbody id="scheduleTable" class="bg-white dark:bg-gray-800">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Legend -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <div class="flex items-center gap-6">
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">สัญลักษณ์:</span>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded bg-green-100 dark:bg-green-900/30 border border-green-300"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">ว่าง</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded bg-red-50 dark:bg-red-900/20 border border-red-300"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">มีการใช้งาน</span>
                    </div>
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

        // ข้อมูลห้อง (สามารถแก้ไขได้ตามต้องการ)
        const roomData = {
            name: "IT 401",
            type: "Lab Computer",
            capacity: 40,
            schedule: [
                { period: 1, status: "available" },
                { period: 2, status: "occupied", subject: "INT101 Programming I", teacher: "อ.สมชาย วงศ์ใหญ่", span: 3 },
                { period: 5, status: "available" },
                { period: 6, status: "available" },
                { period: 7, status: "occupied", subject: "INT202 Network", teacher: "อ.วิชัย ศรีสุข", span: 2 },
                { period: 9, status: "available" },
                { period: 10, status: "available" },
                { period: 11, status: "available" },
                { period: 12, status: "available" },
                { period: 13, status: "available" },
                { period: 14, status: "available" },
                { period: 15, status: "available" },
                { period: 16, status: "available" },
                { period: 17, status: "available" }
            ]
        };

        function renderSchedule() {
            // Update room info
            document.getElementById('roomName').textContent = roomData.name;
            document.getElementById('roomType').textContent = roomData.type;
            document.getElementById('roomCapacity').textContent = roomData.capacity + ' ที่นั่ง';

            // Render schedule table
            const tbody = document.getElementById('scheduleTable');
            const tr = document.createElement('tr');
            tr.className = 'h-32';
            
            // Period label cell
            const labelCell = document.createElement('td');
            labelCell.className = 'p-4 bg-gray-50 dark:bg-gray-900 font-medium text-center';
            labelCell.textContent = 'สถานะ';
            tr.appendChild(labelCell);
            
            // Schedule cells
            let skipNext = 0;
            for(let i = 1; i <= 17; i++) {
                if (skipNext > 0) {
                    skipNext--;
                    continue;
                }

                const slot = roomData.schedule.find(s => s.period === i) || { status: 'available', period: i };
                const td = document.createElement('td');
                td.className = 'p-2 align-middle';
                
                if (slot.span) {
                    td.setAttribute('colspan', slot.span);
                    skipNext = slot.span - 1;
                }
                
                if (slot.status === 'available') {
                    td.innerHTML = `
                        <div class="w-full h-24 rounded-lg dark:bg-green-900/30 flex items-center justify-center">
                            <span class="text-sm font-medium text-gray-300">ว่าง</span>
                        </div>
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
        }

        // Initial render
        renderSchedule();
    </script>
@endsection