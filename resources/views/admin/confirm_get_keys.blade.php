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
                        
                        {{-- Section 2: ข้อมูลห้องและเวลา --}}
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
                                    {{-- Label: วันที่ เวลา (อยู่บรรทัดบนเหมือนเดิม) --}}
                                    <span class="text-[#617589] dark:text-gray-400 mb-1">วันที่ เวลา</span>

                                    @php
                                        $date = \Carbon\Carbon::parse($bookings->date_booking);
                                        $thai_months = [1=>'ม.ค.',2=>'ก.พ.',3=>'มี.ค.',4=>'เม.ย.',5=>'พ.ค.',6=>'มิ.ย.',7=>'ก.ค.',8=>'ส.ค.',9=>'ก.ย.',10=>'ต.ค.',11=>'พ.ย.',12=>'ธ.ค.'];
                                        $date_str = $date->day . ' ' . $thai_months[$date->month] . ' ' . ($date->year + 543);
                                    @endphp

                                    {{-- Content: วันที่ และ เวลา (จัดให้อยู่บรรทัดเดียวกัน) --}}
                                    <div class="flex flex-wrap items-center gap-2">
                                        {{-- ส่วนวันที่ --}}
                                        <span class="text-[#111418] dark:text-white font-medium">
                                            {{ $date_str }}
                                        </span>

                                        {{-- ส่วนเวลา --}}
                                        <span class="text-primary font-bold">
                                            {{ \Carbon\Carbon::parse($bookings->time_start_booking)->format('H:i') }} - 
                                            {{ \Carbon\Carbon::parse($bookings->time_end_booking)->format('H:i') }} น.
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[#617589] dark:text-gray-400">วิชา</span>
                                    <span class="text-[#111418] dark:text-white font-medium">{{ $bookings->subject }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[#617589] dark:text-gray-400">อาจารย์</span>
                                    <span class="text-[#111418] dark:text-white font-medium">{{ $bookings->name_professor }}</span>
                                </div>
                            </div>
                        </div>

                        <hr class="border-zinc-100 dark:border-zinc-800">

                        {{-- Section 3: ข้อมูลผู้จอง (ดึงจาก Relation หรือ User ID) --}}
                        <div>
                            <h3 class="text-[#111418] dark:text-white text-lg font-bold mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">person</span>
                                ผู้ขอเบิกกุญแจ
                            </h3>
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xl font-bold text-gray-500">
                                    {{ substr($bookings->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-[#111418] dark:text-white font-bold text-lg">
                                        {{ $bookings->user->name ?? 'User ID: ' . $bookings->user_id }}
                                    </p>
                                    <p class="text-[#617589] dark:text-gray-400 text-sm">
                                        รหัสการจอง: {{ $bookings->code_for_qr }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <hr class="border-zinc-100 dark:border-zinc-800">

                        {{-- Section 4: ข้อมูลเจ้าหน้าที่ (ผู้ทำรายการ) --}}
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-100 dark:border-blue-800">
                            <h3 class="text-[#111418] dark:text-white text-sm font-bold mb-2 flex items-center gap-2">
                                <span class="material-symbols-outlined text-blue-600 text-lg">badge</span>
                                เจ้าหน้าที่ผู้ทำรายการ
                            </h3>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-[#111418] dark:text-white font-medium">{{ $data_user->name }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Form Action --}}
                        <form action="{{ url('/save_give_key') }}" method="POST" class="mt-6">
                            @csrf
                            {{-- ส่ง ID Booking ไป --}}
                            <input type="hidden" name="booking_id" value="{{ $bookings->id }}">
                            {{-- ส่ง ID Officer ไป (จริงๆ ใช้ Auth::id() ใน Controller ปลอดภัยกว่า แต่ส่งไปเพื่อความชัดเจนตามโจทย์) --}}
                            <input type="hidden" name="id_officer_give_key" value="{{ $data_user->id }}">

                            @if($bookings->status == 'จองเรียบร้อย')
                                <button type="submit" class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-xl h-14 px-4 bg-primary hover:bg-blue-600 transition-colors text-white text-lg font-bold gap-2 shadow-lg shadow-blue-500/30">
                                    <span class="material-symbols-outlined text-2xl">vpn_key</span>
                                    ยืนยันการส่งมอบกุญแจ
                                </button>
                            @else
                                <div class="text-center p-3 bg-red-50 text-red-600 rounded-lg border border-red-100">
                                    <p class="font-bold">ไม่สามารถทำรายการได้</p>
                                    <p class="text-sm">เนื่องจากสถานะปัจจุบันคือ "{{ $bookings->status }}"</p>
                                </div>
                                <a href="{{ url('/booking') }}" class="block text-center mt-4 text-gray-500 hover:text-gray-700 underline">กลับสู่หน้าหลัก</a>
                            @endif
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection