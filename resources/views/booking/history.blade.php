@extends('layouts.themeNew')

@section('content')

<style>
    /* Custom scrollbar for better aesthetics */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .dark ::-webkit-scrollbar-thumb {
        background: #334155;
    }

    .dark ::-webkit-scrollbar-thumb:hover {
        background: #475569;
    }

    /* Modal Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .modal-hidden {
        display: none;
    }

    /* QR Code Container */
    #qrcode {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #qrcode img {
        max-width: 100%;
        height: auto;
    }
</style>

<!-- เพิ่ม QRCode.js Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

</head>

<div class="flex h-screen w-full overflow-hidden ">
    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col h-full overflow-y-auto bg-background-light dark:bg-background-dark">
        <div class="flex flex-col max-w-[1200px] w-full mx-auto p-4 md:p-8 gap-6">
            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 dark:border-gray-700 pb-4">
                <div class="flex flex-col gap-1">
                    <h1 class="text-[#111418] dark:text-white text-3xl md:text-4xl font-bold tracking-tight">ประวัติการใช้ห้องเรียน</h1>
                    <p class="text-[#617589] dark:text-[#9ca3af] text-base font-normal">ตรวจสอบสถานะการจองและประวัติการใช้งานห้องเรียนของคุณ</p>
                </div>
               
            </div>

            <!-- Filters & Search -->
            <form method="GET" action="{{ url()->current() }}" class="bg-white dark:bg-[#111a22] p-4 rounded-xl border border-[#dbe0e6] dark:border-[#2b3b4d] shadow-sm">
                <div class="flex flex-col md:flex-row gap-4 items-end">
                    <label class="flex flex-col w-full md:flex-1">
                        <p class="text-[#111418] dark:text-white text-sm font-medium pb-1.5">ค้นหาห้อง</p>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#617589] dark:text-[#9ca3af] pointer-events-none">search</span>
                            <input 
                                name="search" 
                                value="{{ request('search') }}"
                                class="form-input w-full rounded-lg border border-[#dbe0e6] dark:border-[#2b3b4d] bg-white dark:bg-[#1a2632] text-[#111418] dark:text-white h-10 pl-10 pr-3 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" 
                                placeholder="ระบุชื่อห้อง หรือ รหัสวิชา..." 
                                type="text" 
                            />
                        </div>
                    </label>
                    <label class="flex flex-col w-full md:w-48">
                        <p class="text-[#111418] dark:text-white text-sm font-medium pb-1.5">สถานะ</p>
                        <select 
                            name="status" 
                            class="form-select w-full rounded-lg border border-[#dbe0e6] dark:border-[#2b3b4d] bg-white dark:bg-[#1a2632] text-[#111418] dark:text-white h-10 px-3 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary cursor-pointer">
                            <option value="">ทั้งหมด</option>
                            <option value="จองเรียบร้อย" {{ request('status') == 'จองเรียบร้อย' ? 'selected' : '' }}>จองเรียบร้อย</option>
                            <option value="รับกุญแจแล้ว" {{ request('status') == 'รับกุญแจแล้ว' ? 'selected' : '' }}>รับกุญแจแล้ว</option>
                            <option value="คืนกุญแจแล้ว" {{ request('status') == 'คืนกุญแจแล้ว' ? 'selected' : '' }}>คืนกุญแจแล้ว</option>
                            <option value="ยกเลิก" {{ request('status') == 'ยกเลิก' ? 'selected' : '' }}>ยกเลิก</option>
                        </select>
                    </label>
                    <label class="flex flex-col w-full md:w-48">
                        <p class="text-[#111418] dark:text-white text-sm font-medium pb-1.5">วันที่</p>
                        <input 
                            name="date" 
                            value="{{ request('date') }}"
                            class="form-input w-full rounded-lg border border-[#dbe0e6] dark:border-[#2b3b4d] bg-white dark:bg-[#1a2632] text-[#111418] dark:text-white h-10 px-3 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary" 
                            type="date" 
                        />
                    </label>
                    <div class="flex gap-2 w-full md:w-auto">
                        <button type="submit" class="flex-1 md:flex-initial h-10 px-6 rounded-lg bg-primary text-white text-sm font-bold hover:bg-blue-600 transition-colors shadow-sm flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">search</span>
                            ค้นหา
                        </button>
                        @if(request()->hasAny(['search', 'status', 'date']))
                        <a href="{{ url()->current() }}" class="h-10 px-4 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-bold hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors shadow-sm flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">close</span>
                            ล้าง
                        </a>
                        @endif
                    </div>
                </div>
            </form>
            <!-- Data Table -->
            <div class="flex flex-col rounded-xl border border-[#dbe0e6] dark:border-[#2b3b4d] bg-white dark:bg-[#111a22] shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-[#f8fafc] dark:bg-[#1a2632] border-b border-[#dbe0e6] dark:border-[#2b3b4d]">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af]">วันที่</th>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af]">ห้องเรียน</th>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af]">ช่วงเวลา</th>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af]">วัตถุประสงค์</th>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af]">สถานะ</th>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af] text-right">การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#dbe0e6] dark:divide-[#2b3b4d]">
                            @foreach($history as $item)
                                <tr class="hover:bg-[#f8fafc] dark:hover:bg-[#1a2632] transition-colors">
                                    <td class="px-6 py-4 text-[#111418] dark:text-white font-medium">{{ thaidate('j M Y', $item->date_booking) }}</td>
                                    <td class="px-6 py-4 text-[#111418] dark:text-white">
                                        <div class="flex flex-col">
                                            <span class="font-medium">ห้อง {{$item->room_name}}</span>
                                            <span class="text-xs text-[#617589] dark:text-[#9ca3af]">ชั้น {{$item->room_floor}}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-[#111418] dark:text-white"> 
                                        {{ \Carbon\Carbon::parse($item->time_start_booking)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($item->time_end_booking)->format('H:i') }}
                                    </td>
                                    <td class="px-6 py-4 text-[#111418] dark:text-white truncate max-w-[200px]">{{$item->note}}</td>
                                    <td class="px-6 py-4">
                                       @switch($item->status)
                                            @case('จองเรียบร้อย')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                                    จองเรียบร้อย
                                                </span>
                                            @break
                                            @case('รับกุญแจแล้ว')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                                    รับกุญแจแล้ว
                                                </span>
                                            @break
                                            @case('คืนกุญแจแล้ว')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                                    <span class="material-symbols-outlined text-[14px]">check</span>
                                                    คืนกุญแจแล้ว
                                                </span>
                                            @break
                                            @case('ยกเลิก')
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                                    ยกเลิก
                                                </span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if($item->status == 'จองเรียบร้อย')
                                        <div class="mt-auto">
                                            <a href="{{url('booking/show_qr/')}}/{{$item->code_for_qr}}"
                                                class="flex w-full items-center justify-center gap-2 rounded-lg py-2.5 bg-primary/10 hover:bg-primary/20 dark:bg-primary/20 dark:hover:bg-primary/30 text-primary font-bold text-sm transition-colors">
                                                <span class="material-symbols-outlined text-[18px]">qr_code</span>
                                                ดู QR Code
                                            </a>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <style>
                    ul.pagination {
                        display: flex;
                        align-items: center;
                        gap: 15px;
                    }

                    ul.pagination li {
                        width: 36px;
                        height: 36px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 12px;
                        color: #8c746a;
                        background: transparent;
                        cursor: pointer;
                        transition: background-color 0.2s ease;
                        font-size: 0.75rem;
                        font-weight: 700;
                    }

                    ul.pagination li:nth-child(1),
                    ul.pagination li:nth-last-child(1) {
                        border: 1px solid #f3e9e5 !important;
                    }

                    ul.pagination li.active {
                        background-color: #137fec;
                        color: #fff;
                    }

                    ul.pagination li.disabled {
                        opacity: 0.5;
                        cursor: not-allowed;
                    }
                </style>
                <!-- Pagination -->
                <div class="flex items-center justify-between px-6 py-4 bg-white dark:bg-[#111a22] border-t border-[#dbe0e6] dark:border-[#2b3b4d]">
                    <p class="text-sm text-[#617589] dark:text-[#9ca3af]">
                        แสดง <span class="font-medium text-[#111418] dark:text-white">{{ $history->firstItem() }}</span> ถึง <span class="font-medium text-[#111418] dark:text-white">{{ $history->lastItem() }}</span> จากทั้งหมด <span class="font-medium text-[#111418] dark:text-white">{{ number_format($history->total()) }}</span> รายการ
                    </p>
                    <div class="flex items-center gap-2">
                      {!! $history->appends(request()->except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>




@endsection