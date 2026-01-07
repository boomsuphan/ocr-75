@extends('layouts.themeNew')

@section('content')


<div class="w-full max-w-[520px] bg-white dark:bg-[#1A2633] rounded-xl shadow-sm border border-[#e6e8eb] dark:border-[#24303d] overflow-hidden flex flex-col">
    <!-- Headline & Illustration -->
    <div class="pt-10 px-8 pb-4 flex flex-col items-center">
        <div class="size-16 rounded-full bg-primary/10 flex items-center justify-center mb-6">
            <span class="material-symbols-outlined text-primary text-3xl">lock_reset</span>
        </div>
        <h2 class="text-[#111418] dark:text-white tracking-tight text-[28px] font-bold leading-tight text-center">ลืมรหัสผ่าน?</h2>
        <p class="text-[#637588] dark:text-[#9ba1a6] text-base font-normal leading-normal mt-3 text-center max-w-sm">
            กรอกอีเมลของคุณที่นี่ แล้วเราจะส่งลิงก์สำหรับตั้งรหัสผ่านใหม่ให้คุณ
        </p>
    </div>
    <!-- Form Section -->
    <div class="px-8 pb-10 w-full">
        <form method="POST" class="flex flex-col gap-6" action="{{ route('password.email') }}">
            @csrf
            <!-- Email Input -->
            <label class="flex flex-col w-full">
                <p class="text-[#111418] dark:text-white text-sm font-medium leading-normal pb-2">อีเมล</p>
                <div class="relative flex w-full items-center rounded-lg">
                    <!-- <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111418] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 focus:border-primary border border-[#dbe0e6] dark:border-[#3e4c59] bg-white dark:bg-[#111a22] h-12 placeholder:text-[#9CA3AF] pl-4 pr-12 text-base font-normal leading-normal transition-all" placeholder="6xxxxxxx@student.university.ac.th" type="email" value="" /> -->
                     <input id="email" type="email" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111418] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 focus:border-primary border border-[#dbe0e6] dark:border-[#3e4c59] bg-white dark:bg-[#111a22] h-12 placeholder:text-[#9CA3AF] pl-4 pr-12 text-base font-normal leading-normal transition-all @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" type="email" autofocus placeholder="xxxxx@vru.ac.th">

                  
                    
                    <div class="absolute right-0 top-0 h-full flex items-center justify-center px-3 text-[#9CA3AF] pointer-events-none">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                </div>
                  @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </label>
            <!-- Buttons -->
            <div class="flex flex-col gap-3 pt-2">
                <!-- Primary Button -->
                <button class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-primary hover:bg-primary/90 transition-colors text-white text-base font-bold leading-normal tracking-[0.015em] shadow-sm">
                    <span class="truncate">ส่งลิงก์กู้คืนรหัสผ่าน</span>
                </button>
                <!-- Back Button -->
                <a href="{{url('/login')}}" class="flex w-full cursor-pointer items-center justify-center rounded-lg h-12 text-[#637588] dark:text-[#9ba1a6] hover:text-[#111418] dark:hover:text-white hover:bg-gray-100 dark:hover:bg-[#24303d] transition-all text-sm font-medium leading-normal gap-2" href="#">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                    <span class="truncate">กลับไปหน้าเข้าสู่ระบบ</span>
                </a>
            </div>
    </div>
</div>
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection