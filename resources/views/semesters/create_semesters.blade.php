@extends('layouts.themeNew')

@section('content')

{{-- Config Tailwind & CSS (ตาม Theme ที่คุณใช้) --}}
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
        body { @apply font-display; }
    }
</style>

<div class="flex flex-col max-w-[1200px] w-full mx-auto p-4 md:p-8 gap-6">
    
    {{-- Header --}}
    <div class="flex flex-col gap-2 border-b border-gray-200 dark:border-gray-800 pb-4">
        <h2 class="text-3xl font-black tracking-tight text-text-main dark:text-white">จัดการภาคการศึกษา</h2>
        <p class="text-text-sub dark:text-gray-400">เพิ่มและจัดการช่วงเวลาของภาคการศึกษาสำหรับระบบจองห้อง</p>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 text-green-800 dark:text-green-300 shadow-sm">
        <span class="material-symbols-outlined">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif
    
    @if ($errors->any())
    <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl flex items-start gap-3 text-red-800 dark:text-red-300 shadow-sm">
        <span class="material-symbols-outlined mt-0.5">error</span>
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        {{-- Section 1: Form (1 Column) --}}
        <div class="lg:col-span-1">
            <div class="bg-surface-light dark:bg-surface-dark p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 sticky top-4">
                <div class="flex items-center gap-3 mb-6">
                    <div class="size-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">add</span>
                    </div>
                    <h3 class="font-bold text-lg text-text-main dark:text-white">เพิ่มภาคการศึกษาใหม่</h3>
                </div>

                <form action="{{ url('save_semesters') }}" method="POST" class="flex flex-col gap-5">
                    @csrf
                    
                    {{-- ชื่อภาคการศึกษา --}}
                    <div>
                        <label class="block text-sm font-bold mb-2 text-text-main dark:text-white">ชื่อภาคการศึกษา</label>
                        <input type="text" name="name" class="w-full h-11 px-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-zinc-800 text-text-main dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all placeholder-gray-400" placeholder="เช่น 1/2568" required>
                    </div>

                    {{-- วันที่เริ่มต้น --}}
                    <div>
                        <label class="block text-sm font-bold mb-2 text-text-main dark:text-white">วันเริ่มต้น</label>
                        <div class="relative group">
                            {{-- เพิ่ม pointer-events-none เพื่อให้คลิกทะลุ icon ได้ --}}
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 group-hover:text-primary transition-colors pointer-events-none">date_range</span>
                            
                            {{-- เพิ่ม id="date_start" และ onclick="this.showPicker()" --}}
                            <input type="date" id="date_start" name="date_start" 
                                onclick="this.showPicker()"
                                class="w-full h-11 pl-10 pr-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-zinc-800 text-text-main dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all cursor-pointer" required>
                        </div>
                    </div>

                    {{-- วันที่สิ้นสุด --}}
                    <div>
                        <label class="block text-sm font-bold mb-2 text-text-main dark:text-white">วันสิ้นสุด</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 group-hover:text-primary transition-colors pointer-events-none">event_busy</span>
                            
                            {{-- เพิ่ม id="date_end" และ onclick="this.showPicker()" --}}
                            <input type="date" id="date_end" name="date_end" 
                                onclick="this.showPicker()"
                                class="w-full h-11 pl-10 pr-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-zinc-800 text-text-main dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all cursor-pointer" required>
                        </div>
                    </div>

                    <button type="submit" class="mt-2 w-full h-12 bg-primary hover:bg-primary-dark text-white font-bold rounded-xl shadow-lg shadow-primary/30 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">save</span>
                        บันทึกข้อมูล
                    </button>

                </form>
            </div>
        </div>

        {{-- Section 2: Table List (2 Columns) --}}
        <div class="lg:col-span-2">
            <div class="bg-surface-light dark:bg-surface-dark rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/20">
                    <h3 class="font-bold text-lg text-text-main dark:text-white">รายการภาคการศึกษา</h3>
                    <span class="text-xs font-medium px-2 py-1 bg-gray-200 dark:bg-gray-700 rounded text-gray-600 dark:text-gray-300">
                        ทั้งหมด {{ count($semesters) }} รายการ
                    </span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[600px]">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">ชื่อภาคเรียน</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">ระยะเวลา</th>
                                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">สถานะ</th>
                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @if($semesters->isEmpty())
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-400">
                                        <div class="flex flex-col items-center gap-2">
                                            <span class="material-symbols-outlined text-4xl opacity-50">calendar_today</span>
                                            <span>ยังไม่มีข้อมูลภาคการศึกษา</span>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach($semesters as $sem)
                                    @php
                                        // Logic คำนวณสถานะ
                                        $now = \Carbon\Carbon::now();
                                        $start = \Carbon\Carbon::parse($sem->date_start);
                                        $end = \Carbon\Carbon::parse($sem->date_end);
                                        
                                        $statusClass = '';
                                        $statusText = '';

                                        if ($now->between($start, $end)) {
                                            $statusClass = 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800';
                                            $statusText = 'กำลังดำเนินการ';
                                        } elseif ($now->gt($end)) {
                                            $statusClass = 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400 border-gray-200 dark:border-gray-700';
                                            $statusText = 'สิ้นสุดแล้ว';
                                        } else {
                                            $statusClass = 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 border-blue-200 dark:border-blue-800';
                                            $statusText = 'ยังไม่ถึงกำหนด';
                                        }
                                    @endphp
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-base font-bold text-text-main dark:text-white">{{ $sem->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex flex-col">
                                                <div class="text-sm font-medium text-text-main dark:text-white">
                                                    {{ thaidate('j M Y', $sem->date_start) }} - {{ thaidate('j M Y', $sem->date_end) }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold border {{ $statusClass }}">
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <a href="{{ url('delete_semester/'.$sem->id) }}" 
                                               onclick="return confirm('ยืนยันการลบข้อมูล {{ $sem->name }} ? \nข้อมูลตารางเรียนที่ผูกกับเทอมนี้อาจได้รับผลกระทบ')"
                                               class="inline-flex items-center justify-center size-9 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all">
                                                <span class="material-symbols-outlined">delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('date_start');
        const endDateInput = document.getElementById('date_end');

        // เมื่อมีการเลือกวันเริ่มต้น
        startDateInput.addEventListener('change', function() {
            if (this.value) {
                // กำหนดให้วันสิ้นสุด ห้ามเลือกก่อนวันเริ่มต้น (min attribute)
                endDateInput.min = this.value;

                // ถ้าวันสิ้นสุดที่เลือกไว้เดิม มันน้อยกว่าวันเริ่มต้นใหม่ -> ให้เคลียร์ค่าทิ้ง
                if (endDateInput.value && endDateInput.value < this.value) {
                    endDateInput.value = '';
                }
            }
        });
    });
</script>

@endsection