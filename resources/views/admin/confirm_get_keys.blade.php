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

                        <hr class="border-zinc-100 dark:border-zinc-800">

                        {{-- Form Action: ยืนยันการส่งมอบ --}}
                        <form action="{{ url('/save_give_key') }}" method="POST" class="mt-6" id="giveKeyForm">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{ $bookings->id }}">
                            <input type="hidden" name="id_officer_give_key" value="{{ Auth::id() }}">

                            @if($bookings->status == 'จองเรียบร้อย')
                                
                                {{-- === เงื่อนไขข้อ 2: หากผู้จองเป็น Admin หรือ Officer === --}}
                                @if(in_array($bookings->user->role, ['admin', 'officer']))
                                    <div class="bg-yellow-50 dark:bg-yellow-900/10 border border-yellow-200 dark:border-yellow-800 rounded-xl p-4 mb-4">
                                        <div class="flex items-start gap-3 mb-3">
                                            <span class="material-symbols-outlined text-yellow-600 mt-1">info</span>
                                            <div>
                                                <p class="text-sm font-bold text-yellow-800 dark:text-yellow-500">
                                                    เนื่องจากผู้จองคือ {{ ucfirst($bookings->user->role) }}
                                                </p>
                                                <p class="text-xs text-yellow-700 dark:text-yellow-600">
                                                    กรุณาระบุรหัสนักศึกษา หรือผู้ที่มารับกุญแจแทน
                                                </p>
                                            </div>
                                        </div>

                                        <div class="space-y-3">
                                            {{-- Input รหัสนักศึกษา --}}
                                            <div>
                                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">
                                                    รหัสนักศึกษาผู้มารับกุญแจ <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" name="picker_std_id" id="picker_std_id" required
                                                    class="w-full h-10 px-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-transparent text-sm bg-white dark:bg-zinc-800 dark:border-zinc-600 dark:text-white"
                                                    placeholder="เช่น 64xxxxxx">
                                            </div>

                                            {{-- Checkbox รับเอง --}}
                                            <div class="flex items-center gap-2">
                                                <input type="checkbox" id="is_self_pickup" name="is_self_pickup" value="1"
                                                    class="w-4 h-4 text-yellow-600 rounded focus:ring-yellow-500 border-gray-300"
                                                    onchange="togglePickerInput()">
                                                <label for="is_self_pickup" class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer select-none">
                                                    ฉันเป็นผู้เบิกกุญแจด้วยตนเอง (เจ้าของบัญชี)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- ปุ่มยืนยัน (กดได้ปกติ) --}}
                                <button type="submit" class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-xl h-14 px-4 bg-primary hover:bg-blue-600 transition-colors text-white text-lg font-bold gap-2 shadow-lg shadow-blue-500/30">
                                    <span class="material-symbols-outlined text-2xl">vpn_key</span>
                                    ยืนยันการส่งมอบกุญแจ
                                </button>

                            @else
                                <div class="text-center p-3 bg-red-50 text-red-600 rounded-lg border border-red-100">
                                    <p class="font-bold">ไม่สามารถทำรายการได้</p>
                                    <p class="text-sm">เนื่องจากสถานะปัจจุบันคือ "{{ $bookings->status }}"</p>
                                </div>
                                <a href="{{ url('/scan_qr') }}" class="block text-center mt-4 text-gray-500 hover:text-gray-700 underline">กลับสู่หน้าสแกน</a>
                            @endif
                        </form>

                    </div>
                </div>

                {{-- ปุ่มยกเลิกการจอง (ปรับตาม Requirement) --}}
                @if( Auth::user()->role == "admin" || Auth::user()->role == "officer" )
                    @if($bookings->status == 'จองเรียบร้อย')
                    <div class="mt-6 flex justify-center">
                        <form action="{{ url('/cancel_booking') }}" method="POST" onsubmit="return confirm('ยืนยันที่จะยกเลิกการจองนี้ใช่หรือไม่?');">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{ $bookings->id }}">
                            <input type="hidden" name="cancelled_by" value="{{ Auth::id() }}">
                            
                            <button type="submit" class="flex items-center gap-2 px-6 py-2.5 rounded-lg border border-red-200 bg-red-50 hover:bg-red-100 text-red-600 transition-colors text-sm font-bold">
                                <span class="material-symbols-outlined text-lg">cancel</span>
                                ยกเลิกการจอง (Cancel)
                            </button>
                        </form>
                    </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>

<script>
    function togglePickerInput() {
        const checkbox = document.getElementById('is_self_pickup');
        const input = document.getElementById('picker_std_id');

        if (checkbox.checked) {
            // กรณีติ๊ก "รับเอง" -> ปิด Input และไม่ต้อง Validate
            input.disabled = true;
            input.required = false;
            input.value = ''; // ล้างค่า
            input.classList.add('bg-gray-100', 'cursor-not-allowed');
            input.placeholder = 'ระบุว่าเป็นเจ้าของบัญชีรับเอง';
        } else {
            // กรณีไม่ติ๊ก -> ต้องกรอก
            input.disabled = false;
            input.required = true;
            input.classList.remove('bg-gray-100', 'cursor-not-allowed');
            input.placeholder = 'เช่น 64xxxxxx';
        }
    }
</script>

@endsection