@extends('layouts.themeNew')

@section('content')
    <div class="w-full max-w-[1280px] mx-auto px-4 sm:px-6 py-8">
        
        <div class="max-w-3xl mx-auto">

            <div class="flex items-center gap-4 mb-6">
                <h1 class="text-[#111418] dark:text-white text-2xl font-bold leading-tight">
                    สร้างรายการจองใหม่ (Create Booking)
                </h1>
            </div>

            <div class="bg-white dark:bg-[#1a2632] rounded-xl border border-[#dce0e5] dark:border-gray-800 shadow-sm p-6 sm:p-8">

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

                <form method="POST" action="{{ url('/booking') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

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

                        <div class="col-span-1 md:col-span-2">
                            <label for="semester" class="block font-medium text-lm text-[#111418] dark:text-gray-200 mb-2">
                                {{ 'ภาคการศึกษา' }} : {{ $currentSemester->name ?? 'ไม่อยู่ในช่วงภาคการศึกษา' }}
                            </label>
                        
                            <!-- ส่งค่าเข้า Database -->
                            <input type="hidden" 
                                   name="semester" 
                                   id="semester" 
                                   value="{{ $currentSemester->name ?? '' }}">

                            {!! $errors->first('semester', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
                        </div>

                        <div class="">
                            <label for="name_professor" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'อาจารย์ผู้สอน' }}</label>
                            <input class="w-full h-10 px-3 rounded-lg border {{ $errors->has('name_professor') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
                                   name="name_professor" type="text" id="name_professor" value="{{ isset($booking->name_professor) ? $booking->name_professor : ''}}" required>
                            {!! $errors->first('name_professor', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
                        </div>

                        <div class="">
                            <label for="subject" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'วิชา' }}</label>
                            <input class="w-full h-10 px-3 rounded-lg border {{ $errors->has('subject') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
                                   name="subject" type="text" id="subject" value="{{ isset($booking->subject) ? $booking->subject : ''}}" required>
                            {!! $errors->first('subject', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label for="note" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'รายละเอียดการใช้ห้อง' }}</label>
                            <textarea 
                                class="w-full px-3 py-2 rounded-lg border {{ $errors->has('note') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
                                name="note" 
                                id="note" 
                                rows="3"
                                required>{{ isset($booking->note) ? $booking->note : '' }}</textarea>

                            {!! $errors->first('note', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
                        </div>

                        @php
                            // กำหนดช่วงเวลาตามรูปภาพเป๊ะๆ (สังเกตช่วง 18:30 -> 20:30 และช่วงข้ามคืน)
                            $timeSlots = [
                                '07:30', '08:30', '09:30', '10:30', '11:30', '12:30', 
                                '13:30', '14:30', '15:30', '16:30', '17:30', '18:30', 
                                '20:30', '21:30', '22:30', '23:30', '00:30', '01:30'
                            ];
                        @endphp

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            {{-- ส่วนที่ 1: วันที่ --}}
                            <div class="col-span-1">
                                <label for="date_booking" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">
                                    {{ 'วันที่ต้องการจอง' }}
                                </label>
                                <input class="cursor-pointer w-full h-10 px-3 rounded-lg border {{ $errors->has('date_booking') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all"
                                       name="date_booking" type="date" id="date_booking"
                                       onclick="this.showPicker()"
                                       value="{{ old('date_booking', isset($booking->date_booking) ? $booking->date_booking : '') }}" required>
                                {!! $errors->first('date_booking', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
                            </div>

                            {{-- ส่วนที่ 2: เวลา --}}
                            <div class="col-span-1 md:col-span-2">
                                <label class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">
                                    {{ 'เวลาที่ต้องการจอง (เริ่ม - สิ้นสุด)' }}
                                </label>
                                
                                <div class="flex items-center gap-2">
                                    {{-- เวลาเริ่ม --}}
                                    <div class="w-full">
                                        <select name="time_start_booking" id="time_start_booking" 
                                                class="cursor-pointer w-full h-10 px-3 rounded-lg border {{ $errors->has('time_start_booking') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" required>
                                            <option value="" disabled selected>เริ่ม</option>
                                            @foreach($timeSlots as $time)
                                                @if(!$loop->last)
                                                    <option value="{{ $time }}" {{ old('time_start_booking', isset($booking->time_start_booking) ? $booking->time_start_booking : '') == $time ? 'selected' : '' }}>
                                                        {{ $time }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <span class="text-[#111418] dark:text-white font-bold">-</span>

                                    {{-- เวลาจบ (ใส่ disabled ไว้ก่อน เพื่อบังคับให้เลือกเวลาเริ่มก่อน) --}}
                                    <div class="w-full">
                                        <select name="time_end_booking" id="time_end_booking" disabled
                                                class="disabled:bg-gray-100 disabled:cursor-not-allowed cursor-pointer w-full h-10 px-3 rounded-lg border {{ $errors->has('time_end_booking') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" required>
                                            <option value="" disabled selected>สิ้นสุด</option>
                                            @foreach($timeSlots as $time)
                                                @if(!$loop->first)
                                                    <option value="{{ $time }}" {{ old('time_end_booking', isset($booking->time_end_booking) ? $booking->time_end_booking : '') == $time ? 'selected' : '' }}>
                                                        {{ $time }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                {{-- Error Message --}}
                                <div class="flex gap-2">
                                     <div class="w-full">{!! $errors->first('time_start_booking', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}</div>
                                     <div class="w-full pl-6">{!! $errors->first('time_end_booking', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-8 pt-4 border-t border-[#dce0e5] dark:border-gray-700 flex justify-end">
                        <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-primary hover:bg-primary-hover text-white font-bold rounded-lg shadow-sm transition-colors cursor-pointer flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            <span>ยืนยัน</span>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <script>
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