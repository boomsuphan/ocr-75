@extends('layouts.themeNew')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<style>
    .ticket-punch-l, .ticket-punch-r {
        position: absolute; bottom: -12px; width: 24px; height: 24px; border-radius: 50%; z-index: 10;
    }
    .bg-punch-light { background-color: #f6f7f8; }
    .dark .bg-punch-dark { background-color: #101922; }
    
    /* จัดกึ่งกลาง QR Code */
    #qrcode img {
        margin: auto;
    }
</style>

<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-col">
        <div class="px-4 md:px-40 flex flex-1 justify-center">
            <div class="layout-content-container flex flex-col w-full max-w-[480px]">

                @if($bookings->status == 'รับกุญแจแล้ว')
                    <div class="mt-2 mb-2 p-4 bg-blue-50 border border-blue-200 rounded-xl text-center">
                        <p class="text-sm text-blue-600 mb-1">แจ้งรหัสนี้แก่เจ้าหน้าที่เพื่อคืนกุญแจ</p>
                        <p class="text-4xl font-black text-blue-800 tracking-widest">{{ $bookings->return_verify_code }}</p>
                    </div>
                @endif

                <div class="relative flex flex-col rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.08)] bg-white dark:bg-zinc-900 overflow-hidden border border-zinc-100 dark:border-zinc-800">
                    
                    <div class="relative p-2 flex flex-col items-center justify-center bg-white dark:bg-zinc-900 border-b border-dashed border-zinc-200 dark:border-zinc-700">

                        <span class="inline-flex items-center px-3 py-1 mb-2 rounded-full bg-blue-100 text-blue-700 text-sm font-bold">
                            {{ $bookings->status }}
                        </span>

                        <div class="ticket-punch-l -left-3 bg-punch-light dark:bg-punch-dark shadow-[inset_-2px_0_3px_rgba(0,0,0,0.05)]"></div>
                        <div class="ticket-punch-r -right-3 bg-punch-light dark:bg-punch-dark shadow-[inset_2px_0_3px_rgba(0,0,0,0.05)]"></div>
                        
                        <div class="p-3 bg-white rounded-xl border border-zinc-100 shadow-sm mb-4">
                            <div id="qrcode" class="flex justify-center items-center"></div>
                        </div>

                        <p class="text-[#111418] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">กรุณาแสดงต่อเจ้าหน้าที่</p>
                        <p class="text-[#617589] dark:text-gray-400 text-sm mt-1">รหัสการจอง {{ $bookings->code_for_qr }}</p>

                    </div>

                    <div class="p-6 bg-zinc-50/50 dark:bg-zinc-800/50">
                        <div class="space-y-1">
                            <div class="flex justify-between gap-x-6 py-3 border-b border-zinc-100 dark:border-zinc-700/50 last:border-0">
                                <p class="text-[#617589] dark:text-gray-400 text-sm font-normal leading-normal">ผู้จอง</p>
                                {{-- ดึงชื่อผู้จองจาก $data_user --}}
                                <p class="text-[#111418] dark:text-white text-sm font-bold leading-normal text-right">
                                    {{ $data_user->name }}
                                </p>
                            </div>
                            <div class="flex justify-between gap-x-6 py-3 border-b border-zinc-100 dark:border-zinc-700/50 last:border-0">
                                <p class="text-[#617589] dark:text-gray-400 text-sm font-normal leading-normal">ห้องเรียน</p>
                                {{-- ดึงชื่อห้องจาก $rooms --}}
                                <p class="text-[#111418] dark:text-white text-sm font-medium leading-normal text-right">
                                    {{ $rooms->name }} (ชั้น {{ $rooms->floor }})
                                </p>
                            </div>
                            <div class="flex justify-between gap-x-6 py-3 border-b border-zinc-100 dark:border-zinc-700/50 last:border-0">
                                <p class="text-[#617589] dark:text-gray-400 text-sm font-normal leading-normal">วันที่</p>
                                {{-- แปลงวันที่เป็นรูปแบบไทย --}}
                                @php
                                    $date = \Carbon\Carbon::parse($bookings->date_booking);
                                    $thai_months = [
                                        1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน',
                                        5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฎาคม', 8 => 'สิงหาคม',
                                        9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม'
                                    ];
                                    $thai_date = $date->day . ' ' . $thai_months[$date->month] . ' ' . ($date->year + 543);
                                @endphp
                                <p class="text-[#111418] dark:text-white text-sm font-medium leading-normal text-right">
                                    {{ $thai_date }}
                                </p>
                            </div>
                            <div class="flex justify-between gap-x-6 py-3 border-b border-zinc-100 dark:border-zinc-700/50 last:border-0">
                                <p class="text-[#617589] dark:text-gray-400 text-sm font-normal leading-normal">เวลา</p>
                                {{-- ตัดวินาทีออก (:00) เพื่อความสวยงาม --}}
                                <p class="text-primary text-sm font-bold leading-normal text-right">
                                    {{ \Carbon\Carbon::parse($bookings->time_start_booking)->format('H:i') }} - 
                                    {{ \Carbon\Carbon::parse($bookings->time_end_booking)->format('H:i') }} น.
                                </p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button onclick="downloadQR()" class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-primary hover:bg-blue-600 transition-colors text-white text-base font-bold leading-normal gap-2 shadow-md shadow-blue-500/20">
                                <span class="material-symbols-outlined">download</span>
                                <span class="truncate">บันทึก QR Code</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="hidden flex px-4 py-6 justify-center">
                    <a href="{{ url('/booking') }}" class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-6 bg-transparent hover:bg-zinc-100 dark:hover:bg-zinc-800 text-[#617589] dark:text-gray-400 hover:text-[#111418] dark:hover:text-white text-sm font-bold leading-normal tracking-[0.015em] transition-colors gap-2">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        <span class="truncate">กลับสู่หน้าหลัก</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // 1. สร้าง QR Code ทันทีที่โหลดหน้าเว็บ
    window.onload = function() {
        var qrCodeValue = "{{ url('/check_qr') }}/{{ $bookings->code_for_qr }}"; // รับค่าจาก Controller
        
        // สร้าง QR Code
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: qrCodeValue,
            width: 180, // ขนาด QR Code
            height: 180,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    };

    // 2. ฟังก์ชันดาวน์โหลดรูปภาพ
    function downloadQR() {
        // หา element ที่เป็นรูปภาพภายใน div #qrcode
        // qrcode.js จะสร้าง img tag ขึ้นมา
        const qrImage = document.querySelector('#qrcode img');
        
        if (qrImage) {
            // สร้างลิงก์หลอกๆ เพื่อกดดาวน์โหลด
            const link = document.createElement('a');
            link.href = qrImage.src;
            link.download = 'Booking-{{ $bookings->code_for_qr }}.png'; // ชื่อไฟล์ที่จะได้
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } else {
            alert('กำลังสร้าง QR Code กรุณารอสักครู่...');
        }
    }
</script>

@endsection