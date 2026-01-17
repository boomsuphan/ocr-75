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
    </style>
<div class="flex flex-col max-w-[1200px] w-full mx-auto p-4 md:p-8 gap-6">
    <div class="w-full max-w-[1280px] flex flex-col gap-8 ">

        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-2 border-b border-gray-200 dark:border-gray-800">
            <div class="flex flex-col gap-2">
                <h2 class="text-3xl lg:text-4xl font-black tracking-tight text-text-main dark:text-white">ประวัติการใช้งาน: IT 401</h2>
                <div class="flex items-center gap-2 text-text-sub dark:text-gray-400">
                    <span class="material-symbols-outlined text-[20px]">location_on</span>
                    <span class="text-base">อาคารคณะวิทยาการคอมพิวเตอร์ ชั้น 4</span>
                </div>
            </div>

        </div>
         
        <div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden flex flex-col">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">วันที่</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">เวลา</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400 ">วิชา / วัตถุประสงค์</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">อาจารย์ผู้สอน</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">สถานะ</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($booking as $item)
                      
                        <tr class="group hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-text-main dark:text-white">
                                    {{ thaidate('j M Y', $item->date_booking) }}
                                </div>
                                <div class="text-xs text-text-sub dark:text-gray-500">{{ thaidate('วันl', $item->date_booking) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2 text-sm text-text-main dark:text-gray-200 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded w-fit">
                                    <span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
                                    {{ substr($item->time_start_booking, 0, 5) }} - {{ substr($item->time_end_booking, 0, 5) }}

                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-text-main dark:text-white"> {{$item->subject }}</div>
                                <div class="text-xs text-text-sub dark:text-gray-400 mt-0.5">{{$item->note }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="text-sm font-medium text-text-main dark:text-gray-200">{{$item->name_professor }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
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
                                <button class="p-2 text-gray-400 hover:text-primary hover:bg-primary/5 rounded-lg transition-colors flex">
                                    <span class="material-symbols-outlined">visibility</span>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
           
        </div>
    </div>
</div>

@endsection