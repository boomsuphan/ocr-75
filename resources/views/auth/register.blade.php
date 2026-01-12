@extends('layouts.themeNew')

@section('content')
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#137fec",
                    "primary-dark": "#1066be",
                    "background-light": "#f6f7f8",
                    "background-dark": "#101922",
                    "surface-light": "#ffffff",
                    "surface-dark": "#1a2632",
                    "text-main-light": "#111418",
                    "text-main-dark": "#f0f2f4",
                    "text-sub-light": "#617589",
                    "text-sub-dark": "#9aaab9",
                    "border-light": "#dbe0e6",
                    "border-dark": "#2a3b4c",
                },
                fontFamily: {
                    "display": ["Lexend", "Noto Sans Thai", "sans-serif"],
                    "body": ["Lexend", "Noto Sans Thai", "sans-serif"]
                },
                borderRadius: {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "2xl": "1rem",
                    "full": "9999px"
                },
            },
        },
    }
</script>
<style>
    /* Custom scrollbar for better UX */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #cbd5e1;
        border-radius: 20px;
    }

    .dark ::-webkit-scrollbar-thumb {
        background-color: #475569;
    }

    .password-toggle {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #666;
        cursor: pointer;
        font-size: 14px;
        padding: 4px;
        transition: color 0.2s;
    }

    .password-toggle:hover {
        color: #2F80ED;
    }
</style>
<div class="w-full max-w-[800px] flex flex-col gap-6">
    <!-- Page Header -->
    <div class="text-center sm:text-left space-y-2 mb-2 border-b border-gray-200 dark:border-gray-700 pb-4">
        <h2 class="text-3xl sm:text-4xl font-black tracking-tight text-text-main-light dark:text-text-main-dark">
            สมัครสมาชิก
        </h2>
        <p class="text-text-sub-light dark:text-text-sub-dark text-base sm:text-lg">
            กรอกข้อมูลเพื่อลงทะเบียนเข้าใช้งานระบบจองห้องเรียน
        </p>
    </div>
    <!-- Registration Card -->
    <div class="bg-surface-light dark:bg-surface-dark rounded-xl border border-border-light dark:border-border-dark shadow-sm overflow-hidden p-6 sm:p-8">
        <form class="flex flex-col gap-8" method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Section: Personal Info -->
            <div class="flex flex-col gap-5">
                <div class="flex items-center gap-2 pb-2 border-b border-border-light dark:border-border-dark">
                    <span class="material-symbols-outlined text-primary">person</span>
                    <h3 class="text-lg font-bold">ข้อมูลส่วนตัว</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">ชื่อ-นามสกุล</span>
                        <input class="form-input w-full h-12 px-4 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 placeholder:text-text-sub-light/70" placeholder="ระบุชื่อจริงและนามสกุล" type="text" />
                    </label>
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">รหัสนักศึกษา</span>
                        <input class="form-input w-full h-12 px-4 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 placeholder:text-text-sub-light/70" placeholder="รหัสนักศึกษา 10 หลัก" type="text" />
                    </label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">คณะ</span>
                        <div class="relative">
                            <select class="form-select w-full h-12 px-4 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 appearance-none cursor-pointer">
                                <option disabled="" selected="" value="">เลือกคณะ</option>
                                <option value="science">วิทยาศาสตร์</option>
                                <option value="engineering">วิศวกรรมศาสตร์</option>
                                <option value="arts">ศิลปศาสตร์</option>
                            </select>
                            <!-- <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-text-sub-light">expand_more</span> -->
                        </div>
                    </label>
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">สาขาวิชา</span>
                        <div class="relative">
                            <select class="form-select w-full h-12 px-4 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 appearance-none cursor-pointer">
                                <option disabled="" selected="" value="">เลือกสาขาวิชา</option>
                                <option value="cs">วิทยาการคอมพิวเตอร์</option>
                                <option value="it">เทคโนโลยีสารสนเทศ</option>
                            </select>
                            <!-- <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-text-sub-light">expand_more</span> -->
                        </div>
                    </label>
                </div>
            </div>
            <!-- Section: Photo Upload -->
            <div class="flex flex-col gap-5">
                <div class="flex items-center gap-2 pb-2 border-b border-border-light dark:border-border-dark">
                    <span class="material-symbols-outlined text-primary">badge</span>
                    <h3 class="text-lg font-bold">รูปถ่าย</h3>
                </div>
                <div class="flex flex-col sm:flex-row gap-6 items-start">
                    <div class="size-32 shrink-0 bg-background-light dark:bg-background-dark rounded-xl flex items-center justify-center border border-border-light dark:border-border-dark overflow-hidden relative group">
                        <span class="material-symbols-outlined text-4xl text-text-sub-light">account_circle</span>
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                            <span class="text-white text-xs font-medium">Preview</span>
                        </div>
                    </div>
                    <div class="flex-1 w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-border-light dark:border-border-dark rounded-xl cursor-pointer bg-background-light/50 dark:bg-background-dark/50 hover:bg-background-light dark:hover:bg-background-dark transition-colors group" for="file-upload">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <span class="material-symbols-outlined text-3xl text-text-sub-light group-hover:text-primary mb-2 transition-colors">cloud_upload</span>
                                <p class="mb-1 text-sm text-text-main-light dark:text-text-main-dark font-medium">คลิกเพื่ออัปโหลดรูปภาพ</p>
                                <p class="text-xs text-text-sub-light">PNG, JPG หรือ GIF (สูงสุด 2MB)</p>
                            </div>
                            <input class="hidden" id="file-upload" type="file" />
                        </label>
                    </div>
                </div>
            </div>
            <!-- Section: Account Info -->
            <div class="flex flex-col gap-5">
                <div class="flex items-center gap-2 pb-2 border-b border-border-light dark:border-border-dark">
                    <span class="material-symbols-outlined text-primary">lock</span>
                    <h3 class="text-lg font-bold">ข้อมูลบัญชีผู้ใช้</h3>
                </div>
                <div class="grid grid-cols-1 gap-5">
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">อีเมล</span>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-sub-light text-[20px]">email</span>
                            <input id="email" type="email" class="form-input w-full h-12 pl-12 pr-4 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 placeholder:text-text-sub-light/70 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="กรอกอีเมลของคุณ">
                          
                        </div>
                          @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </label>
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">Username</span>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-sub-light text-[20px]">alternate_email</span>
                            <!-- <input class="form-input w-full h-12 pl-12 pr-4 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 placeholder:text-text-sub-light/70" placeholder="ตั้งชื่อผู้ใช้งาน (ภาษาอังกฤษ)" type="text" /> -->

                            <input id="name" type="text" class="form-input w-full h-12 pl-12 pr-4 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 placeholder:text-text-sub-light/70 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="ตั้งชื่อผู้ใช้งาน (ภาษาอังกฤษ)">

                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">รหัสผ่าน</span>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-sub-light text-[20px]">vpn_key</span>
                                <input id="password" type="password" class="form-input w-full h-12 pl-12 pr-12 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 placeholder:text-text-sub-light/70 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="อย่างน้อย 8 ตัวอักษร">
                            </div>
                        </label>
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">ยืนยันรหัสผ่าน</span>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-sub-light text-[20px]">check_circle</span>
                                <input id="password_confirmation" type="password" class="form-input w-full h-12 pl-12 pr-12 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 placeholder:text-text-sub-light/70" name="password_confirmation" required autocomplete="new-password" placeholder="กรอกรหัสผ่านอีกครั้ง">
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <!-- Notice Alert -->
            <div class="rounded-lg bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800/50 p-4 flex gap-3 items-start">
                <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-500 shrink-0 mt-0.5">info</span>
                <div class="flex flex-col gap-1">
                    <p class="text-sm font-bold text-yellow-800 dark:text-yellow-400">รอการตรวจสอบสิทธิ์</p>
                    <p class="text-sm text-yellow-700 dark:text-yellow-500/80 leading-relaxed">
                        หลังจากส่งข้อมูลการสมัคร บัญชีของท่านจะต้องได้รับการตรวจสอบและอนุมัติจากเจ้าหน้าที่ก่อน จึงจะสามารถเข้าใช้งานระบบจองห้องเรียนได้
                    </p>
                </div>
            </div>
            <!-- Action Buttons -->
            <div class="pt-2 flex flex-col gap-3">
                <button class="w-full h-12 bg-primary hover:bg-primary-dark text-white font-bold rounded-lg shadow-sm shadow-primary/20 transition-all active:scale-[0.99] flex items-center justify-center gap-2" type="submit">
                    <span>สมัครสมาชิก</span>
                    <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                </button>
                <p class="text-center text-sm text-text-sub-light dark:text-text-sub-dark">
                    มีบัญชีอยู่แล้ว? <a class="text-primary font-bold hover:underline" href="{{url('login')}}">เข้าสู่ระบบ</a>
                </p>
            </div>
        </form>

        <!-- <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="username">ชื่อผู้ใช้งาน</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="กรอกชื่อผู้ใช้งานของคุณ">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="username">อีเมล</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="กรอกชื่ออีเมลของคุณ">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">รหัสผ่าน</label>
                <div class="input-wrapper">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="กรอกรหัสผ่านของคุณ">

                    <button type="button" class="password-toggle" data-target="password" onclick="togglePassword(this)" aria-label="แสดง/ซ่อนรหัสผ่าน"> <i class="fa-solid fa-eye"></i></button>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">ยืนยันรหัสผ่าน</label>
                <div class="input-wrapper">
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="ยืนยันรหัสผ่านของคุณ">

                    <button type="button" class="password-toggle" data-target="password_confirmation" onclick="togglePassword(this)" aria-label="แสดง/ซ่อนรหัสผ่าน"> <i class="fa-solid fa-eye"></i></button>
                </div>
            </div>

            <button type="submit" class="login-btn">
                {{ __('สมัครสมาชิก') }}
            </button>
        </form> -->
    </div>

</div>

<!-- <style>
    main {
        padding: 0 !important;
    }

    .login-body {
        background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);
        min-height: calc(100dvh - 175px);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-container {
        width: 100%;
        max-width: 440px !important;
    }

    .login-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(47, 128, 237, 0.1);
        overflow: hidden;
    }

    .login-header {
        background: #2F80ED;
        color: white;
        padding: 40px 30px;
        text-align: center;
    }

    .login-header h1 {
        font-size: 28px;
        margin-bottom: 8px;
        font-weight: 600;
        color:#fff;
    }

    .login-header p {
        font-size: 14px;
        opacity: 0.9;
    }

    .login-body {
        padding: 40px 30px;
    }

    .login-content {
        padding: 40px 30px;
        display: block;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
        font-size: 14px;
    }

    .input-wrapper {
        position: relative;
    }

    .form-group input {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 15px;
        transition: border-color 0.3s, box-shadow 0.3s;
        font-family: inherit;
    }

    .form-group input:focus {
        outline: none;
        border-color: #2F80ED;
        box-shadow: 0 0 0 3px rgba(47, 128, 237, 0.1);
    }

    .form-group input::placeholder {
        color: #999;
    }

    .password-toggle {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #666;
        cursor: pointer;
        font-size: 14px;
        padding: 4px;
        transition: color 0.2s;
    }

    .password-toggle:hover {
        color: #2F80ED;
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        font-size: 14px;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        color: #666;
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #2F80ED;
    }

    .forgot-password {
        color: #2F80ED;
        text-decoration: none;
        transition: opacity 0.2s;
    }

    .forgot-password:hover {
        opacity: 0.8;
    }

    .login-btn {
        width: 100%;
        padding: 14px;
        background: #2F80ED;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s, transform 0.1s;
    }

    .login-btn:hover {
        background: #1a6bd6;
    }

    .login-btn:active {
        transform: scale(0.98);
    }

    .divider {
        display: flex;
        align-items: center;
        margin: 30px 0;
        color: #999;
        font-size: 14px;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e0e0e0;
    }

    .divider::before {
        margin-right: 16px;
    }

    .divider::after {
        margin-left: 16px;
    }

    .register-link {
        text-align: center;
        color: #666;
        font-size: 14px;
    }

    .register-link a {
        color: #2F80ED;
        text-decoration: none;
        font-weight: 600;
        transition: opacity 0.2s;
    }

    .register-link a:hover {
        opacity: 0.8;
    }

    .error-message {
        background: #FFF3F3;
        color: #D32F2F;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 14px;
        margin-bottom: 20px;
        border: 1px solid #FFE0E0;
        display: none;
    }

    .error-message.show {
        display: block;
    }

    .success-message {
        background: #E8F5E9;
        color: #2E7D32;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 14px;
        margin-bottom: 20px;
        border: 1px solid #C8E6C9;
        display: none;
    }

    .success-message.show {
        display: block;
    }

    @media (max-width: 480px) {
        .login-header {
            padding: 30px 20px;
        }

        .login-header h1 {
            font-size: 24px;
        }

        .login-body {
            padding: 30px 20px;
        }

        .form-options {
            flex-direction: column;
            gap: 12px;
            align-items: flex-start;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-card {
        animation: fadeIn 0.5s ease-out;
    }

    .input-wrapper {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #6c757d;
    }

    .password-toggle:hover {
        color: #000;
    }
</style>
<div class="login-body">

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>ระบบจองห้องเรียน</h1>
                <p>สมัครสมาชิกเพื่อเข้าสู่ระบบ</p>
            </div>
            
            <div class="login-content">
                <div class="error-message" id="error-message"></div>
                <div class="success-message" id="success-message"></div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="username">ชื่อผู้ใช้งาน</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="กรอกชื่อผู้ใช้งานของคุณ">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="username">อีเมล</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="กรอกชื่ออีเมลของคุณ">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">รหัสผ่าน</label>
                        <div class="input-wrapper">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="กรอกรหัสผ่านของคุณ">

                            <button type="button" class="password-toggle" data-target="password" onclick="togglePassword(this)" aria-label="แสดง/ซ่อนรหัสผ่าน"> <i class="fa-solid fa-eye"></i></button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">ยืนยันรหัสผ่าน</label>
                        <div class="input-wrapper">
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="ยืนยันรหัสผ่านของคุณ">

                            <button type="button" class="password-toggle" data-target="password_confirmation" onclick="togglePassword(this)" aria-label="แสดง/ซ่อนรหัสผ่าน"> <i class="fa-solid fa-eye"></i></button>
                        </div>
                    </div>

                    <button type="submit" class="login-btn">
                         {{ __('สมัครสมาชิก') }}
                    </button>
                </form>

            </div>
        </div>
    </div>
</div> -->

<script>
    function togglePassword(btn) {
        const inputId = btn.dataset.target;
        const passwordInput = document.getElementById(inputId);
        const icon = btn.querySelector('i');

        if (!passwordInput || !icon) return;

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>


<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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