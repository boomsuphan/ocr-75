@extends('layouts.themeNew')

@section('content')
    <div class="w-full max-w-[1280px] mx-auto px-4 sm:px-6 py-6">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <h1 class="text-[#111418] dark:text-white text-2xl font-bold leading-tight">
                จัดการการจอง (Booking)
            </h1>
            
            <div class="flex flex-col sm:flex-row w-full md:w-auto gap-3">
                <form method="GET" action="{{ url('/booking') }}" accept-charset="UTF-8" role="search" class="flex w-full md:w-auto">
                    <div class="relative w-full md:w-64">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            class="w-full h-10 pl-4 pr-10 rounded-lg border border-[#dce0e5] dark:border-gray-700 bg-white dark:bg-gray-800 text-[#111418] dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" 
                            placeholder="ค้นหา...">
                        <button type="submit" class="absolute right-0 top-0 h-10 w-10 flex items-center justify-center text-gray-500 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[20px]">search</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <div class="bg-white dark:bg-[#1a2632] rounded-xl border border-[#dce0e5] dark:border-gray-800 shadow-sm overflow-hidden">
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-800/50 border-b border-[#dce0e5] dark:border-gray-800">
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase">#</th>
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase whitespace-nowrap">Room Id</th>
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase whitespace-nowrap">User Id</th>
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase whitespace-nowrap">Subject</th>
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase whitespace-nowrap">Professor</th>
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase whitespace-nowrap">Note</th>
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase whitespace-nowrap">Semester</th>
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase whitespace-nowrap">Date</th>
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase whitespace-nowrap">Time Start</th>
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase whitespace-nowrap">Time End</th>
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase whitespace-nowrap">Get Key</th>
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase whitespace-nowrap">Return Key</th>
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase whitespace-nowrap">QR Code</th>
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase whitespace-nowrap">Status</th>
                            <th class="p-4 text-xs font-bold tracking-wide text-gray-500 uppercase text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#dce0e5] dark:divide-gray-800">
                        @foreach($booking as $item)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="p-4 text-sm text-[#111418] dark:text-gray-200">{{ $loop->iteration }}</td>
                                <td class="p-4 text-sm text-[#111418] dark:text-gray-200">{{ $item->room_id }}</td>
                                <td class="p-4 text-sm text-[#111418] dark:text-gray-200">{{ $item->user_id }}</td>
                                <td class="p-4 text-sm text-[#111418] dark:text-gray-200 font-medium">{{ $item->subject }}</td>
                                <td class="p-4 text-sm text-[#111418] dark:text-gray-200">{{ $item->name_professor }}</td>
                                <td class="p-4 text-sm text-gray-500 dark:text-gray-400 max-w-[150px] truncate" title="{{ $item->note }}">{{ $item->note }}</td>
                                <td class="p-4 text-sm text-[#111418] dark:text-gray-200">{{ $item->semester }}</td>
                                <td class="p-4 text-sm text-[#111418] dark:text-gray-200 whitespace-nowrap">{{ $item->date_booking }}</td>
                                <td class="p-4 text-sm text-[#111418] dark:text-gray-200">{{ $item->time_start_booking }}</td>
                                <td class="p-4 text-sm text-[#111418] dark:text-gray-200">{{ $item->time_end_booking }}</td>
                                <td class="p-4 text-sm text-gray-500">{{ $item->time_get_key }}</td>
                                <td class="p-4 text-sm text-gray-500">{{ $item->time_return_key }}</td>
                                <td class="p-4 text-sm text-gray-500">{{ $item->code_for_qr }}</td>
                                <td class="p-4 text-sm">
                                    <span class="inline-flex items-center rounded-full bg-blue-50 dark:bg-blue-900/30 px-2 py-1 text-xs font-medium text-blue-700 dark:text-blue-200 ring-1 ring-inset ring-blue-700/10">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-sm text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ url('/booking/' . $item->id) }}" title="View Booking" 
                                           class="p-2 text-gray-500 hover:text-primary hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </a>
                                        
                                        <a href="{{ url('/booking/' . $item->id . '/edit') }}" title="Edit Booking"
                                           class="p-2 text-gray-500 hover:text-yellow-600 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-lg transition-colors">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </a>

                                        <form method="POST" action="{{ url('/booking' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" title="Delete Booking" onclick="return confirm('Confirm delete?')"
                                                    class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="px-4 py-4 border-t border-[#dce0e5] dark:border-gray-800">
                <div class="pagination-wrapper">
                    {!! $booking->appends(['search' => Request::get('search')])->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection