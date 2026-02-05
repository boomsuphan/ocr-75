@extends('layouts.themeNew')

@section('content')
<div class="flex flex-col max-w-[1000px] w-full mx-auto p-4 md:p-8 gap-6">
    
    {{-- Header --}}
    <div class="flex flex-col gap-2 border-b border-gray-200 dark:border-gray-800 pb-4">
        <h2 class="text-3xl font-black tracking-tight text-[#111418] dark:text-white">ออกรายงาน Excel</h2>
        <p class="text-gray-500 dark:text-gray-400">เลือกเงื่อนไขที่ต้องการเพื่อสรุปรายงานการจองห้องเรียน</p>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 text-green-700 border border-green-200 rounded-xl flex items-center gap-3 shadow-sm">
            <span class="material-symbols-outlined">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 bg-red-50 text-red-700 border border-red-200 rounded-xl flex items-center gap-3 shadow-sm">
            <span class="material-symbols-outlined">error</span>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white dark:bg-surface-dark rounded-2xl shadow-xl border border-gray-100 dark:border-gray-800 overflow-hidden">
        
        {{-- Report Preview / Icon --}}
        <div class="bg-primary/5 p-8 flex flex-col items-center justify-center border-b border-gray-100 dark:border-gray-800">
            <h3 class="text-xl font-bold text-primary">สรุปรายงานการจองห้องเรียน</h3>
            <p class="text-sm text-text-sub">ข้อมูลจะถูกส่งออกเป็นไฟล์ .xlsx (Excel)</p>
        </div>

        <form action="{{ url('/admin/report/export') }}" method="POST" class="p-8 flex flex-col gap-8">
            @csrf
            
            {{-- Filter Types --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <label class="relative flex flex-col p-4 border-2 border-gray-100 dark:border-gray-700 rounded-2xl cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                    <input type="radio" name="filter_type" value="year" class="absolute top-4 right-4 text-primary focus:ring-primary" checked onclick="toggleFilters('year')">
                    <span class="material-symbols-outlined text-primary mb-2">calendar_today</span>
                    <span class="font-bold dark:text-white">รายปี</span>
                    <span class="text-xs text-gray-400">สรุปข้อมูลทั้งปี พ.ศ.</span>
                </label>

                <label class="relative flex flex-col p-4 border-2 border-gray-100 dark:border-gray-700 rounded-2xl cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                    <input type="radio" name="filter_type" value="month" class="absolute top-4 right-4 text-primary focus:ring-primary" onclick="toggleFilters('month')">
                    <span class="material-symbols-outlined text-primary mb-2">calendar_month</span>
                    <span class="font-bold dark:text-white">รายเดือน</span>
                    <span class="text-xs text-gray-400">เลือกเดือนที่ต้องการ</span>
                </label>

                <label class="relative flex flex-col p-4 border-2 border-gray-100 dark:border-gray-700 rounded-2xl cursor-pointer hover:border-primary/50 transition-all has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                    <input type="radio" name="filter_type" value="range" class="absolute top-4 right-4 text-primary focus:ring-primary" onclick="toggleFilters('range')">
                    <span class="material-symbols-outlined text-primary mb-2">date_range</span>
                    <span class="font-bold dark:text-white">ระบุช่วงวันที่</span>
                    <span class="text-xs text-gray-400">กำหนดวันเริ่ม-สิ้นสุดเอง</span>
                </label>
            </div>

            <div class="bg-gray-50 dark:bg-zinc-800/50 p-6 rounded-2xl flex flex-col gap-6 border border-gray-100 dark:border-gray-700">
                
                {{-- 1. Year Filter --}}
                <div id="filter-year" class="filter-section">
                    <label class="block text-sm font-bold mb-3 dark:text-white uppercase tracking-wider">เลือกปี พ.ศ.</label>
                    <div class="relative">
                        <select name="year" class="w-full h-12 px-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-800 text-lg outline-none focus:ring-2 focus:ring-primary/20 cursor-pointer appearance-none">
                            {{-- แก้ไข: ให้วนลูปย้อนหลัง 5 ปี จากปีปัจจุบัน --}}
                            @php $currentYear = date('Y') + 543; @endphp
                            @for ($i = $currentYear; $i >= $currentYear - 5; $i--)
                                <option value="{{ $i - 543 }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">expand_more</span>
                    </div>
                </div>

                {{-- 2. Month Filter --}}
                <div id="filter-month" class="filter-section hidden">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold mb-2 dark:text-white">ปี พ.ศ.</label>
                            <div class="relative">
                                <select name="month_year" class="w-full h-12 px-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-800 outline-none focus:ring-2 focus:ring-primary/20 cursor-pointer appearance-none">
                                    @php $currentYear = date('Y') + 543; @endphp
                                    @for ($i = $currentYear; $i >= $currentYear - 5; $i--)
                                        <option value="{{ $i - 543 }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">expand_more</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 dark:text-white">เดือน</label>
                            <div class="relative">
                                <select name="month" class="w-full h-12 px-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-800 outline-none focus:ring-2 focus:ring-primary/20 cursor-pointer appearance-none">
                                    @php
                                        $months = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
                                    @endphp
                                    @foreach($months as $index => $m)
                                        <option value="{{ $index + 1 }}" {{ (date('n') == $index + 1) ? 'selected' : '' }}>{{ $m }}</option>
                                    @endforeach
                                </select>
                                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">expand_more</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 3. Range Filter --}}
                <div id="filter-range" class="filter-section hidden">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold mb-2 dark:text-white">จากวันที่</label>
                            <div class="relative">
                                <input type="date" name="start_date" onclick="this.showPicker()" class="w-full h-12 px-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-800 outline-none focus:ring-2 focus:ring-primary/20 cursor-pointer">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 dark:text-white">ถึงวันที่</label>
                            <div class="relative">
                                <input type="date" name="end_date" onclick="this.showPicker()" class="w-full h-12 px-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-zinc-800 outline-none focus:ring-2 focus:ring-primary/20 cursor-pointer">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-100 dark:border-gray-700">

                {{-- Additional Filters (Room) --}}
                <div>
                    <label class="block text-sm font-bold mb-3 dark:text-white">ตัวเลือกเพิ่มเติม: ห้องเรียน</label>
                    <div class="flex flex-wrap gap-2">
                        <label class="cursor-pointer group">
                            <input type="radio" name="room_filter" value="all" class="peer hidden" checked>
                            <span class="px-4 py-2 rounded-full border border-gray-200 dark:border-gray-700 text-sm peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all block hover:bg-gray-50 dark:hover:bg-zinc-800">ทุกห้อง</span>
                        </label>
                        @foreach($rooms as $room)
                        <label class="cursor-pointer group">
                            <input type="radio" name="room_filter" value="{{ $room->id }}" class="peer hidden">
                            <span class="px-4 py-2 rounded-full border border-gray-200 dark:border-gray-700 text-sm peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary transition-all block hover:bg-gray-50 dark:hover:bg-zinc-800">{{ $room->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 h-14 bg-emerald-500 hover:bg-emerald-600 text-white font-black rounded-2xl shadow-lg shadow-emerald-500/20 transition-all flex items-center justify-center gap-3 active:scale-95">
                    <span class="material-symbols-outlined text-2xl">download_for_offline</span>
                    ดาวน์โหลดไฟล์รายงาน Excel (.xlsx)
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleFilters(type) {
        // ซ่อนทุกอันก่อน
        document.querySelectorAll('.filter-section').forEach(el => el.classList.add('hidden'));
        // แสดงเฉพาะอันที่เลือก
        document.getElementById('filter-' + type).classList.remove('hidden');
    }
</script>
@endsection