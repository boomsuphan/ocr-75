
@extends('layouts.themeNew')

@section('content')

    <style type="text/tailwindcss">
        @layer base {
            body {
                font-family: 'Manrope', 'Noto Sans Thai', sans-serif;
            }
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
          cursor: pointer;
        }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #3d2f2a;
        }main.items-center{
            align-items: start !important;
        }main.flex{
            display: block !important;
        }
    </style>
<div class="max-w-[1400px] mx-auto p-4 md:p-8 flex flex-col gap-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-1">
            <h1 class="text-4xl font-black tracking-tight text-[#2d2421] dark:text-white">หน้าจัดการสมาชิก</h1>
            <p class="text-[#8c746a] dark:text-gray-400 text-lg">ตรวจสอบคำขอใหม่และบริหารจัดการข้อมูลนักศึกษา</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-xl text-sm font-bold shadow-xl shadow-primary/25 hover:bg-primary-hover transition-all">
                <span class="material-symbols-outlined text-xl">person_add</span>
                เพิ่มสมาชิกใหม่
            </button>
        </div>
    </div>
   
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary text-2xl font-semibold">assignment_late</span>
                <h3 class="text-lg font-bold text-[#2d2421] dark:text-white uppercase tracking-wide">รอการอนุมัติเร่งด่วน <span class="text-primary ml-2 font-black">(12)</span></h3>
            </div>
            <a class="text-sm font-bold text-primary hover:underline" href="#">ดูทั้งหมด</a>
        </div>
        <div class="flex gap-4 overflow-x-auto pb-4 custom-scrollbar snap-x">
            <div class="min-w-[340px] snap-start bg-white dark:bg-[#251d1a] border border-primary/20 rounded-2xl p-4 shadow-sm flex items-center gap-4">
                <div class="size-14 rounded-xl bg-cover bg-center border border-primary/10 shrink-0" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBGoCSymYDRHQQy5hHdxEzLsgKwbaet_ogV04Dsr4FsmGsnoT68Iz1G2hsawhloQSPTzpD9NX76XbZ2QHJwTl9ZACscS2wQg8wnBKyFH4Bv4oyXlQveQM1uywajUXV3hJIVO7xMVnRQiSZDHXOxYrLId2F_RF9EnrJ6EIXMFuwGGlLbXlrypoYNKn1MdMsc4uPBYSSoO3A8hDVKqztYtPi-K9Z23bLS-sESqhyoh4Bg8f0sOhNWyIS18KxeK_ZNaLzRGlFh35mQXSk');"></div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-black text-[#2d2421] dark:text-white truncate">นางสาวสมหญิง รักเรียน</p>
                    <p class="text-[11px] text-primary font-bold">6401002 • วิทยาศาสตร์</p>
                    <div class="flex gap-2 mt-2">
                        <button class="flex-1 py-1.5 bg-accent-red/10 text-accent-red hover:bg-accent-red hover:text-white rounded-lg text-[11px] font-bold transition-all border border-accent-red/20">ปฏิเสธ</button>
                        <button class="flex-1 py-1.5 bg-primary text-white hover:bg-primary-hover rounded-lg text-[11px] font-bold transition-all">อนุมัติ</button>
                    </div>
                </div>
            </div>
            <div class="min-w-[340px] snap-start bg-white dark:bg-[#251d1a] border border-[#f3e9e5] dark:border-[#3d2f2a] rounded-2xl p-4 shadow-sm flex items-center gap-4">
                <div class="size-14 rounded-xl bg-cover bg-center border border-primary/10 shrink-0" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC2yyd82Xg4vktRTWE1Axl5g3FFxTRAU5Uh_D5ygQAPlSLmsZViBFJY10IjZY9XrTHmviH23N2GrdKgLa7LLyMdIRMwmXazrBoGwN8SQ-FdMOdAMRWJ12TpTYjehVDZwoP0Felg9IpE7UOvvSsKC9LlzqBt8yDb7luEcmAiH-NZ48u76QyQFEi9cpG4z99SJnKIZAlPkpVBDUuag6OTmt-TvPFle_TqPax2iJ4LfKUqEXTgkCDDC3nCQyk8TIfwByS_LJBwKQCbnjU');"></div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-black text-[#2d2421] dark:text-white truncate">นางสาวชูใจ ยิ้มแย้ม</p>
                    <p class="text-[11px] text-primary font-bold">6401004 • บริหารธุรกิจ</p>
                    <div class="flex gap-2 mt-2">
                        <button class="flex-1 py-1.5 bg-accent-red/10 text-accent-red hover:bg-accent-red hover:text-white rounded-lg text-[11px] font-bold transition-all border border-accent-red/20">ปฏิเสธ</button>
                        <button class="flex-1 py-1.5 bg-primary text-white hover:bg-primary-hover rounded-lg text-[11px] font-bold transition-all">อนุมัติ</button>
                    </div>
                </div>
            </div>
            <div class="min-w-[340px] snap-start bg-white dark:bg-[#251d1a] border border-[#f3e9e5] dark:border-[#3d2f2a] rounded-2xl p-4 shadow-sm flex items-center gap-4 opacity-80">
                <div class="size-14 rounded-xl bg-[#f7f0ed] dark:bg-[#342a26] flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[#8c746a]">person</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-black text-[#2d2421] dark:text-white truncate">นายมานะ อดทน</p>
                    <p class="text-[11px] text-[#8c746a] font-bold">6401003 • ศิลปศาสตร์</p>
                    <div class="flex gap-2 mt-2">
                        <button class="flex-1 py-1.5 bg-accent-red/10 text-accent-red hover:bg-accent-red hover:text-white rounded-lg text-[11px] font-bold transition-all border border-accent-red/20">ปฏิเสธ</button>
                        <button class="flex-1 py-1.5 bg-primary text-white hover:bg-primary-hover rounded-lg text-[11px] font-bold transition-all">อนุมัติ</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="space-y-6 flex-1">
        <div class="flex flex-col lg:flex-row gap-6 items-center justify-between">
            <h3 class="text-xl font-bold text-[#2d2421] dark:text-white uppercase tracking-wide">สมาชิกที่อนุมัติแล้ว</h3>
            <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
                <div class="relative flex-1 min-w-[300px]">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#8c746a]">search</span>
                    <input class="w-full pl-12 pr-4 py-2.5 bg-white dark:bg-[#251d1a] border border-[#f3e9e5] dark:border-[#3d2f2a] rounded-xl text-sm focus:ring-2 focus:ring-primary/20 transition-all outline-none" placeholder="ค้นหาชื่อ, รหัส หรือ Username..." type="text" />
                </div>
                <div class="flex items-center gap-2">
                    <button class="p-2.5 bg-white dark:bg-[#251d1a] border border-[#f3e9e5] dark:border-[#3d2f2a] rounded-xl text-[#8c746a] hover:text-primary transition-colors shadow-sm">
                        <span class="material-symbols-outlined">filter_list</span>
                    </button>
                    <button class="p-2.5 bg-white dark:bg-[#251d1a] border border-[#f3e9e5] dark:border-[#3d2f2a] rounded-xl text-[#8c746a] hover:text-primary transition-colors shadow-sm">
                        <span class="material-symbols-outlined">sort</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-[#251d1a] rounded-2xl border border-[#f3e9e5] dark:border-[#3d2f2a] overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">ข้อมูลสมาชิก</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">คณะ/สาขา</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">Username</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">สถานะ</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400 text-right">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#f3e9e5] dark:divide-[#3d2f2a]">
                        <tr class="hover:bg-orange-50/30 dark:hover:bg-orange-900/5 transition-colors group">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="size-10 rounded-lg bg-cover bg-center border border-primary/10" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDFDu-ZSXyFtvnD_OLOgSlDrqMW8Cqyh8ldQy8dZGDja5xBeB65RAi9nQGlb-4gPCv6aaDSCGISIggTTHBDbU__TMcs-nBpD17bRqHeZ2_Guw_2M6gM7eAx4ZB6pCYVALS_gKsMFsBGiZ8nFKlR0Y95UOEHcFaQID2noBeXaT2lSPZ38S4xiVwSARWWQuBMG0fxlNZJqwv0QFep4-7EhT9NObqWLT4ep9pGb62yCFXIrNRSAryTZJNj9ZOT7jfOQ9rNGqNMH08xEJY');"></div>
                                    <div>
                                        <p class="text-sm font-bold text-[#2d2421] dark:text-white">นายสมชาย ใจดี</p>
                                        <p class="text-xs text-primary font-medium tracking-tight">ID: 6401001</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 text-[10px] font-bold rounded uppercase">วิศวกรรมศาสตร์</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-[#8c746a]">somchai_j</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-accent-green/10 text-accent-green text-xs font-bold rounded-full">
                                    <span class="size-1.5 bg-accent-green rounded-full"></span>
                                    อนุมัติแล้ว
                                </span>
                            </td>
                            <td class="px-8 py-4 text-right flex justify-end">
                                <div class="flex items-center justify-end gap-1  group-hover:opacity-100 transition-opacity">
                                    <button class="p-2 text-[#8c746a] hover:bg-blue-50 hover:text-blue-500 rounded-lg " title="แก้ไข">
                                        <span class="material-symbols-outlined text-xl">edit</span>
                                    </button>
                                    <button class="p-2 text-[#8c746a] hover:bg-accent-red/10 hover:text-accent-red rounded-lg " title="ลบ">
                                        <span class="material-symbols-outlined text-xl">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-orange-50/30 dark:hover:bg-orange-900/5 transition-colors group">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="size-10 rounded-lg bg-cover bg-center border border-primary/10" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuArE-0296CoVk2w-evrA0R2GkYCVgmgvy2SCsiwajItMwiL1uwF70vdNrdDoE7Qj9V11E7XC-T3r_wZnn57qlQL7wxcWy3tud-TsXLM14QM1OAPtL9DOmAvIVBC7tWRyirULjwMG0p25xF-wy6XGrPAupYlzghaZkWXdCPcfnLmNvArd9FH6jggXYuvs5BVCA_jMAoKeOvl36xvcvdBLz8ZGP-kgfsRF231xvluImSVESJZTGq1Syd5AB_ZwKdm08n-MhxB6t2IDOQ');"></div>
                                    <div>
                                        <p class="text-sm font-bold text-[#2d2421] dark:text-white">นายมานะ อดทน</p>
                                        <p class="text-xs text-primary font-medium tracking-tight">ID: 6401003</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 bg-orange-50 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400 text-[10px] font-bold rounded uppercase">ศิลปศาสตร์</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-[#8c746a]">mana_o</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-accent-green/10 text-accent-green text-xs font-bold rounded-full">
                                    <span class="size-1.5 bg-accent-green rounded-full"></span>
                                    อนุมัติแล้ว
                                </span>
                            </td>
                           <td class="px-8 py-4 text-right flex justify-end">
                                <div class="flex items-center justify-end gap-1  group-hover:opacity-100 transition-opacity">
                                    <button class="p-2 text-[#8c746a] hover:bg-blue-50 hover:text-blue-500 rounded-lg " title="แก้ไข">
                                        <span class="material-symbols-outlined text-xl">edit</span>
                                    </button>
                                    <button class="p-2 text-[#8c746a] hover:bg-accent-red/10 hover:text-accent-red rounded-lg " title="ลบ">
                                        <span class="material-symbols-outlined text-xl">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-surface-light dark:bg-surface-dark border-t border-gray-200 dark:border-gray-800 px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-[11px] font-bold text-[#8c746a] uppercase tracking-wider">แสดง 1 ถึง 10 จากทั้งหมด 1,228 สมาชิก</p>
                <div class="flex items-center gap-1.5">
                    <button class="size-9 flex items-center justify-center rounded-xl border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#8c746a] hover:bg-white dark:hover:bg-[#342a26] disabled:opacity-50" disabled="">
                        <span class="material-symbols-outlined text-lg">chevron_left</span>
                    </button>
                    <button class="size-9 flex items-center justify-center rounded-xl bg-primary text-white text-xs font-black shadow-lg shadow-primary/20">1</button>
                    <button class="size-9 flex items-center justify-center rounded-xl border border-transparent text-[#8c746a] hover:bg-white dark:hover:bg-[#342a26] text-xs font-bold">2</button>
                    <button class="size-9 flex items-center justify-center rounded-xl border border-transparent text-[#8c746a] hover:bg-white dark:hover:bg-[#342a26] text-xs font-bold">3</button>
                    <span class="px-1 text-[#8c746a]">...</span>
                    <button class="size-9 flex items-center justify-center rounded-xl border border-transparent text-[#8c746a] hover:bg-white dark:hover:bg-[#342a26] text-xs font-bold">123</button>
                    <button class="size-9 flex items-center justify-center rounded-xl border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#8c746a] hover:bg-white dark:hover:bg-[#342a26]">
                        <span class="material-symbols-outlined text-lg">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection