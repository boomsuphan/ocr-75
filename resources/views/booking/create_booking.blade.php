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

            <!-- Visual Availability Timeline for Desktop -->
            <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] dark:shadow-none border border-border-light dark:border-border-dark p-6 overflow-hidden">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-bold text-text-main dark:text-white">ไทม์ไลน์การจอง (ห้อง {{$rooms->name}})</h3>

                </div>
                <div class="flex flex-col">
                    <div class="flex-1 max-w-7xl mx-auto w-full  space-y-6">

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

                    </div>
                </div>
                <style>
                    .stripe-pattern {
                        background-image: repeating-linear-gradient(45deg, transparent, transparent 5px, rgba(248, 113, 113, 0.1) 5px, rgba(248, 113, 113, 0.1) 10px);
                    }
                </style>
            </div>
        </div>

    </div>
</main>


<script>
    window.onload = function () {
    let room_id = document.querySelector("#room_id");
    
    fetch("{{ url('/') }}/api/get_data_create_booking/" + room_id.value)
    .then(response => response.json())
    .then(result => {
        console.log(result);
        
        // แปลงข้อมูลจาก API เป็นรูปแบบที่ใช้แสดงผล
        const bookings = Array.isArray(result) ? result : [result];
        processBookingsAndRender(bookings);
    })
    .catch(error => {
        console.error('Error fetching data:', error);
        renderSchedule([]); // แสดงตารางว่างถ้าเกิด error
    });
}

const timeSlots = [
    { period: 1, start: "07:30", end: "08:30" },
    { period: 2, start: "08:30", end: "09:30" },
    { period: 3, start: "09:30", end: "10:30" },
    { period: 4, start: "10:30", end: "11:30" },
    { period: 5, start: "11:30", end: "12:30" },
    { period: 6, start: "12:30", end: "13:30" },
    { period: 7, start: "13:30", end: "14:30" },
    { period: 8, start: "14:30", end: "15:30" },
    { period: 9, start: "15:30", end: "16:30" },
    { period: 10, start: "16:30", end: "17:30" },
    { period: 11, start: "17:30", end: "18:30" },
    { period: 12, start: "18:30", end: "20:30" },
    { period: 13, start: "20:30", end: "21:30" },
    { period: 14, start: "21:30", end: "22:30" },
    { period: 15, start: "22:30", end: "23:30" },
    { period: 16, start: "23:30", end: "00:30" },
    { period: 17, start: "00:30", end: "01:30" }
];

// ฟังก์ชันแปลงเวลาเป็น period
function timeToPeriod(time) {
    const [hours, minutes] = time.split(':').map(Number);
    const timeInMinutes = hours * 60 + minutes;
    
    for (let i = 0; i < timeSlots.length; i++) {
        const [startH, startM] = timeSlots[i].start.split(':').map(Number);
        const startInMinutes = startH * 60 + startM;
        const [endH, endM] = timeSlots[i].end.split(':').map(Number);
        const endInMinutes = endH * 60 + endM;
        
        if (timeInMinutes >= startInMinutes && timeInMinutes < endInMinutes) {
            return timeSlots[i].period;
        }
    }
    return null;
}

// ฟังก์ชันคำนวณจำนวน period ที่ใช้
function calculateSpan(startTime, endTime) {
    const startPeriod = timeToPeriod(startTime);
    const endPeriod = timeToPeriod(endTime);
    
    if (startPeriod && endPeriod) {
        return endPeriod - startPeriod + 1;
    }
    return 1;
}

// ฟังก์ชันประมวลผลข้อมูลการจองและสร้างตาราง
function processBookingsAndRender(bookings) {
    const schedule = [];
    
    // สร้าง array สำหรับเก็บสถานะทุก period
    const periodStatus = new Array(18).fill(null); // index 0 ไม่ใช้, 1-17 คือ period
    
    bookings.forEach(booking => {
        const startPeriod = timeToPeriod(booking.time_start_booking);
        const span = calculateSpan(booking.time_start_booking, booking.time_end_booking);
        
        if (startPeriod) {
            periodStatus[startPeriod] = {
                period: startPeriod,
                status: "occupied",
                subject: booking.subject || "ไม่ระบุ",
                teacher: booking.name_professor || "ไม่ระบุ",
                note: booking.note || "",
                span: span,
                bookingData: booking
            };
            
            // ทำเครื่องหมาย period ที่ถูกใช้ไปแล้ว
            for (let i = 1; i < span; i++) {
                if (startPeriod + i <= 17) {
                    periodStatus[startPeriod + i] = { skip: true };
                }
            }
        }
    });
    
    // สร้าง schedule array จากข้อมูลที่ประมวลผล
    for (let i = 1; i <= 17; i++) {
        if (periodStatus[i] === null) {
            schedule.push({
                period: i,
                status: "available"
            });
        } else if (!periodStatus[i].skip) {
            schedule.push(periodStatus[i]);
        }
    }
    
    renderSchedule(schedule);
}

function renderSchedule(schedule) {
    const tbody = document.getElementById('scheduleTable');
    tbody.innerHTML = ''; // ล้างข้อมูลเก่า
    
    const tr = document.createElement('tr');
    tr.className = 'h-32';

    // Period label cell
    const labelCell = document.createElement('td');
    labelCell.className = 'p-4 bg-gray-50 dark:bg-gray-900 font-medium text-center';
    labelCell.textContent = 'สถานะ';
    tr.appendChild(labelCell);

    // Schedule cells
    let skipNext = 0;
    for (let i = 1; i <= 17; i++) {
        if (skipNext > 0) {
            skipNext--;
            continue;
        }

        const slot = schedule.find(s => s.period === i) || {
            status: 'available',
            period: i
        };
        
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
            const displayNote = slot.note ? `<span class="text-[10px] text-red-500/60 dark:text-red-300/60 truncate">${slot.note}</span>` : '';
            td.innerHTML = `
                <div class="w-full h-24 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800/50 p-3 flex flex-col justify-center overflow-hidden">
                    <span class="text-xs font-bold text-red-700 dark:text-red-400 leading-tight mb-1">${slot.subject}</span>
                    <span class="text-[10px] text-red-600/70 dark:text-red-400/60 truncate">${slot.teacher}</span>
                    ${displayNote}
                </div>
            `;
        }
        tr.appendChild(td);
    }

    tbody.appendChild(tr);
}
    document.addEventListener('DOMContentLoaded', function() {
        const startSelect = document.getElementById('time_start_booking');
        const endSelect = document.getElementById('time_end_booking');
        // ดึง Array เวลามาจาก PHP เพื่อใช้อ้างอิงลำดับ (Index)
        const timeSlots = @json($timeSlots);

        function updateEndOptions() {
            // 1. ถ้ายังไม่เลือกเวลาเริ่ม -> ปิดช่องเวลาจบ และจบการทำงาน
            if (!startSelect.value) {
                endSelect.disabled = true;
                endSelect.value = ""; // รีเซ็ตค่าเวลาจบ
                return;
            }

            // 2. ถ้าเลือกเวลาเริ่มแล้ว -> เปิดช่องเวลาจบ
            endSelect.disabled = false;

            // หา Index ของเวลาเริ่มที่เลือกปัจจุบัน
            const startIndex = timeSlots.indexOf(startSelect.value);

            // 3. วนลูปเช็คทุกตัวเลือกในช่อง "เวลาจบ"
            for (let i = 0; i < endSelect.options.length; i++) {
                const option = endSelect.options[i];
                const optionValue = option.value;

                // ข้ามตัวเลือกที่เป็น Placeholder ("เลือกเวลาสิ้นสุด")
                if (!optionValue) continue;

                // หา Index ของตัวเลือกนี้
                const endIndex = timeSlots.indexOf(optionValue);

                // 4. ถ้าลำดับเวลาจบ น้อยกว่าหรือเท่ากับ เวลาเริ่ม -> ให้ Disable (กดไม่ได้)
                if (endIndex <= startIndex) {
                    option.disabled = true;
                    option.classList.add('text-gray-300'); // (Optional) เปลี่ยนสีให้ดูจางๆ

                    // ถ้าค่าที่เลือกค้างอยู่ ดันเป็นค่าที่ห้ามกด -> ให้ดีดออกเป็นค่าว่าง
                    if (endSelect.value === optionValue) {
                        endSelect.value = "";
                    }
                } else {
                    // ถ้าถูกต้อง -> ให้ Enable (กดได้)
                    option.disabled = false;
                    option.classList.remove('text-gray-300');
                }
            }
        }

        // event เมื่อมีการเปลี่ยนค่าเวลาเริ่ม
        startSelect.addEventListener('change', updateEndOptions);

        // เรียกฟังก์ชัน 1 ครั้งตอนโหลดหน้า (เผื่อกรณี Submit แล้ว Error กลับมา จะได้คงสถานะเดิมไว้)
        updateEndOptions();
    });
</script>
@endsection