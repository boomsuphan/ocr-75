@extends('layouts.themeNew')

@section('content')
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#1f8aad",
                    "primary-dark": "#166480",
                    "background-light": "#f8f9fa",
                    "background-dark": "#1a1d21",
                    "surface-light": "#ffffff",
                    "surface-dark": "#22252a",
                    "text-main": "#121617",
                    "text-sub": "#657e86",
                },
                fontFamily: {
                    "display": ["Manrope", "Noto Sans Thai", "sans-serif"],
                    "body": ["Noto Sans Thai", "sans-serif"],
                },
                borderRadius: {
                    "DEFAULT": "0.5rem",
                    "lg": "0.75rem",
                    "xl": "1rem",
                    "full": "9999px"
                },
            },
        },
    }
</script>
<style type="text/tailwindcss">
    @layer base {
        body {
            @apply font-display;
        }
    }
    main.items-center{
        align-items: start !important;
    }
    /* Animation for search interaction */
    .search-focus {
        @apply ring-2 ring-primary/20 border-primary transition-all duration-300;
    }
</style>

<div class="flex flex-col max-w-[1200px] w-full mx-auto p-4 md:p-8 gap-6">
    <div class="w-full max-w-[1280px] flex flex-col gap-6">

        {{-- 1. แจ้งเตือนความสำเร็จ (Success) --}}
        @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 shadow-sm">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 dark:bg-green-800 flex items-center justify-center text-green-600 dark:text-green-300">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
            <div>
                <h4 class="font-bold text-green-800 dark:text-green-200">ทำรายการสำเร็จ</h4>
                <p class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="ml-auto text-green-500 hover:text-green-700">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        @endif

        {{-- 2. แจ้งเตือนแบบมีปัญหาบางรายการ (Warning) --}}
        @if (session('warning'))
        <div class="mb-6 p-4 bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 rounded-xl flex items-start gap-3 shadow-sm">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-orange-100 dark:bg-orange-800 flex items-center justify-center text-orange-600 dark:text-orange-300">
                <span class="material-symbols-outlined">warning</span>
            </div>
            <div class="flex-1">
                <h4 class="font-bold text-orange-800 dark:text-orange-200">แจ้งเตือน</h4>
                <p class="text-sm text-orange-700 dark:text-orange-300 leading-relaxed">
                    {{ session('warning') }}
                </p>
            </div>
            <button onclick="this.parentElement.remove()" class="ml-auto text-orange-500 hover:text-orange-700">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        @endif

        {{-- 3. แจ้งเตือนข้อผิดพลาด (Error) --}}
        @if (session('error'))
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl flex items-start gap-3 shadow-sm">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-red-100 dark:bg-red-800 flex items-center justify-center text-red-600 dark:text-red-300">
                <span class="material-symbols-outlined">error</span>
            </div>
            <div>
                <h4 class="font-bold text-red-800 dark:text-red-200">เกิดข้อผิดพลาด</h4>
                <p class="text-sm text-red-700 dark:text-red-300">{{ session('error') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="ml-auto text-red-500 hover:text-red-700">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        @endif

        {{-- Header Section --}}
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-2 border-b border-gray-200 dark:border-gray-800">
            <div class="flex flex-col gap-2">
                <h2 class="text-3xl lg:text-4xl font-black tracking-tight text-text-main dark:text-white">ประวัติการใช้งาน: {{$room->name}}</h2>
                <div class="flex items-center gap-2 text-text-sub dark:text-gray-400">
                    <span class="material-symbols-outlined text-[20px]">location_on</span>
                    <span class="text-base">อาคารคณะวิทยาการคอมพิวเตอร์ ชั้น {{$room->floor}}</span>
                </div>
            </div>

            <button onclick="document.getElementById('recurringModal').showModal()" class="btn bg-primary text-white px-5 py-2.5 rounded-xl shadow-lg shadow-primary/25 hover:bg-primary-dark hover:shadow-primary/40 transition-all flex items-center gap-2 group">
                <span class="material-symbols-outlined group-hover:rotate-180 transition-transform duration-500">event_repeat</span>
                <span class="font-bold">เพิ่มตารางเรียนประจำ</span>
            </button>
        </div>

        {{-- Modal --}}
        <dialog id="recurringModal" class="modal rounded-2xl shadow-2xl p-0 backdrop:bg-gray-900/50 backdrop-blur-sm">
            <div class="bg-white dark:bg-surface-dark w-[550px] p-8 rounded-2xl border border-gray-100 dark:border-gray-800">
                
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
                    <div class="size-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">calendar_month</span>
                    </div>
                    <div>
                        <h3 class="font-black text-xl text-[#111418] dark:text-white">เพิ่มตารางเรียนประจำ</h3>
                        <p class="text-xs text-text-sub dark:text-gray-400">สร้าง Booking อัตโนมัติตลอดภาคการศึกษา</p>
                    </div>
                </div>
                
                @php
                $timeSlots = [
                    '07:30', '08:30', '09:30', '10:30', '11:30', '12:30',
                    '13:30', '14:30', '15:30', '16:30', '17:30', '18:30',
                    '20:30', '21:30', '22:30', '23:30', '00:30', '01:30'
                ];
                @endphp

                <form action="{{ url('/room/add_recurring') }}" method="POST" class="flex flex-col gap-5">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">

                    @if($semesters->isEmpty())
                        <div class="p-4 bg-orange-50 dark:bg-orange-900/10 border border-orange-200 dark:border-orange-800 text-orange-800 dark:text-orange-200 rounded-xl text-sm flex items-start gap-3">
                            <span class="material-symbols-outlined text-xl mt-0.5">warning</span>
                            <div>
                                <p class="font-bold text-base">ไม่พบข้อมูลภาคการศึกษา</p>
                                <p class="opacity-80">กรุณาเพิ่มข้อมูลภาคการศึกษาในระบบก่อนทำรายการนี้</p>
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label class="block text-sm font-bold mb-2 text-[#111418] dark:text-white">
                                ภาคการศึกษา <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">school</span>
                                <select name="semester_id" class="w-full h-11 pl-10 pr-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-zinc-800/50 text-[#111418] dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all appearance-none cursor-pointer" required>
                                    @foreach($semesters as $sem)
                                        <option value="" disabled selected>กรุณาเลือกภาคการศึกษา</option>
                                        <option value="{{ $sem->id }}">{{ $sem->name }}</option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none">expand_more</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-bold mb-2 text-[#111418] dark:text-white">
                                วันเรียนประจำ <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">today</span>
                                <select id="recur_day" name="day_of_week" class="w-full h-11 pl-10 pr-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-zinc-800/50 text-[#111418] dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all appearance-none cursor-pointer" required>
                                    <option value="" disabled selected>กรุณาเลือกวัน...</option>
                                    <option value="1">วันจันทร์</option>
                                    <option value="2">วันอังคาร</option>
                                    <option value="3">วันพุธ</option>
                                    <option value="4">วันพฤหัสบดี</option>
                                    <option value="5">วันศุกร์</option>
                                    <option value="6">วันเสาร์</option>
                                    <option value="0">วันอาทิตย์</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none">expand_more</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold mb-2 text-[#111418] dark:text-white">
                                    เวลาเริ่ม <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">schedule</span>
                                    <select id="recur_start" name="time_start" disabled 
                                        class="w-full h-11 pl-10 pr-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-zinc-800/50 text-[#111418] dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all appearance-none cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed" required>
                                        <option value="" disabled selected>เริ่ม</option>
                                        @foreach($timeSlots as $time)
                                            @if(!$loop->last) 
                                                <option value="{{ $time }}">{{ $time }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none">expand_more</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold mb-2 text-[#111418] dark:text-white">
                                    เวลาสิ้นสุด <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">schedule</span>
                                    <select id="recur_end" name="time_end" disabled
                                        class="w-full h-11 pl-10 pr-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-zinc-800/50 text-[#111418] dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all appearance-none cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed" required>
                                        <option value="" disabled selected>จบ</option>
                                        @foreach($timeSlots as $time)
                                            @if(!$loop->first)
                                                <option value="{{ $time }}">{{ $time }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none">expand_more</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold mb-2 text-[#111418] dark:text-white">ชื่อวิชา</label>
                            <input type="text" name="subject" class="w-full h-11 px-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-800 text-[#111418] dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all placeholder-gray-400" placeholder="เช่น Computer Programming" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 text-[#111418] dark:text-white">อาจารย์ผู้สอน</label>
                            <input type="text" name="name_professor" class="w-full h-11 px-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-800 text-[#111418] dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all placeholder-gray-400" placeholder="เช่น ผศ.ดร.สมชาย ใจดี" required>
                        </div>
                    @endif

                    <div class="flex justify-end gap-3 mt-6 pt-5 border-t border-gray-100 dark:border-gray-800">
                        <button type="button" onclick="document.getElementById('recurringModal').close()" class="px-6 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 font-bold hover:bg-gray-50 dark:hover:bg-zinc-800 transition-all">
                            ยกเลิก
                        </button>
                        
                        @if(!$semesters->isEmpty())
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary text-white font-bold hover:bg-primary-dark shadow-lg shadow-primary/25 hover:shadow-primary/40 transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">save</span>
                            บันทึกข้อมูล
                        </button>
                        @else
                        <button type="button" disabled class="px-6 py-2.5 rounded-xl bg-gray-200 dark:bg-zinc-800 text-gray-400 font-bold cursor-not-allowed">
                            บันทึกข้อมูล
                        </button>
                        @endif
                    </div>
                </form>
            </div>
        </dialog>

        {{-- Filter & Search Section --}}
        <div class="bg-surface-light dark:bg-surface-dark p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col md:flex-row gap-4 justify-between items-center">
            
            {{-- Search Box --}}
            <div class="w-full md:w-2/5 relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                <input type="text" id="tableSearch" placeholder="ค้นหาวิชา, อาจารย์ หรือผู้จอง..." 
                    class="w-full h-11 pl-10 pr-4 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-zinc-800 text-sm text-text-main dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
            </div>

            {{-- Filter Status --}}
            <div class="w-full md:w-auto flex items-center gap-3">
                <span class="text-sm font-bold text-text-sub dark:text-gray-400 whitespace-nowrap">
                    <span class="material-symbols-outlined align-bottom text-lg mr-1">filter_list</span>
                    สถานะ:
                </span>
                <div class="relative w-full md:w-48">
                    <select id="statusFilter" class="w-full h-10 pl-3 pr-8 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-800 text-sm text-text-main dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary appearance-none cursor-pointer transition-all">
                        <option value="">ทั้งหมด</option>
                        <option value="จองเรียบร้อย">จองเรียบร้อย</option>
                        <option value="รับกุญแจแล้ว">รับกุญแจแล้ว</option>
                        <option value="คืนกุญแจแล้ว">คืนกุญแจแล้ว</option>
                        <option value="ยกเลิก">ยกเลิก</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none">expand_more</span>
                </div>
            </div>
        </div>
         
        {{-- Table Section --}}
        <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden flex flex-col">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] border-collapse" id="bookingTable">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">วันที่/เวลา</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">ผู้จอง</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400 ">วิชา</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">อาจารย์ผู้สอน</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">สถานะ</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($booking as $item)
                      
                        <tr class="booking-row group hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-xs text-text-sub dark:text-gray-500">{{ thaidate('วันl', $item->date_booking) }}</div>
                                <div class="text-sm font-semibold text-text-main dark:text-white">
                                    {{ thaidate('j M Y', $item->date_booking) }}
                                </div>
                                 <div class="flex items-center gap-2 text-sm text-text-main dark:text-gray-200 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded w-fit">
                                    {{ substr($item->time_start_booking, 0, 5) }} - {{ substr($item->time_end_booking, 0, 5) }}

                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap user-col">
                                 <div class="text-sm font-bold text-text-main dark:text-white">{{$item->user->fullname }} </div>
                                <div class="text-xs text-text-sub dark:text-gray-400 mt-0.5">
                                    @if($item->user->role == "admin")
                                        แอดมิน
                                    @elseif($item->user->role == "officer")
                                        เจ้าหน้าที่
                                    @elseif($item->user->role == "professor")
                                        อาจารย์
                                    @elseif($item->user->role == "students")
                                        นักศึกษา
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 subject-col">
                                <div class="text-sm font-bold text-text-main dark:text-white"> {{$item->subject }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap professor-col">
                                <div class="flex items-center gap-3">
                                    <div class="text-sm font-medium text-text-main dark:text-gray-200">{{$item->name_professor }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center status-col" data-status="{{ $item->status }}">
                                @switch($item->status)
                                @case('จองเรียบร้อย')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-cyan-100 text-cyan-700 dark:bg-cyan-900/30 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800">
                                    <span class="size-1.5 rounded-full bg-cyan-500"></span>
                                    จองเรียบร้อย
                                </span>
                                @break
                                @case('รับกุญแจแล้ว')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400 border border-orange-200 dark:border-orange-800">
                                    <span class="size-1.5 rounded-full bg-orange-500"></span>
                                    รับกุญแจแล้ว
                                </span>
                                @break
                                @case('คืนกุญแจแล้ว')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-700">
                                    <span class="size-1.5 rounded-full bg-emerald-700"></span>
                                    คืนกุญแจแล้ว
                                </span>
                                @break
                                @case('ยกเลิก')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">
                                    <span class="size-1.5 rounded-full bg-red-500"></span>
                                    ยกเลิก
                                </span>
                                @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right flex justify-end">
                                @if($item->status == "จองเรียบร้อย" || $item->status == "รับกุญแจแล้ว")
                                <a href="{{ url('/check_qr') }}/{{ $item->code_for_qr }}" class="p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-lg transition-colors flex">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                                @elseif($item->status == "คืนกุญแจแล้ว" || $item->status == "ยกเลิก")
                                <a href="{{ url('/data_of_booking') }}/{{ $item->code_for_qr }}" class="p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-lg transition-colors flex">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        
                        <tr id="noResultRow" class="hidden">
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="material-symbols-outlined text-4xl text-gray-300">search_off</span>
                                    <span>ไม่พบข้อมูลที่ค้นหา</span>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
           
        </div>
    </div>
</div>

{{-- Scripts --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Modal Scripts ---
        const daySelect = document.getElementById('recur_day');
        const startSelect = document.getElementById('recur_start');
        const endSelect = document.getElementById('recur_end');

        if(daySelect) {
            daySelect.addEventListener('change', function() {
                if(this.value !== "") {
                    startSelect.disabled = false;
                } else {
                    startSelect.disabled = true;
                    startSelect.value = "";
                    endSelect.disabled = true;
                    endSelect.value = "";
                }
            });

            startSelect.addEventListener('change', function() {
                if(this.value !== "") {
                    endSelect.disabled = false;
                    endSelect.value = ""; 

                    const startMinutes = timeToMinutes(this.value);
                    Array.from(endSelect.options).forEach((option) => {
                        if (option.value === "") return;
                        const endMinutes = timeToMinutes(option.value);
                        if (endMinutes <= startMinutes) {
                            option.hidden = true; 
                            option.disabled = true; 
                        } else {
                            option.hidden = false;
                            option.disabled = false;
                        }
                    });
                } else {
                    endSelect.disabled = true;
                    endSelect.value = "";
                }
            });
        }

        function timeToMinutes(timeStr) {
            const [h, m] = timeStr.split(':').map(Number);
            let hours = h;
            if(h < 6) hours += 24; 
            return (hours * 60) + m;
        }

        // --- Filter & Search Scripts ---
        const searchInput = document.getElementById('tableSearch');
        const statusFilter = document.getElementById('statusFilter');
        const tableRows = document.querySelectorAll('.booking-row');
        const noResultRow = document.getElementById('noResultRow');

        function filterTable() {
            const searchText = searchInput.value.toLowerCase();
            const statusValue = statusFilter.value;
            let hasVisibleRow = false;

            tableRows.forEach(row => {
                const userText = row.querySelector('.user-col')?.textContent.toLowerCase() || "";
                const subjectText = row.querySelector('.subject-col')?.textContent.toLowerCase() || "";
                const professorText = row.querySelector('.professor-col')?.textContent.toLowerCase() || "";
                const statusText = row.querySelector('.status-col')?.dataset.status || "";

                // Check Text Match (User, Subject, or Professor)
                const matchesSearch = userText.includes(searchText) || 
                                      subjectText.includes(searchText) || 
                                      professorText.includes(searchText);

                // Check Status Match
                const matchesStatus = statusValue === "" || statusText === statusValue;

                if (matchesSearch && matchesStatus) {
                    row.style.display = "";
                    hasVisibleRow = true;
                } else {
                    row.style.display = "none";
                }
            });

            // Show/Hide "No Result" message
            if (!hasVisibleRow) {
                noResultRow.classList.remove('hidden');
            } else {
                noResultRow.classList.add('hidden');
            }
        }

        // Attach Events
        searchInput.addEventListener('keyup', filterTable);
        statusFilter.addEventListener('change', filterTable);
    });
</script>

@endsection