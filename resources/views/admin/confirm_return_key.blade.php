@extends('layouts.themeNew')

@section('content')

<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-col">
        <div class="px-4 md:px-40 flex flex-1 justify-center">
            <div class="layout-content-container flex flex-col w-full max-w-[600px]">

                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-md border border-zinc-100 dark:border-zinc-800 overflow-hidden">
                    
                    {{-- Section 1: สถานะปัจจุบัน --}}
                    <div class="p-6 border-b border-zinc-100 dark:border-zinc-800 bg-orange-50 dark:bg-orange-900/20 flex justify-between items-center">
                        <span class="text-sm font-bold text-[#617589] dark:text-gray-400">สถานะ</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-sm font-bold">
                            {{ $bookings->status }} (รอคืน)
                        </span>
                    </div>

                    <div class="p-6 space-y-6">
                        
                        {{-- ข้อมูลห้อง --}}
                        <div class="flex flex-col gap-1">
                            <span class="text-[#617589] dark:text-gray-400 text-sm">ห้องเรียนที่คืน</span>
                            <span class="text-[#111418] dark:text-white text-2xl font-bold">{{ $rooms->name }}</span>
                            <span class="text-[#617589] dark:text-gray-400 text-sm">ผู้จอง: {{ $bookings->user->name }}</span>
                        </div>

                        <hr class="border-zinc-100 dark:border-zinc-800">

                        <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-100 dark:border-blue-800">
                            <p class="text-xs text-blue-600">เวลาคืนกุญแจ</p>
                            <p class="font-bold text-blue-700 text-xl">
                                {{ now()->format('H:i') }} น.
                            </p>
                        </div>

                        {{-- Form Action --}}
                        <form id="returnForm" action="{{ url('/save_return_key') }}" method="POST">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{ $bookings->id }}">
                            
                            <div class="bg-gray-50 dark:bg-zinc-800 p-4 rounded-xl border border-gray-200 dark:border-zinc-700 mb-6">
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    รหัสยืนยันจากนักศึกษา (Return Code)
                                </label>
                                <div class="flex gap-2">
                                    <input type="text" name="verify_code" maxlength="4" placeholder="0000" required autocomplete="off"
                                        class="w-full text-center text-2xl font-bold tracking-widest h-12 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent text-gray-900 dark:bg-zinc-900 dark:text-white dark:border-zinc-600">
                                </div>
                                <p class="text-xs text-red-500 mt-2">* จำเป็นต้องระบุ: ให้นักศึกษาเปิดดูรหัสในหน้าการจองของตนเอง</p>
                            </div>

                            {{-- Checkbox ยืนยันความเรียบร้อย --}}
                            <div class="flex items-start gap-3 p-3 bg-yellow-50 dark:bg-yellow-900/10 rounded-lg mb-4">
                                <input type="checkbox" id="checkKey" class="mt-1 w-5 h-5 rounded text-primary focus:ring-primary" required>
                                <label for="checkKey" class="text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                                    ฉันได้ตรวจสอบแล้วว่า <b>กุญแจถูกต้อง</b> และได้รับรหัสยืนยันจากนักศึกษาแล้ว
                                </label>
                            </div>
                            
                            <button type="submit" class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-xl h-14 px-4 bg-green-600 hover:bg-green-700 transition-colors text-white text-lg font-bold gap-2 shadow-lg shadow-green-500/30">
                                <span class="material-symbols-outlined text-2xl">check_circle</span>
                                ยืนยันรับคืนกุญแจ
                            </button>
                        </form>

                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>
@endsection