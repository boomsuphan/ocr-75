@extends('layouts.theme')

@section('content')
<style>
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
</div>

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