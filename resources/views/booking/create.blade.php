@extends('layouts.themeNew')

@section('content')
    <div class="w-full max-w-[1280px] mx-auto px-4 sm:px-6 py-8">
        
        <div class="max-w-3xl mx-auto">

            <div class="flex items-center gap-4 mb-6">
                <a href="{{ url('/booking') }}" 
                   class="flex items-center justify-center w-10 h-10 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-500 hover:text-primary hover:border-primary transition-colors shadow-sm"
                   title="ย้อนกลับ">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                </a>
                <h1 class="text-[#111418] dark:text-white text-2xl font-bold leading-tight">
                    สร้างรายการจองใหม่ (Create Booking)
                </h1>
            </div>

            <div class="bg-white dark:bg-[#1a2632] rounded-xl border border-[#dce0e5] dark:border-gray-800 shadow-sm p-6 sm:p-8">

                @if ($errors->any())
                    <div class="rounded-lg bg-red-50 dark:bg-red-900/20 p-4 mb-8 border border-red-200 dark:border-red-800">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-red-600 dark:text-red-400 mt-0.5">error</span>
                            <div>
                                <h3 class="text-sm font-bold text-red-800 dark:text-red-300 mb-1">เกิดข้อผิดพลาด</h3>
                                <ul class="list-disc list-inside text-sm text-red-700 dark:text-red-200 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ url('/booking') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @include ('booking.form', ['formMode' => 'create'])

                </form>

            </div>
        </div>
    </div>
@endsection