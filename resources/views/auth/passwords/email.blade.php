@extends('layouts.theme')

@section('content')

    <style>
        main{
            padding: 0 !important;
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
            color: #fff;
        }

        .login-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .login-body {
            padding: 40px 30px;
            background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);
            min-height: calc(100dvh - 175px);
            display: flex;
            align-items: center;
            justify-content: center;
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
 .form-group input.is-invalid {
            outline: none;
            border-color: #ed2f2fff;
            box-shadow: 0 0 0 3px rgba(237, 47, 47, 0.1);
        }

        .form-group input::placeholder {
            color: #999;
        }

      

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 14px;
        }

         .back-btn {
            padding: 14px;
            background: #fff;
            color: #636363ff;
            border: 2px solid #636363ff;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s, transform 0.1s;
            width: 30% !important;
            margin-right: 5px;
        }

        .back-btn:hover {
            background: #636363ff;
            color:white;
        }

        .back-btn:active {
            transform: scale(0.98);
        }

        .form-btn {
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

        .form-btn:hover {
            background: #1a6bd6;
        }

        .form-btn:active {
            transform: scale(0.98);
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
    </style>
    <div class="login-body">

        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <h1>ระบบจองห้องเรียน</h1>
                    <p class="subtitle">ลืมรหัสผ่าน</p>
                </div>
                
                <div class="login-content">
                    <div class="error-message" id="error-message"></div>
                    <div class="success-message" id="success-message"></div>
    
                  <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username">อีเมล</label>
                           <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="กรอกอีเมลของคุณ">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="d-flex">

                            <a href="{{ url()->previous() }}" class="back-btn" >ย้อนกลับ</a>
                            <button type="submit" class="form-btn">
                               {{ __('ยืนยัน') }}
                           </button>
                        </div>
                    </form>
                </div>
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
