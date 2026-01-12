@extends('layouts.themeNew')

@section('content')

<style>
    /* Custom Ticket Punch Holes */
    .ticket-punch-l,
    .ticket-punch-r {
        position: absolute;
        bottom: -12px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        z-index: 10;
    }

    /* Color matching background-light */
    .bg-punch-light {
        background-color: #f6f7f8;
    }

    /* Color matching background-dark for dark mode support */
    .dark .bg-punch-dark {
        background-color: #101922;
    }
</style>

<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">

    <!-- Main Content Layout -->
    <div class="layout-container flex h-full grow flex-col">
        <div class="px-4 md:px-40 flex flex-1 justify-center py-10">
            <div class="layout-content-container flex flex-col w-full max-w-[480px]">
                <!-- PageHeading: Success Message -->
                <div class="flex flex-col gap-3 p-4 text-center mb-2">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-500 mb-2">
                        <span class="material-symbols-outlined text-4xl">check_circle</span>
                    </div>
                    <h1 class="text-[#111418] dark:text-white text-3xl font-black leading-tight tracking-[-0.033em]">การจองสำเร็จ!</h1>
                    <p class="text-[#617589] dark:text-gray-400 text-base font-normal leading-normal">การจองห้องเรียนของคุณได้รับการยืนยันแล้ว</p>
                </div>
                <!-- Ticket Card Component -->
                <div class="relative flex flex-col rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.08)] bg-white dark:bg-zinc-900 overflow-hidden border border-zinc-100 dark:border-zinc-800">
                    <!-- Top Section: QR Code -->
                    <div class="relative p-8 flex flex-col items-center justify-center bg-white dark:bg-zinc-900 border-b border-dashed border-zinc-200 dark:border-zinc-700">
                        <!-- Punch Holes Effect -->
                        <div class="ticket-punch-l -left-3 bg-punch-light dark:bg-punch-dark shadow-[inset_-2px_0_3px_rgba(0,0,0,0.05)]"></div>
                        <div class="ticket-punch-r -right-3 bg-punch-light dark:bg-punch-dark shadow-[inset_2px_0_3px_rgba(0,0,0,0.05)]"></div>
                        <div class="p-3 bg-white rounded-xl border border-zinc-100 shadow-sm mb-4">
                            <img alt="QR Code for Key Pickup" class="size-48 object-contain mix-blend-multiply dark:mix-blend-normal" data-alt="Black and white QR code pattern for booking verification" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBzZabFqDeX7QySOOe12pV3EKnq0hn_X7uqt5jyRJN5QrVvbBRCAIVoJR_bULFRDOC-0AVObY7Ii9O1E-QVCro-WvcCxacCixw71KeknthDUHNQql65KzGmDdX_Hi6FchMWKWWYzhzZjcXDWS97tT45y1fESRr-M2q76F51yM_9Zez2xbZJKuk8aGWP5yAQuo83koqSYj9D4HHNmsddRqGUTle79jxdAbU2S_vBjB5tByo8L29cOxksCQACt39aofps3_yXZe7wS9s" />
                        </div>
                        <p class="text-[#111418] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">QR Code สำหรับเบิกกุญแจ</p>
                        <p class="text-[#617589] dark:text-gray-400 text-sm mt-1">กรุณาแสดงต่อเจ้าหน้าที่</p>
                    </div>
                    <!-- Bottom Section: DescriptionList -->
                    <div class="p-6 bg-zinc-50/50 dark:bg-zinc-800/50">
                        <div class="space-y-1">
                            <div class="flex justify-between gap-x-6 py-3 border-b border-zinc-100 dark:border-zinc-700/50 last:border-0">
                                <p class="text-[#617589] dark:text-gray-400 text-sm font-normal leading-normal">ผู้จอง</p>
                                <p class="text-[#111418] dark:text-white text-sm font-bold leading-normal text-right">นายสมชาย ดวงดี</p>
                            </div>
                            <div class="flex justify-between gap-x-6 py-3 border-b border-zinc-100 dark:border-zinc-700/50 last:border-0">
                                <p class="text-[#617589] dark:text-gray-400 text-sm font-normal leading-normal">ห้องเรียน</p>
                                <p class="text-[#111418] dark:text-white text-sm font-medium leading-normal text-right">Lab Com 402 (อาคาร 4)</p>
                            </div>
                            <div class="flex justify-between gap-x-6 py-3 border-b border-zinc-100 dark:border-zinc-700/50 last:border-0">
                                <p class="text-[#617589] dark:text-gray-400 text-sm font-normal leading-normal">วันที่</p>
                                <p class="text-[#111418] dark:text-white text-sm font-medium leading-normal text-right">14 ตุลาคม 2566</p>
                            </div>
                            <div class="flex justify-between gap-x-6 py-3 border-b border-zinc-100 dark:border-zinc-700/50 last:border-0">
                                <p class="text-[#617589] dark:text-gray-400 text-sm font-normal leading-normal">เวลา</p>
                                <p class="text-primary text-sm font-bold leading-normal text-right">09:00 - 12:00 น.</p>
                            </div>
                        </div>
                        <!-- SingleButton: Primary Action -->
                        <div class="mt-6">
                            <button class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-primary hover:bg-blue-600 transition-colors text-white text-base font-bold leading-normal gap-2 shadow-md shadow-blue-500/20">
                                <span class="material-symbols-outlined">download</span>
                                <span class="truncate">บันทึกรูปภาพ</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- SingleButton: Secondary Action -->
                <div class="flex px-4 py-6 justify-center">
                    <button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-6 bg-transparent hover:bg-zinc-100 dark:hover:bg-zinc-800 text-[#617589] dark:text-gray-400 hover:text-[#111418] dark:hover:text-white text-sm font-bold leading-normal tracking-[0.015em] transition-colors gap-2">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        <span class="truncate">กลับสู่หน้าหลัก</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection