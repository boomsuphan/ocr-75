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

</head>

<div class="flex h-screen w-full overflow-hidden ">
    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col h-full overflow-y-auto bg-background-light dark:bg-background-dark">
        <div class="flex flex-col max-w-[1200px] w-full mx-auto p-4 md:p-8 gap-6">
            <!-- Page Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 dark:border-gray-700 pb-4">
                <div class="flex flex-col gap-1">
                    <h1 class="text-[#111418] dark:text-white text-3xl md:text-4xl font-bold tracking-tight">จัดการห้องเรียน</h1>
                    <p class="text-[#617589] dark:text-[#9ca3af] text-base font-normal">ตรวจสอบสถานะห้องและประวัติการใช้งานห้องเรียน</p>
                </div>

            </div>


            <!-- Data Table -->
            <div class="flex flex-col rounded-xl border border-[#dbe0e6] dark:border-[#2b3b4d] bg-white dark:bg-[#111a22] shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-[#f8fafc] dark:bg-[#1a2632] border-b border-[#dbe0e6] dark:border-[#2b3b4d]">
                            <tr>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af]">ห้องเรียน</th>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af]">ชั้น</th>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af]">สถานะ</th>
                                <th class="px-6 py-4 font-semibold text-[#617589] dark:text-[#9ca3af] text-right">การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#dbe0e6] dark:divide-[#2b3b4d]">
                            @foreach($room as $item)
                            <!-- <tr class="hover:bg-[#f8fafc] dark:hover:bg-[#1a2632] transition-colors">
                                <td class="px-6 py-4 text-[#111418] dark:text-white font-medium">{{$item->name}}</td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-[#617589] dark:text-[#9ca3af]">ชั้น {{$item->floor}}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white">
                                    {{$item->status}}
                                </td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white truncate max-w-[200px]">{{$item->note}}</td>

                                <td></td>
                            </tr> -->

                             <tr class="hover:bg-[#f8fafc] dark:hover:bg-[#1a2632] transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-primary">computer</span>
                                        <span class="text-[#111418] dark:text-white font-bold">{{$item->name}}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-[#111418] dark:text-white">ชั้น {{$item->floor}}</td>
                                <td class="px-6 py-4">
                                    @if($item->status == 'Active')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                        เปิดใช้งาน
                                    </span>
                                    @else
                                       <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                            ปิดใช้งาน
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($item->status == 'Active')
                                    
                                        <a  href="{{url('create_booking')}}/{{$item->id}}" class="flex items-center cursor-pointer h-8 px-3 rounded bg-primary text-white text-xs font-bold hover:bg-blue-600 transition-colors">จองห้อง</a>
                                        @endif
                                        <a href="{{url('room_detail')}}/{{$item->id}}" class="flex items-center cursor-pointer h-8 px-3 rounded border border-[#dbe0e6] dark:border-[#2b3b4d] text-[#111418] dark:text-white text-xs font-medium hover:bg-slate-50 dark:hover:bg-[#23303d] transition-colors">ดูประวัติห้อง</a>
                                    </div>
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
            </div>
        </div>
    </main>
</div>




@endsection