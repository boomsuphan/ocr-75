@extends('layouts.themeNew')

@section('content')
<div class="w-full max-w-[1280px] flex flex-col gap-8">
    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-2 border-b border-gray-200 dark:border-gray-800">
        <div class="flex flex-col gap-2">
            <h2 class="text-3xl lg:text-4xl font-black tracking-tight text-text-main dark:text-white">ประวัติการใช้ห้องเรียน: IT 401</h2>
            <div class="flex items-center gap-2 text-text-sub dark:text-gray-400">
                <span class="material-symbols-outlined text-[20px]">location_on</span>
                <span class="text-base">Computer Science Building, ชั้น 4</span>
            </div>
        </div>
        <!-- <div class="flex gap-3">
            <button class="group flex items-center justify-center gap-2 px-5 h-11 bg-white dark:bg-surface-dark border border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary text-text-main dark:text-white text-sm font-bold rounded-lg transition-all shadow-sm hover:shadow-md">
                <span class="material-symbols-outlined text-[18px] group-hover:-translate-x-0.5 transition-transform">arrow_back</span>
                Back to Status
            </button>
            <button class="flex items-center justify-center gap-2 px-5 h-11 bg-primary hover:bg-primary-dark text-white text-sm font-bold rounded-lg transition-colors shadow-sm shadow-primary/30">
                <span class="material-symbols-outlined text-[18px]">download</span>
                Export Data
            </button>
        </div> -->
    </div>
    <!-- Filters & Search Toolbar -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center bg-surface-light dark:bg-surface-dark p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800">
        <div class="md:col-span-5 relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 material-symbols-outlined">search</span>
            <input class="w-full pl-11 pr-4 h-12 bg-gray-50 dark:bg-background-dark border border-gray-200 dark:border-gray-700 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all placeholder:text-gray-400 text-text-main dark:text-gray-200" placeholder="Search by subject, purpose, or instructor..." type="text" />
        </div>
        <div class="md:col-span-3">
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 material-symbols-outlined">calendar_month</span>
                <select class="w-full pl-11 pr-10 h-12 bg-gray-50 dark:bg-background-dark border border-gray-200 dark:border-gray-700 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary appearance-none cursor-pointer text-text-main dark:text-gray-200">
                    <option>Last 30 Days</option>
                    <option>This Semester</option>
                    <option>Last Semester</option>
                    <option>Custom Range</option>
                </select>
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none material-symbols-outlined">expand_more</span>
            </div>
        </div>
        <div class="md:col-span-3">
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 material-symbols-outlined">filter_list</span>
                <select class="w-full pl-11 pr-10 h-12 bg-gray-50 dark:bg-background-dark border border-gray-200 dark:border-gray-700 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary appearance-none cursor-pointer text-text-main dark:text-gray-200">
                    <option>All Statuses</option>
                    <option>Completed</option>
                    <option>Cancelled</option>
                    <option>No Show</option>
                </select>
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none material-symbols-outlined">expand_more</span>
            </div>
        </div>
        <div class="md:col-span-1 flex justify-end">
            <button class="flex items-center justify-center size-12 bg-gray-50 dark:bg-background-dark border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-text-sub dark:text-gray-400 transition-colors tooltip" title="Reset Filters">
                <span class="material-symbols-outlined">restart_alt</span>
            </button>
        </div>
    </div>
    <!-- Data Table Card -->
    <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px] border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">Time</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400 w-1/3">Subject / Purpose</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">Instructor</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    <!-- Row 1 -->
                    <tr class="group hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-text-main dark:text-white">15 Oct 2023</div>
                            <div class="text-xs text-text-sub dark:text-gray-500">Sunday</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2 text-sm text-text-main dark:text-gray-200 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded w-fit">
                                <span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
                                09:00 - 12:00
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-text-main dark:text-white">CS101 Intro to Programming</div>
                            <div class="text-xs text-text-sub dark:text-gray-400 mt-0.5">Regular Class • Lecture</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="size-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">DS</div>
                                <div class="text-sm font-medium text-text-main dark:text-gray-200">Dr. Somsak</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                Completed
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button class="p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-lg transition-colors">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="group hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-text-main dark:text-white">14 Oct 2023</div>
                            <div class="text-xs text-text-sub dark:text-gray-500">Saturday</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2 text-sm text-text-main dark:text-gray-200 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded w-fit">
                                <span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
                                13:00 - 16:00
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-text-main dark:text-white">CS302 Data Structures</div>
                            <div class="text-xs text-text-sub dark:text-gray-400 mt-0.5">Lab Session</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="size-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs font-bold">PM</div>
                                <div class="text-sm font-medium text-text-main dark:text-gray-200">Prof. Mana</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                Completed
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button class="p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-lg transition-colors">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                        </td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="group hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors bg-gray-50/30 dark:bg-gray-800/20">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-text-main dark:text-white opacity-60">12 Oct 2023</div>
                            <div class="text-xs text-text-sub dark:text-gray-500">Thursday</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-500 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded w-fit opacity-60">
                                <span class="material-symbols-outlined text-[16px]">schedule</span>
                                09:00 - 11:00
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-500 dark:text-gray-400 line-through decoration-red-400 decoration-2">Faculty Meeting</div>
                            <div class="text-xs text-red-500 mt-0.5 font-medium">Reason: Room Maintenance</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3 opacity-60">
                                <div class="size-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center text-xs font-bold">DO</div>
                                <div class="text-sm font-medium text-text-main dark:text-gray-200">Dean's Office</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">
                                <span class="size-1.5 rounded-full bg-red-500"></span>
                                Cancelled
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button class="p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-lg transition-colors">
                                <span class="material-symbols-outlined">info</span>
                            </button>
                        </td>
                    </tr>
                    <!-- Row 4 -->
                    <tr class="group hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-text-main dark:text-white">10 Oct 2023</div>
                            <div class="text-xs text-text-sub dark:text-gray-500">Tuesday</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2 text-sm text-text-main dark:text-gray-200 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded w-fit">
                                <span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
                                09:00 - 12:00
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-text-main dark:text-white">CS101 Intro to Programming</div>
                            <div class="text-xs text-text-sub dark:text-gray-400 mt-0.5">Regular Class • Lecture</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="size-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">DS</div>
                                <div class="text-sm font-medium text-text-main dark:text-gray-200">Dr. Somsak</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                Completed
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button class="p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-lg transition-colors">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                        </td>
                    </tr>
                    <!-- Row 5 -->
                    <tr class="group hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-text-main dark:text-white">08 Oct 2023</div>
                            <div class="text-xs text-text-sub dark:text-gray-500">Sunday</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2 text-sm text-text-main dark:text-gray-200 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded w-fit">
                                <span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
                                13:00 - 15:00
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-text-main dark:text-white">Special Seminar: AI Ethics</div>
                            <div class="text-xs text-text-sub dark:text-gray-400 mt-0.5">Open Event</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="size-8 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-xs font-bold">GS</div>
                                <div class="text-sm font-medium text-text-main dark:text-gray-200">Guest Speaker</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                Completed
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button class="p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-lg transition-colors">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="bg-surface-light dark:bg-surface-dark border-t border-gray-200 dark:border-gray-800 px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-text-sub dark:text-gray-400">
                Showing <span class="font-bold text-text-main dark:text-white">1</span> to <span class="font-bold text-text-main dark:text-white">5</span> of <span class="font-bold text-text-main dark:text-white">128</span> entries
            </div>
            <div class="flex items-center gap-2">
                <button class="px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-500 text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-800 disabled:opacity-50 disabled:cursor-not-allowed" disabled="">
                    Previous
                </button>
                <div class="hidden sm:flex items-center gap-1">
                    <button class="size-8 flex items-center justify-center rounded-lg bg-primary text-white text-sm font-bold">1</button>
                    <button class="size-8 flex items-center justify-center rounded-lg text-text-sub dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-medium transition-colors">2</button>
                    <button class="size-8 flex items-center justify-center rounded-lg text-text-sub dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-medium transition-colors">3</button>
                    <span class="text-gray-400 px-1">...</span>
                    <button class="size-8 flex items-center justify-center rounded-lg text-text-sub dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 text-sm font-medium transition-colors">12</button>
                </div>
                <button class="px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-700 text-text-main dark:text-white text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    Next
                </button>
            </div>
        </div>
    </div>
</div>
@endsection