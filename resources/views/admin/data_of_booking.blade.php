@extends('layouts.themeNew')

@section('content')

<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-col">
        <div class="px-4 md:px-40 flex flex-1 justify-center">
            <div class="layout-content-container flex flex-col w-full max-w-[600px]">

                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.08)] border border-zinc-100 dark:border-zinc-800 overflow-hidden">
                    
                    {{-- Section 1: สถานะ --}}
                    <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/30 flex justify-between items-center">
                        <span class="text-sm font-bold text-[#617589] dark:text-gray-400">สถานะปัจจุบัน</span>
                        @if($bookings->status == 'จองเรียบร้อย')
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-bold">
                                {{ $bookings->status }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-sm font-bold">
                                {{ $bookings->status }}
                            </span>
                        @endif
                    </div>

                    <div class="p-6 space-y-6">
                        
                        {{-- ข้อมูลห้องและเวลา --}}
                        <div>
                            <h3 class="text-[#111418] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">meeting_room</span>
                                ข้อมูลการจอง
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div class="flex flex-col">
                                    <span class="text-[#617589] dark:text-gray-400">ห้องเรียน</span>
                                    <span class="text-[#111418] dark:text-white font-medium">{{ $rooms->name }} (ชั้น {{ $rooms->floor }})</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[#617589] dark:text-gray-400 mb-1">วันที่ เวลา</span>
                                    <span class="text-[#111418] dark:text-white font-medium">
                                        {{ \Carbon\Carbon::parse($bookings->date_booking)->format('d/m/Y') }}
                                    </span>
                                    <span class="text-primary font-bold">
                                        {{ \Carbon\Carbon::parse($bookings->time_start_booking)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($bookings->time_end_booking)->format('H:i') }} น.
                                    </span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[#617589] dark:text-gray-400">วิชา</span>
                                    <span class="text-[#111418] dark:text-white font-medium">{{ $bookings->subject }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[#617589] dark:text-gray-400">อาจารย์</span>
                                    <span class="text-[#111418] dark:text-white font-medium">{{ $bookings->name_professor }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[#617589] dark:text-gray-400">รายละเอียด</span>
                                    <span class="text-[#111418] dark:text-white font-medium">{{ $bookings->note }}</span>
                                </div>
                            </div>
                        </div>

                        <hr class="border-zinc-100 dark:border-zinc-800">

                        {{-- Section 3: ข้อมูลผู้จอง --}}
                        <div>
                            <h3 class="text-[#111418] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">person</span>
                                ผู้จองห้อง
                            </h3>
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xl font-bold text-gray-500">
                                    {{ substr($bookings->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-[#111418] dark:text-white font-bold text-lg">
                                        {{ $bookings->user->name ?? 'User ID: ' . $bookings->user_id }}
                                        <br>
                                        <span class="text-xs px-2 py-0.5 rounded bg-gray-100 text-gray-600 border border-gray-200">
                                            {{ ucfirst($bookings->user->role) }}
                                        </span>
                                    </p>
                                    <p class="text-[#617589] dark:text-gray-400 text-sm">
                                        รหัสนักศึกษา: {{ $bookings->user->std_id ?? ''}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


@endsection