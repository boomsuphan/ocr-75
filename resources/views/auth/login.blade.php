@extends('layouts.themeNew')

@section('content')

<div class="w-full max-w-[480px] bg-white dark:bg-[#1a2632] rounded-xl shadow-lg border border-[#e5e7eb] dark:border-gray-800 overflow-hidden">
    <!-- Card Header -->
    <div class="pt-8 px-8 pb-4">
        <div class="flex flex-col gap-2">
            <h1 class="text-primary tracking-tight text-[32px] font-bold leading-tight">เข้าสู่ระบบ</h1>
            <p class="text-[#617589] dark:text-gray-400 text-sm font-normal leading-normal">
                ยินดีต้อนรับกลับ! กรุณากรอกข้อมูลเพื่อเข้าใช้งานระบบ
            </p>
        </div>
    </div>
    <!-- Login Form -->
    <div class="px-8 pb-8">

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Username Input -->
            <div class="flex flex-col gap-1.5">
                <label class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal" for="username">
                    ชื่อผู้ใช้ / รหัสนักศึกษา
                </label>
                <div class="mb-4">

                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-[#617589] dark:text-gray-500 material-symbols-outlined text-[20px] select-none">person</span>

                        <input id="email" type="email" class=" @error('email') is-invalid @enderror form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111418] dark:text-white dark:bg-[#101922] focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary border border-[#dbe0e6] dark:border-gray-700 bg-white h-12 placeholder:text-[#9ca3af] pl-11 pr-4 text-base font-normal leading-normal transition-all" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="กรอกชื่อผู้ใช้งานของคุณ" autofocus>
                    </div>
                    @error('email')
                    <p class="invalid-feedback " role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>

            </div>
            <!-- Password Input -->
            <div class="mb-4">
                <div class="flex flex-col gap-1.5">
                    <div class="flex justify-between items-center">
                        <label class="text-[#111418] dark:text-gray-200 text-sm font-medium leading-normal" for="password">
                            รหัสผ่าน
                        </label>
                        <a class="text-sm font-medium text-primary hover:text-primary-hover transition-colors" href="{{ route('password.request') }}">
                            ลืมรหัสผ่าน?
                        </a>
                    </div>
                    <div class="relative flex items-center group">
                        <span class="absolute left-4 text-[#617589] dark:text-gray-500 material-symbols-outlined text-[20px] select-none">lock</span>

                        <input id="password" type="password" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111418] dark:text-white dark:bg-[#101922] focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary border border-[#dbe0e6] dark:border-gray-700 bg-white h-12 placeholder:text-[#9ca3af] pl-11 pr-12 text-base font-normal leading-normal transition-all @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="กรอกรหัสผ่านของคุณ">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div class="absolute right-0 top-0 h-full flex items-center pr-3 cursor-pointer text-[#617589] hover:text-[#111418] dark:text-gray-500 dark:hover:text-gray-300 transition-colors"id="togglePassword">
                            <span class="material-symbols-outlined text-[20px] select-none" id="toggleIcon" >
                                visibility
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Action Button -->
            <div class="pt-2">
                <button class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary hover:bg-primary-hover text-white text-base font-bold leading-normal tracking-[0.015em] transition-all shadow-md hover:shadow-lg active:scale-[0.98]">
                    <span class="truncate">เข้าสู่ระบบ</span>
                </button>
            </div>
            <!-- Register Link -->
            <div class="flex items-center justify-center gap-1.5 pt-1">
                <p class="text-[#617589] dark:text-gray-400 text-sm font-normal">ยังไม่มีบัญชี?</p>
                <a class="text-primary hover:text-primary-hover text-sm font-bold transition-colors" href="{{ url('/register') }}">สมัครสมาชิก</a>
            </div>
        </form>



    </div>
    <!-- Decorative / Branding Bottom Strip (Optional) -->
    <div class="h-1.5 w-full bg-gradient-to-r from-blue-300 via-primary to-blue-600"></div>
</div>


<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    togglePassword.addEventListener('click', () => {
        const isPassword = passwordInput.type === 'password';

        passwordInput.type = isPassword ? 'text' : 'password';
        toggleIcon.textContent = isPassword ? 'visibility_off' : 'visibility';
    });
</script>

@endsection