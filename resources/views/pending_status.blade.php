@extends('layouts.themeNew')

@section('content')

<div class="w-full min-h-[calc(100vh-200px)] flex items-center justify-center p-4">

    <div class="w-full max-w-[480px] bg-white dark:bg-[#1a2632] rounded-xl shadow-xl border border-[#e5e7eb] dark:border-gray-800 overflow-hidden relative">
        
        <div class="absolute top-0 left-0 w-full h-1.5 bg-yellow-500"></div>

        <div class="px-8 py-10 flex flex-col items-center text-center gap-6">

            <div class="size-24 rounded-full bg-yellow-50 dark:bg-yellow-500/10 flex items-center justify-center mb-2 ring-1 ring-yellow-100 dark:ring-yellow-500/20">
                <span class="material-symbols-outlined text-5xl text-yellow-500 animate-pulse">
                    hourglass_top
                </span>
            </div>

            <div class="space-y-2">
                <h2 class="text-2xl font-bold text-[#111418] dark:text-white">
                    รอการตรวจสอบสิทธิ์
                </h2>
                <p class="text-[#617589] dark:text-gray-400 text-base leading-relaxed">
                    ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว <br>
                    กรุณารอเจ้าหน้าที่ตรวจสอบและอนุมัติบัญชีของคุณ <br>
                    จึงจะสามารถเข้าใช้งานระบบได้
                </p>
            </div>

            <div class="w-full bg-[#f6f7f8] dark:bg-[#101922] rounded-lg p-4 border border-[#e5e7eb] dark:border-gray-700">
                <div class="flex items-start gap-3 text-left">
                    <span class="material-symbols-outlined text-[#617589] dark:text-gray-500 mt-0.5 text-[20px]">info</span>
                    <div class="flex flex-col gap-1">
                        <p class="text-sm font-bold text-[#111418] dark:text-gray-200">หากรอนานเกิน 24 ชม. โปรดติดต่อเจ้าหน้าที่
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection