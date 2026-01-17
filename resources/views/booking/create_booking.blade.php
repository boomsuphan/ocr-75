@extends('layouts.themeNew')

@section('content')
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    table {
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #e5e7eb;
    }

    .dark th,
    .dark td {
        border: 1px solid #374151;
    }
</style>
<main class="flex-1 w-full max-w-5xl mx-auto px-4 py-8 md:px-8 md:py-12 flex flex-col gap-8">

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div class="flex flex-col gap-2">
            <h2 class="text-3xl md:text-4xl font-bold text-text-main dark:text-white tracking-tight">หน้ากรอกข้อมูลการจองห้องเรียน</h2>
            <p class="text-text-muted text-base md:text-lg max-w-2xl">
                กรุณากรอกรายละเอียดสำหรับการจองห้องเรียนระบบคอมพิวเตอร์ ({{$rooms->name}})
            </p>
        </div>
        <div class="hidden md:block">
            <span class="inline-flex items-center rounded-full bg-green-50 dark:bg-green-900/20 px-3 py-1 text-xs font-medium text-green-700 dark:text-green-400 ring-1 ring-inset ring-green-600/20">
                {{ 'ภาคการศึกษา' }} : {{ $currentSemester->name ?? 'ไม่อยู่ในช่วงภาคการศึกษา' }}
            </span>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
        <!-- Left Column: Booking Form -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            <form method="POST" action="{{ url('/booking') }}" accept-charset="UTF-8" enctype="multipart/form-data" class="bg-white dark:bg-surface-dark rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] dark:shadow-none border border-border-light dark:border-border-dark p-6 md:p-8">
                {{ csrf_field() }}
                <div class=" hidden">
                    <label for="room_id" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Room Id' }}</label>
                    <input class="w-full h-10 px-3 rounded-lg border {{ $errors->has('room_id') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all read-only:bg-gray-100"
                        name="room_id" type="text" id="room_id" value="{{ $rooms->id }}" readonly required>
                    {!! $errors->first('room_id', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}


                    <label for="user_id" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'User Id' }}</label>
                    <input class="w-full h-10 px-3 rounded-lg border {{ $errors->has('user_id') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all read-only:bg-gray-100"
                        name="user_id" type="text" id="user_id" value="{{ Auth::user()->id }}" readonly>
                    {!! $errors->first('user_id', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
                </div>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-text-main dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">edit_calendar</span>
                        Booking Details
                    </h3>
                    <div class="text-sm text-text-muted bg-background-light dark:bg-background-dark px-3 py-1 rounded-full border border-border-light dark:border-border-dark">
                        Room: {{$rooms->name}}
                    </div>
                </div>
                @if ($errors->any())
                <div class="rounded-lg bg-red-50 dark:bg-red-900/20 p-4 mb-8 border border-red-200 dark:border-red-800">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-red-600 dark:text-red-400 mt-0.5">error</span>
                        <div>
                            <h3 class="text-sm font-bold text-red-800 dark:text-red-300 mb-1">เกิดข้อผิดพลาด</h3>
                            <ul class="list-disc list-inside text-sm text-red-700 dark:text-red-200 space-y-1">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Instructor Name -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-text-main dark:text-white">
                            ชื่ออาจารย์ผู้สอน <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-muted text-lg">person</span>
                            <input class="w-full pl-10 pr-4 py-3 bg-white dark:bg-background-dark border border-border-light dark:border-border-dark rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-text-main dark:text-white placeholder-text-muted/50 transition-all text-sm {{ $errors->has('name_professor') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }}"
                                name="name_professor" type="text" id="name_professor" value="{{ isset($booking->name_professor) ? $booking->name_professor : ''}}" placeholder="ระบุชื่ออาจารย์" required>
                            {!! $errors->first('name_professor', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
                        </div>
                    </div>
                    <!-- Subject -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-text-main dark:text-white">
                            ชื่อวิชา <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-muted text-lg">book</span>
                            <input class="{{ $errors->has('subject') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} w-full pl-10 pr-4 py-3 bg-white dark:bg-background-dark border border-border-light dark:border-border-dark rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-text-main dark:text-white placeholder-text-muted/50 transition-all text-sm" placeholder="ระบุชื่อวิชา" name="subject" type="text" id="subject" value="{{ isset($booking->subject) ? $booking->subject : ''}}" required>
                            {!! $errors->first('subject', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}

                        </div>
                    </div>


                    @php
                    // กำหนดช่วงเวลา
                    $timeSlots = [
                    '07:30', '08:30', '09:30', '10:30', '11:30', '12:30',
                    '13:30', '14:30', '15:30', '16:30', '17:30', '18:30',
                    '20:30', '21:30', '22:30', '23:30', '00:30', '01:30'
                    ];
                    @endphp
                    <!-- Date Selection -->
                    <div class="flex flex-col gap-2 md:col-span-2">
                        <label class="text-sm font-semibold text-text-main dark:text-white">
                            วันที่ต้องการจอง <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-muted text-lg">calendar_today</span>

                            <input class="w-full pl-10 pr-4 py-3 bg-white dark:bg-background-dark border border-border-light dark:border-border-dark rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-text-main dark:text-white placeholder-text-muted/50 transition-all text-sm cursor-pointer {{ $errors->has('date_booking') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }}"
                                name="date_booking" type="date" id="date_booking"
                                onclick="this.showPicker()"
                                value="{{ old('date_booking', isset($booking->date_booking) ? $booking->date_booking : '') }}" required>
                            {!! $errors->first('date_booking', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
                        </div>
                    </div>
                    <!-- Time Start -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-text-main dark:text-white">
                            เวลาเริ่ม (Start) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-muted text-lg">schedule</span>

                            <select name="time_start_booking" id="time_start_booking"
                                class=" {{ $errors->has('time_start_booking') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} w-full pl-10 pr-10 py-3 bg-white dark:bg-background-dark border border-border-light dark:border-border-dark rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-text-main dark:text-white appearance-none cursor-pointer text-sm " required>
                                <option value="" disabled selected>เริ่ม</option>
                                @foreach($timeSlots as $time)
                                @if(!$loop->last)
                                <option value="{{ $time }}" {{ old('time_start_booking', isset($booking->time_start_booking) ? $booking->time_start_booking : '') == $time ? 'selected' : '' }}>
                                    {{ $time }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                            <div class="w-full">{!! $errors->first('time_start_booking', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}</div>

                        </div>
                    </div>
                    <!-- Time End -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-text-main dark:text-white">
                            เวลาสิ้นสุด (End) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-muted text-lg">schedule</span>

                            <select name="time_end_booking" id="time_end_booking" disabled
                                class="disabled:bg-gray-100 disabled:cursor-not-allowed cursor-pointer {{ $errors->has('time_end_booking') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} w-full pl-10 pr-10 py-3 bg-white dark:bg-background-dark border border-border-light dark:border-border-dark rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-text-main dark:text-white appearance-none cursor-pointer text-sm" required>
                                <option value="" disabled selected>สิ้นสุด</option>
                                @foreach($timeSlots as $time)
                                @if(!$loop->first)
                                <option value="{{ $time }}" {{ old('time_end_booking', isset($booking->time_end_booking) ? $booking->time_end_booking : '') == $time ? 'selected' : '' }}>
                                    {{ $time }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                            <div class="w-full pl-6">{!! $errors->first('time_end_booking', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}</div>
                        </div>
                    </div>
                    <!-- Details -->
                    <div class="flex flex-col gap-2 md:col-span-2">
                        <label class="text-sm font-semibold text-text-main dark:text-white">
                            รายละเอียดการใช้ห้อง
                        </label>

                        <textarea
                            class="w-full p-4 bg-white dark:bg-background-dark border border-border-light dark:border-border-dark rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-text-main dark:text-white placeholder-text-muted/50 transition-all text-sm resize-none h-28 {{ $errors->has('note') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} "
                            name="note"
                            id="note"
                            rows="3"
                            required placeholder="เช่น ใช้สำหรับการเรียนการสอน, สอบกลางภาค...">{{ isset($booking->note) ? $booking->note : '' }}</textarea>

                        {!! $errors->first('note', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
                    </div>
                </div>
                <!-- Actions -->
                <div class="flex flex-col justify-end sm:flex-row gap-3 mt-8 pt-6 border-t border-border-light dark:border-border-dark">

                    <button class="flex-1 sm:flex-none px-8 py-3 bg-primary hover:bg-primary-dark text-white rounded-lg font-medium shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2" type="submit">
                        <span class="material-symbols-outlined text-xl">save</span>
                        ยืนยันการจอง (Confirm)
                    </button>
                </div>
            </form>

            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-bold text-text-main dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">calendar_view_day</span>
                        สถานะการจอง (Timeline)
                    </h3>
                </div>

                <div class="flex items-center justify-between mb-4 bg-blue-50 dark:bg-blue-900/20 px-4 py-2 rounded-lg border border-blue-100 dark:border-blue-800">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-xl">event_available</span>
                        <span class="text-sm text-gray-600 dark:text-gray-300">ข้อมูลการจองวันที่:</span>
                        <span id="timelineDateDisplay" class="text-base font-bold text-primary dark:text-blue-300">
                            ...
                        </span>
                    </div>
                    
                    <div class="flex items-center gap-2 text-xs">
                        <div class="w-3 h-3 rounded bg-red-100 border border-red-200 dark:bg-red-900/30 dark:border-red-800"></div>
                        <span class="text-red-600 dark:text-red-400">ไม่ว่าง</span>
                    </div>
                </div>
                
                <div id="scheduleGrid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-3">
                    <div class="col-span-full text-center py-8 text-gray-400">
                        กำลังโหลดข้อมูล...
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<script>
    // --- Global Variables ---
    let allBookings = [];
    let dailyBookings = [];
    
    // รับค่า Time Slots จาก PHP
    const timeSlotsPHP = @json($timeSlots);
    
    // Mapping เวลาสำหรับคำนวณ Timeline และ Label
    const timeLabels = [
        "07:30-08:30", "08:30-09:30", "09:30-10:30", "10:30-11:30", 
        "11:30-12:30", "12:30-13:30", "13:30-14:30", "14:30-15:30", 
        "15:30-16:30", "16:30-17:30", "17:30-18:30", "18:30-20:30", 
        "20:30-21:30", "21:30-22:30", "22:30-23:30", "23:30-00:30", 
        "00:30-01:30"
    ];

    // --- Initialization ---
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date_booking');
        const startSelect = document.getElementById('time_start_booking');
        const endSelect = document.getElementById('time_end_booking');
        const roomId = document.getElementById("room_id").value;

        // 1. ตั้งค่าวันที่เริ่มต้น และ ห้ามเลือกย้อนหลัง
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
        
        if (!dateInput.value) {
            dateInput.value = today;
        }

        // 2. แสดงวันที่ไทยครั้งแรก
        updateTimelineDateDisplay(dateInput.value);

        // 3. โหลดข้อมูล API
        fetchBookings(roomId);

        // --- Event Listeners ---
        
        // เมื่อเปลี่ยนวันที่
        dateInput.addEventListener('change', function() {
            filterBookingsByDate(this.value);
            updateTimelineDateDisplay(this.value); // อัปเดตวันที่ไทย

            // รีเซ็ต Dropdown
            startSelect.value = "";
            endSelect.value = "";
            endSelect.disabled = true;
            updateStartOptions(); 
        });

        // เมื่อเลือกเวลาเริ่ม
        startSelect.addEventListener('change', function() {
            updateEndOptions();
        });
    });

    // --- Core Functions ---

    function fetchBookings(roomId) {
        fetch("{{ url('/') }}/api/get_data_create_booking/" + roomId)
        .then(response => response.json())
        .then(result => {
            allBookings = Array.isArray(result) ? result : [result];
            const dateInput = document.getElementById('date_booking');
            // กรองข้อมูลทันทีที่โหลดเสร็จ
            filterBookingsByDate(dateInput.value);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            renderSchedule([]);
        });
    }

    function filterBookingsByDate(selectedDate) {
        // กรองเฉพาะของวันที่เลือก
        dailyBookings = allBookings.filter(b => b.date_booking === selectedDate);
        
        // วาด Timeline ใหม่
        renderSchedule(dailyBookings);
        
        // อัปเดต Dropdown เวลาเริ่ม
        updateStartOptions();
    }

    function updateTimelineDateDisplay(dateStr) {
        const displayElement = document.getElementById('timelineDateDisplay');
        if (!displayElement) return;

        if (!dateStr) {
            displayElement.textContent = "-";
            return;
        }

        const parts = dateStr.split('-');
        const year = parseInt(parts[0]) + 543;
        const month = parseInt(parts[1]);
        const day = parseInt(parts[2]);

        const thaiMonths = [
            "", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
            "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
        ];

        displayElement.textContent = `${day} ${thaiMonths[month]} ${year}`;
    }

    // --- Grid Rendering Function (Timeline) ---
    function renderSchedule(schedule) {
        const gridContainer = document.getElementById('scheduleGrid');
        gridContainer.innerHTML = ''; 
        
        for (let i = 1; i <= 17; i++) {
            let slotStatus = 'available';
            let bookingData = null;

            // ตรวจสอบสถานะว่าง/ไม่ว่าง จาก dailyBookings
            if (typeof dailyBookings !== 'undefined') {
                 const timeStr = timeLabels[i-1].split('-')[0];
                 const timeMin = timeToMinutes(timeStr);
                 
                 const busyBooking = dailyBookings.find(b => {
                     const start = timeToMinutes(b.time_start_booking);
                     const end = timeToMinutes(b.time_end_booking);
                     return timeMin >= start && timeMin < end;
                 });

                 if (busyBooking) {
                     slotStatus = 'occupied';
                     bookingData = {
                         subject: busyBooking.subject,
                         teacher: busyBooking.name_professor,
                         note: busyBooking.note
                     };
                 }
            }

            // สร้าง Card
            const card = document.createElement('div');
            const timeLabel = timeLabels[i-1];

            if (slotStatus === 'available') {
                // Card ว่าง
                card.className = "flex flex-col items-center justify-center p-3 rounded-lg border border-gray-200 bg-gray-50 dark:bg-gray-800/50 dark:border-gray-700 text-center min-h-[80px]";
                card.innerHTML = `
                    <span class="text-xs font-medium text-gray-400 dark:text-gray-500 mb-1">คาบ ${i}</span>
                    <span class="text-xs text-gray-400 dark:text-gray-500 font-mono">${timeLabel}</span>
                `;
            } else {
                // Card ไม่ว่าง
                card.className = "flex flex-col justify-center p-3 rounded-lg border border-red-200 bg-red-50 dark:bg-red-900/20 dark:border-red-800 text-center min-h-[80px] shadow-sm relative overflow-hidden group";
                
                const subject = 'ไม่ว่าง';
                
                card.innerHTML = `
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-red-400"></div>
                    <span class="text-xs text-red-400 dark:text-red-300 mb-1 font-mono">${timeLabel}</span>
                    <span class="text-sm font-bold text-red-700 dark:text-red-200 truncate w-full px-1">${subject}</span>
                `;
            }
            gridContainer.appendChild(card);
        }
    }

    // --- Dropdown Logic ---

    function isTimeOccupied(timeStr) {
        const checkTime = timeToMinutes(timeStr);
        return dailyBookings.some(booking => {
            const start = timeToMinutes(booking.time_start_booking);
            const end = timeToMinutes(booking.time_end_booking);
            return checkTime >= start && checkTime < end;
        });
    }

    function updateStartOptions() {
        const startSelect = document.getElementById('time_start_booking');
        const options = startSelect.options;
        for (let i = 0; i < options.length; i++) {
            const timeVal = options[i].value;
            if (timeVal) {
                if (isTimeOccupied(timeVal)) {
                    options[i].disabled = true;
                    options[i].classList.add('text-gray-300', 'bg-gray-100');
                    options[i].textContent = timeVal + " (ไม่ว่าง)";
                } else {
                    options[i].disabled = false;
                    options[i].classList.remove('text-gray-300', 'bg-gray-100');
                    options[i].textContent = timeVal;
                }
            }
        }
    }

    function updateEndOptions() {
        const startSelect = document.getElementById('time_start_booking');
        const endSelect = document.getElementById('time_end_booking');
        
        // Reset
        endSelect.value = "";
        
        if (!startSelect.value) {
            endSelect.disabled = true;
            return;
        }

        endSelect.disabled = false;
        const startTimeVal = startSelect.value;
        const startMinutes = timeToMinutes(startTimeVal);
        let nextBookingStartMinutes = 99999;

        // หาเวลาเริ่มของการจองถัดไป (เพื่อไม่ให้จองคร่อม)
        dailyBookings.forEach(booking => {
            const bStart = timeToMinutes(booking.time_start_booking);
            if (bStart > startMinutes) {
                if (bStart < nextBookingStartMinutes) {
                    nextBookingStartMinutes = bStart;
                }
            }
        });

        const options = endSelect.options;
        for (let i = 0; i < options.length; i++) {
            const timeVal = options[i].value;
            if (!timeVal) continue;

            const endMinutes = timeToMinutes(timeVal);
            const endIndex = timeSlotsPHP.indexOf(timeVal);
            const startIndex = timeSlotsPHP.indexOf(startTimeVal);
            let isDisabled = false;

            if (endIndex <= startIndex) {
                isDisabled = true; // จบก่อนเริ่ม
            } else if (endMinutes > nextBookingStartMinutes) {
                isDisabled = true; // จองคร่อมคนอื่น
            } else if (isTimeOccupied(timeVal) && timeVal !== minutesToTime(nextBookingStartMinutes)) {
                 isDisabled = true; // จบในเวลาที่ไม่ว่าง
            }

            if (isDisabled) {
                options[i].disabled = true;
                options[i].classList.add('text-gray-300');
            } else {
                options[i].disabled = false;
                options[i].classList.remove('text-gray-300');
            }
        }
    }

    // --- Time Helper Functions ---

    function timeToMinutes(time) {
        if(!time) return 0;
        const [h, m] = time.split(':').map(Number);
        // กรณีข้ามวัน (หลังเที่ยงคืน) ให้ +24 ชม.
        if (h < 7) return (h + 24) * 60 + m; 
        return h * 60 + m;
    }
    
    function minutesToTime(minutes) {
        let h = Math.floor(minutes / 60);
        let m = minutes % 60;
        if (h >= 24) h -= 24;
        return `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}`;
    }
</script>
@endsection