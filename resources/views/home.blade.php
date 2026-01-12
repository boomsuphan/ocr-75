@extends('layouts.themeNew')

@section('content')

<div class="relative flex min-h-screen w-full flex-col group/design-root">

    <main class="layout-container flex h-full grow flex-col px-4 md:px-10 lg:px-20 py-8">
        <div class="mx-auto w-full max-w-[1200px] flex flex-col gap-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex flex-col gap-2">
                    <h1 class="text-[#111418] dark:text-white text-3xl md:text-4xl font-bold leading-tight tracking-[-0.033em]">ตารางการใช้ห้องเรียน</h1>
                    <div class="flex items-center gap-2 text-[#617589] dark:text-gray-400 text-sm font-normal">
                        <span class="material-symbols-outlined text-lg">calendar_today</span>
                        <span>วันศุกร์ที่ 27 ตุลาคม 2566</span>
                        <span class="mx-1">•</span>
                        <span class="material-symbols-outlined text-lg">schedule</span>
                        <span class="text-primary font-medium">10:30 น. (กำลังใช้งาน)</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-6 px-2">
                <div class="flex items-center gap-2">
                    <span class="block w-3 h-3 rounded-full bg-green-500"></span>
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-300">ว่าง</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="block w-3 h-3 rounded-full bg-red-500"></span>
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-300">ไม่ว่าง</span>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-[#1e2732] rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                    <div class="p-6 flex-grow">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-blue-50 dark:bg-blue-900/20 text-primary">
                                <span class="material-symbols-outlined text-2xl">computer</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 dark:bg-green-900/20 px-3 py-1 text-xs font-bold text-green-600 dark:text-green-400 border border-green-100 dark:border-green-800">
                                <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                ว่าง
                            </span>
                        </div>
                        <h3 class="font-bold text-[#111418] dark:text-white text-xl mb-1">IT 401</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Computer Lab • Cap: 30</p>
                        <div class="flex flex-col gap-2 mt-auto">
                            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="material-symbols-outlined text-base">nest_cam_indoor</span>
                                <span>Projector, AC</span>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-800/50">
                        <button class="w-full h-10 rounded-lg bg-primary hover:bg-blue-600 text-white text-sm font-bold shadow-sm transition-colors flex items-center justify-center gap-2">
                            <span>จองห้อง</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </button>
                    </div>
                </div>
                <div class="bg-white dark:bg-[#1e2732] rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                    <div class="p-6 flex-grow">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-purple-50 dark:bg-purple-900/20 text-purple-600">
                                <span class="material-symbols-outlined text-2xl">podium</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 dark:bg-green-900/20 px-3 py-1 text-xs font-bold text-green-600 dark:text-green-400 border border-green-100 dark:border-green-800">
                                <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                ว่าง
                            </span>
                        </div>
                        <h3 class="font-bold text-[#111418] dark:text-white text-xl mb-1">IT 402</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Lecture Hall • Cap: 60</p>
                        <div class="flex flex-col gap-2 mt-auto">
                            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="material-symbols-outlined text-base">mic</span>
                                <span>Mic System, Stage</span>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-800/50">
                        <button class="w-full h-10 rounded-lg bg-primary hover:bg-blue-600 text-white text-sm font-bold shadow-sm transition-colors flex items-center justify-center gap-2">
                            <span>จองห้อง</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </button>
                    </div>
                </div>
                <div class="bg-white dark:bg-[#1e2732] rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col hover:shadow-md transition-shadow opacity-90">
                    <div class="p-6 flex-grow">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-orange-50 dark:bg-orange-900/20 text-orange-600">
                                <span class="material-symbols-outlined text-2xl">groups</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 dark:bg-red-900/20 px-3 py-1 text-xs font-bold text-red-600 dark:text-red-400 border border-red-100 dark:border-red-800">
                                <span class="h-2 w-2 rounded-full bg-red-500"></span>
                                ไม่ว่าง
                            </span>
                        </div>
                        <h3 class="font-bold text-[#111418] dark:text-white text-xl mb-1">IT 403</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Seminar Room • Cap: 15</p>
                        <div class="flex flex-col gap-2 mt-auto">
                            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="material-symbols-outlined text-base">tv</span>
                                <span>Smart TV, Whiteboard</span>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-800/50">
                        <button class="w-full h-10 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 text-sm font-bold cursor-not-allowed border border-transparent flex items-center justify-center gap-2" disabled="">
                            <span>ห้องเต็ม</span>
                        </button>
                    </div>
                </div>
                <div class="bg-white dark:bg-[#1e2732] rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col hover:shadow-md transition-shadow opacity-90">
                    <div class="p-6 flex-grow">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-blue-50 dark:bg-blue-900/20 text-primary">
                                <span class="material-symbols-outlined text-2xl">computer</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 dark:bg-red-900/20 px-3 py-1 text-xs font-bold text-red-600 dark:text-red-400 border border-red-100 dark:border-red-800">
                                <span class="h-2 w-2 rounded-full bg-red-500"></span>
                                ไม่ว่าง
                            </span>
                        </div>
                        <h3 class="font-bold text-[#111418] dark:text-white text-xl mb-1">IT 404</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Computer Lab • Cap: 30</p>
                        <div class="flex flex-col gap-2 mt-auto">
                            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="material-symbols-outlined text-base">construction</span>
                                <span>Under Maintenance</span>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-800/50">
                        <button class="w-full h-10 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 text-sm font-bold cursor-not-allowed border border-transparent flex items-center justify-center gap-2" disabled="">
                            <span>ไม่ว่าง</span>
                        </button>
                    </div>
                </div>
                <div class="bg-white dark:bg-[#1e2732] rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                    <div class="p-6 flex-grow">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600">
                                <span class="material-symbols-outlined text-2xl">science</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 dark:bg-green-900/20 px-3 py-1 text-xs font-bold text-green-600 dark:text-green-400 border border-green-100 dark:border-green-800">
                                <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                ว่าง
                            </span>
                        </div>
                        <h3 class="font-bold text-[#111418] dark:text-white text-xl mb-1">IT 405</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Physics Lab • Cap: 25</p>
                        <div class="flex flex-col gap-2 mt-auto">
                            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="material-symbols-outlined text-base">science</span>
                                <span>Lab Equipment</span>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-800/50">
                        <button class="w-full h-10 rounded-lg bg-primary hover:bg-blue-600 text-white text-sm font-bold shadow-sm transition-colors flex items-center justify-center gap-2">
                            <span>จองห้อง</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </button>
                    </div>
                </div>
                <div class="bg-white dark:bg-[#1e2732] rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                    <div class="p-6 flex-grow">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-teal-50 dark:bg-teal-900/20 text-teal-600">
                                <span class="material-symbols-outlined text-2xl">meeting_room</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 dark:bg-green-900/20 px-3 py-1 text-xs font-bold text-green-600 dark:text-green-400 border border-green-100 dark:border-green-800">
                                <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                ว่าง
                            </span>
                        </div>
                        <h3 class="font-bold text-[#111418] dark:text-white text-xl mb-1">IT 406</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Study Room • Cap: 8</p>
                        <div class="flex flex-col gap-2 mt-auto">
                            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="material-symbols-outlined text-base">quiet_time</span>
                                <span>Quiet Zone</span>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-800/50">
                        <button class="w-full h-10 rounded-lg bg-primary hover:bg-blue-600 text-white text-sm font-bold shadow-sm transition-colors flex items-center justify-center gap-2">
                            <span>จองห้อง</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection