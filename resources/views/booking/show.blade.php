@extends('layouts.themeNew')

@section('content')
    <div class="w-full max-w-[1280px] mx-auto px-4 sm:px-6 py-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            
            <div class="flex items-center gap-4">
                <a href="{{ url('/booking') }}" 
                   class="flex items-center justify-center w-10 h-10 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-primary hover:border-primary transition-colors shadow-sm"
                   title="ย้อนกลับ">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                </a>
                <div class="flex flex-col">
                    <h1 class="text-[#111418] dark:text-white text-2xl font-bold leading-tight">
                        รายละเอียดการจอง #{{ $booking->id }}
                    </h1>
                    <span class="text-sm text-gray-500 dark:text-gray-400">View Booking Details</span>
                </div>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a href="{{ url('/booking/' . $booking->id . '/edit') }}" 
                   class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 text-[#111418] dark:text-white font-medium rounded-lg transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">edit</span>
                    <span>แก้ไข</span>
                </a>

                <form method="POST" action="{{ url('booking' . '/' . $booking->id) }}" accept-charset="UTF-8" style="display:inline" class="flex-1 sm:flex-none">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" 
                            class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/40 text-red-600 dark:text-red-400 font-medium rounded-lg transition-colors border border-transparent hover:border-red-200 dark:border-red-800"
                            title="Delete Booking" 
                            onclick="return confirm('Confirm delete?')">
                        <span class="material-symbols-outlined text-[20px]">delete</span>
                        <span>ลบ</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white dark:bg-[#1a2632] rounded-xl border border-[#dce0e5] dark:border-gray-800 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-[#dce0e5] dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50">
                <h3 class="text-base font-semibold leading-7 text-[#111418] dark:text-white">ข้อมูลการจองห้องเรียน</h3>
                <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500 dark:text-gray-400">รายละเอียดข้อมูลทั้งหมดของรายการนี้</p>
            </div>
            
            <div class="border-t border-[#dce0e5] dark:border-gray-800">
                <dl class="divide-y divide-[#dce0e5] dark:divide-gray-800">
                    
                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ID</dt>
                        <dd class="mt-1 text-sm text-[#111418] dark:text-gray-200 sm:mt-0 sm:col-span-2">{{ $booking->id }}</dd>
                    </div>

                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Room ID</dt>
                        <dd class="mt-1 text-sm text-[#111418] dark:text-gray-200 sm:mt-0 sm:col-span-2">{{ $booking->room_id }}</dd>
                    </div>
                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">User ID</dt>
                        <dd class="mt-1 text-sm text-[#111418] dark:text-gray-200 sm:mt-0 sm:col-span-2">{{ $booking->user_id }}</dd>
                    </div>

                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Subject</dt>
                        <dd class="mt-1 text-sm font-semibold text-[#111418] dark:text-gray-200 sm:mt-0 sm:col-span-2">{{ $booking->subject }}</dd>
                    </div>
                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Professor</dt>
                        <dd class="mt-1 text-sm text-[#111418] dark:text-gray-200 sm:mt-0 sm:col-span-2">{{ $booking->name_professor }}</dd>
                    </div>

                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Semester</dt>
                        <dd class="mt-1 text-sm text-[#111418] dark:text-gray-200 sm:mt-0 sm:col-span-2">{{ $booking->semester }}</dd>
                    </div>
                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date Booking</dt>
                        <dd class="mt-1 text-sm text-[#111418] dark:text-gray-200 sm:mt-0 sm:col-span-2">{{ $booking->date_booking }}</dd>
                    </div>
                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Time (Start - End)</dt>
                        <dd class="mt-1 text-sm text-[#111418] dark:text-gray-200 sm:mt-0 sm:col-span-2">
                            {{ $booking->time_start_booking }} - {{ $booking->time_end_booking }}
                        </dd>
                    </div>

                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Key Pick-up</dt>
                        <dd class="mt-1 text-sm text-[#111418] dark:text-gray-200 sm:mt-0 sm:col-span-2">
                            เวลา: {{ $booking->time_get_key ?: '-' }} 
                            <span class="text-gray-400 mx-2">|</span> 
                            จนท.: {{ $booking->id_officer_give_key ?: '-' }}
                        </dd>
                    </div>
                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Key Return</dt>
                        <dd class="mt-1 text-sm text-[#111418] dark:text-gray-200 sm:mt-0 sm:col-span-2">
                            เวลา: {{ $booking->time_return_key ?: '-' }} 
                            <span class="text-gray-400 mx-2">|</span> 
                            จนท.: {{ $booking->id_officer_return_key ?: '-' }}
                        </dd>
                    </div>

                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">QR Code</dt>
                        <dd class="mt-1 text-sm text-[#111418] dark:text-gray-200 sm:mt-0 sm:col-span-2 break-all">{{ $booking->code_for_qr }}</dd>
                    </div>
                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Note</dt>
                        <dd class="mt-1 text-sm text-[#111418] dark:text-gray-200 sm:mt-0 sm:col-span-2">{{ $booking->note }}</dd>
                    </div>

                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-colors">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                        <dd class="mt-1 sm:mt-0 sm:col-span-2">
                            <span class="inline-flex items-center rounded-full bg-blue-50 dark:bg-blue-900/30 px-3 py-1 text-sm font-medium text-blue-700 dark:text-blue-200 ring-1 ring-inset ring-blue-700/10">
                                {{ $booking->status }}
                            </span>
                        </dd>
                    </div>

                </dl>
            </div>
        </div>
    </div>
@endsection