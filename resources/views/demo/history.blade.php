@extends('layouts.themeNew')

@section('content')

<style>
    /* Custom scrollbar for better aesthetics */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .dark ::-webkit-scrollbar-thumb {
        background: #334155;
    }

    .dark ::-webkit-scrollbar-thumb:hover {
        background: #475569;
    }
</style>
</head>

<div class="flex h-screen w-full overflow-hidden ">
    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col h-full overflow-y-auto bg-background-light dark:bg-background-dark">
        <div class="flex flex-col max-w-[1200px] w-full mx-auto p-4 md:p-8 gap-6">
            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 dark:border-gray-700 pb-4">
                <div class="flex flex-col gap-1">
                    <h1 class="text-[#111418] dark:text-white text-3xl md:text-4xl font-bold tracking-tight">ประวัติการใช้ห้องเรียน</h1>
                    <p class="text-[#617589] dark:text-[#9ca3af] text-base font-normal">ตรวจสอบสถานะการจองและประวัติการใช้งานห้องเรียนของคุณ</p>
                </div>
                <button class="flex items-center justify-center gap-2 rounded-lg h-10 px-4 bg-white dark:bg-[#1a2632] border border-[#dbe0e6] dark:border-[#2b3b4d] text-[#111418] dark:text-white text-sm font-bold hover:bg-slate-50 dark:hover:bg-[#23303d] transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">download</span>
                    <span>ส่งออกข้อมูล (CSV)</span>
                </button>
            </div>

            <!-- Filters & Search -->
            <div class="bg-white dark:bg-[#111a22] p-4 rounded-xl border border-[#dbe0e6] dark:border-[#2b3b4d] shadow-sm">
                <div class="flex flex-col md:flex-row gap-4 items-end">
                    <label class="flex flex-col w-full md:flex-1">
                        <p class="text-[#111418] dark:text-white text-sm font-medium pb-1.5">ค้นหาห้อง</p>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#617589] dark:text-[#9ca3af] pointer-events-none">search</span>
                            <input class="form-input w-full rounded-lg border border-[#dbe0e6] dark:border-[#2b3b4d] bg-white dark:bg-[#1a2632] text-[#111418] dark:text-white h-10 pl-10 pr-3 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="ระบุชื่อห้อง หรือ รหัสวิชา..." value="" />
                        </div>
                    </label>
                    <label class="flex flex-col w-full md:w-48">
                        <p class="text-[#111418] dark:text-white text-sm font-medium pb-1.5">สถานะ</p>
                        <select class="form-select w-full rounded-lg border border-[#dbe0e6] dark:border-[#2b3b4d] bg-white dark:bg-[#1a2632] text-[#111418] dark:text-white h-10 px-3 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary cursor-pointer">
                            <option>ทั้งหมด</option>
                            <option>คืนกุญแจแล้ว</option>
                            <option>เบิกกุญแจแล้ว</option>
                            <option>รออนุมัติ</option>
                        </select>
                    </label>
                    <label class="flex flex-col w-full md:w-48">
                        <p class="text-[#111418] dark:text-white text-sm font-medium pb-1.5">วันที่</p>
                        <input class="form-input w-full rounded-lg border border-[#dbe0e6] dark:border-[#2b3b4d] bg-white dark:bg-[#1a2632] text-[#111418] dark:text-white h-10 px-3 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary" type="date" />
                    </label>
                    <button class="w-full md:w-auto h-10 px-6 rounded-lg bg-primary text-white text-sm font-bold hover:bg-blue-600 transition-colors shadow-sm flex items-center justify-center gap-2">
                        ค้นหา
                    </button>
                </div>
            </div>
            <!-- Data Table -->
            <div class="flex flex-col rounded-xl border border-[#dbe0e6] dark:border-[#2b3b4d] bg-white dark:bg-[#111a22] shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-[#f8fafc] dark:bg-[#1a2632] border-b border-[#dbe0e6] dark:border-[#2b3b4d]">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af]">วันที่</th>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af]">ห้องเรียน</th>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af]">ช่วงเวลา</th>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af]">วัตถุประสงค์</th>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af]">สถานะ</th>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af] text-right">การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#dbe0e6] dark:divide-[#2b3b4d]">
                            <!-- Row 1 -->
                            <tr class="hover:bg-[#f8fafc] dark:hover:bg-[#1a2632] transition-colors">
                                <td class="px-6 py-4 text-[#111418] dark:text-white font-medium">15 ต.ค. 2566</td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white">
                                    <div class="flex flex-col">
                                        <span class="font-medium">ห้องประชุมเล็ก</span>
                                        <span class="text-xs text-[#617589] dark:text-[#9ca3af]">ตึกกิจกรรม ชั้น 2</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white">10:00 - 11:00</td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white truncate max-w-[200px]">ประชุมกลุ่มวิชา GenEd</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                        รออนุมัติ
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-[#617589] hover:text-primary dark:text-[#9ca3af] dark:hover:text-white transition-colors">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                </td>
                            </tr>
                            <!-- Row 2 -->
                            <tr class="hover:bg-[#f8fafc] dark:hover:bg-[#1a2632] transition-colors">
                                <td class="px-6 py-4 text-[#111418] dark:text-white font-medium">14 ต.ค. 2566</td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white">
                                    <div class="flex flex-col">
                                        <span class="font-medium">ห้อง Lab Com 1</span>
                                        <span class="text-xs text-[#617589] dark:text-[#9ca3af]">ตึกคอมพิวเตอร์</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white">13:00 - 16:00</td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white truncate max-w-[200px]">ทำโปรเจกต์จบ</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                        เบิกกุญแจแล้ว
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-[#617589] hover:text-primary dark:text-[#9ca3af] dark:hover:text-white transition-colors">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                </td>
                            </tr>
                            <!-- Row 3 -->
                            <tr class="hover:bg-[#f8fafc] dark:hover:bg-[#1a2632] transition-colors">
                                <td class="px-6 py-4 text-[#111418] dark:text-white font-medium">12 ต.ค. 2566</td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white">
                                    <div class="flex flex-col">
                                        <span class="font-medium">ห้อง 402</span>
                                        <span class="text-xs text-[#617589] dark:text-[#9ca3af]">ตึกเรียนรวม 4</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white">09:00 - 12:00</td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white truncate max-w-[200px]">ติววิชา Calculus</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                        <span class="material-symbols-outlined text-[14px]">check</span>
                                        คืนกุญแจแล้ว
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-[#617589] hover:text-primary dark:text-[#9ca3af] dark:hover:text-white transition-colors">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                </td>
                            </tr>
                            <!-- Row 4 -->
                            <tr class="hover:bg-[#f8fafc] dark:hover:bg-[#1a2632] transition-colors">
                                <td class="px-6 py-4 text-[#111418] dark:text-white font-medium">10 ต.ค. 2566</td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white">
                                    <div class="flex flex-col">
                                        <span class="font-medium">ห้องซ้อมดนตรี 2</span>
                                        <span class="text-xs text-[#617589] dark:text-[#9ca3af]">ศูนย์ศิลปวัฒนธรรม</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white">16:00 - 18:00</td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white truncate max-w-[200px]">ซ้อมดนตรีชมรม</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                        <span class="material-symbols-outlined text-[14px]">check</span>
                                        คืนกุญแจแล้ว
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-[#617589] hover:text-primary dark:text-[#9ca3af] dark:hover:text-white transition-colors">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                </td>
                            </tr>
                            <!-- Row 5 -->
                            <tr class="hover:bg-[#f8fafc] dark:hover:bg-[#1a2632] transition-colors">
                                <td class="px-6 py-4 text-[#111418] dark:text-white font-medium">05 ต.ค. 2566</td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white">
                                    <div class="flex flex-col">
                                        <span class="font-medium">ห้องประชุมใหญ่</span>
                                        <span class="text-xs text-[#617589] dark:text-[#9ca3af]">อาคารอำนวยการ</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white">08:00 - 17:00</td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white truncate max-w-[200px]">จัดกิจกรรมรับน้อง</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                        ยกเลิก
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-[#617589] hover:text-primary dark:text-[#9ca3af] dark:hover:text-white transition-colors">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="flex items-center justify-between px-6 py-4 bg-white dark:bg-[#111a22] border-t border-[#dbe0e6] dark:border-[#2b3b4d]">
                    <p class="text-sm text-[#617589] dark:text-[#9ca3af]">
                        แสดง <span class="font-medium text-[#111418] dark:text-white">1</span> ถึง <span class="font-medium text-[#111418] dark:text-white">5</span> จากทั้งหมด <span class="font-medium text-[#111418] dark:text-white">24</span> รายการ
                    </p>
                    <div class="flex items-center gap-2">
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-[#dbe0e6] dark:border-[#2b3b4d] text-[#617589] dark:text-[#9ca3af] hover:bg-slate-50 dark:hover:bg-[#1a2632] disabled:opacity-50" disabled="">
                            <span class="material-symbols-outlined text-sm">chevron_left</span>
                        </button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-white text-sm font-medium shadow-sm">
                            1
                        </button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-[#dbe0e6] dark:border-[#2b3b4d] text-[#111418] dark:text-white hover:bg-slate-50 dark:hover:bg-[#1a2632] text-sm font-medium">
                            2
                        </button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-[#dbe0e6] dark:border-[#2b3b4d] text-[#111418] dark:text-white hover:bg-slate-50 dark:hover:bg-[#1a2632] text-sm font-medium">
                            3
                        </button>
                        <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-[#dbe0e6] dark:border-[#2b3b4d] text-[#617589] dark:text-[#9ca3af] hover:bg-slate-50 dark:hover:bg-[#1a2632]">
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection