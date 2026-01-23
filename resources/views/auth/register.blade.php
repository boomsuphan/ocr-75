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
        <form class="flex flex-col gap-8" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="flex flex-col gap-5">
                <div class="flex items-center gap-2 pb-2 border-b border-border-light dark:border-border-dark">
                    <span class="material-symbols-outlined text-primary">person</span>
                    <h3 class="text-lg font-bold">ข้อมูลส่วนตัว</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">ชื่อ-นามสกุล</span>
                        <input id="fullname" type="text" class="form-input w-full h-12 px-4 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 placeholder:text-text-sub-light/70 @error('fullname') border-red-500 @enderror" 
                               name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus placeholder="ระบุชื่อจริงและนามสกุล" />
                        @error('fullname')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">รหัสนักศึกษา</span>
                        <input id="std_id" type="text" class="form-input w-full h-12 px-4 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 placeholder:text-text-sub-light/70 @error('std_id') border-red-500 @enderror" 
                               name="std_id" value="{{ old('std_id') }}" required placeholder="รหัสนักศึกษา" />
                        @error('std_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">คณะ</span>
                        <div class="relative">
                            <select id="faculty" name="faculty" class="form-select w-full h-12 px-4 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 appearance-none cursor-pointer" required>
                                <option disabled selected value="">เลือกคณะ</option>
                                @foreach($faculties as $faculty)
                                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('faculty')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">สาขาวิชา</span>
                        <div class="relative">
                            <select id="major" name="major" class="form-select w-full h-12 px-4 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 appearance-none cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed" disabled required>
                                <option disabled selected value="">กรุณาเลือกคณะก่อน</option>
                            </select>
                        </div>
                        @error('major')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <div class="grid grid-cols-1 gap-5">
                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">เบอร์โทรศัพท์</span>
                        <input id="phone" type="tel" class="form-input w-full h-12 px-4 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 placeholder:text-text-sub-light/70 @error('phone') border-red-500 @enderror" 
                               name="phone" value="{{ old('phone') }}" required placeholder="กรอกเบอร์โทรศัพท์มือถือ" />
                        @error('phone')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
            </div>

            <div class="flex flex-col gap-5">
                <div class="flex items-center gap-2 pb-2 border-b border-border-light dark:border-border-dark">
                    <span class="material-symbols-outlined text-primary">badge</span>
                    <h3 class="text-lg font-bold">รูปถ่าย</h3>
                </div>
                <div class="flex flex-col sm:flex-row gap-6 items-start">
                    <div class="size-32 shrink-0 bg-background-light dark:bg-background-dark rounded-xl flex items-center justify-center border border-border-light dark:border-border-dark overflow-hidden relative group">
                        <img id="image_preview" src="#" alt="Profile Preview" class="w-full h-full object-cover hidden" />
                        <span id="image_placeholder" class="material-symbols-outlined text-4xl text-text-sub-light">account_circle</span>
                    </div>
                    <div class="flex-1 w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-border-light dark:border-border-dark rounded-xl cursor-pointer bg-background-light/50 dark:bg-background-dark/50 hover:bg-background-light dark:hover:bg-background-dark transition-colors group relative" for="photo">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <span class="material-symbols-outlined text-3xl text-text-sub-light group-hover:text-primary mb-2 transition-colors">cloud_upload</span>
                                <p class="mb-1 text-sm text-text-main-light dark:text-text-main-dark font-medium">คลิกเพื่ออัปโหลดรูปภาพ</p>
                                <p class="text-xs text-text-sub-light">PNG, JPG (สูงสุด 2MB)</p>
                            </div>
                            <input id="photo" name="photo" type="file" class="hidden" accept="image/png, image/jpeg, image/jpg" />
                        </label>
                        <p id="upload_error" class="text-red-500 text-sm mt-2 hidden"></p>
                        @error('photo')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

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
                            <input id="email" type="email" class="form-input w-full h-12 pl-12 pr-4 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 placeholder:text-text-sub-light/70 @error('email') border-red-500 @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="กรอกอีเมลของคุณ">
                        </div>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">ชื่อผู้ใช้งาน (Username)</span>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-sub-light text-[20px]">alternate_email</span>
                            <input id="username" type="text" class="form-input w-full h-12 pl-12 pr-4 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 placeholder:text-text-sub-light/70 @error('username') border-red-500 @enderror" 
                                   name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="ตั้งชื่อผู้ใช้งาน (ภาษาอังกฤษ)">
                        </div>
                        @error('username')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </label>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">รหัสผ่าน</span>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-sub-light text-[20px]">vpn_key</span>
                                <input id="password" type="password" class="form-input w-full h-12 pl-12 pr-12 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 placeholder:text-text-sub-light/70 @error('password') border-red-500 @enderror" 
                                       name="password" required autocomplete="new-password" placeholder="อย่างน้อย 8 ตัวอักษร">
                            </div>
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </label>
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-medium text-text-main-light dark:text-text-main-dark">ยืนยันรหัสผ่าน</span>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-sub-light text-[20px]">check_circle</span>
                                <input id="password_confirmation" type="password" class="form-input w-full h-12 pl-12 pr-12 rounded-lg bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark focus:border-primary focus:ring-0 placeholder:text-text-sub-light/70" 
                                       name="password_confirmation" required autocomplete="new-password" placeholder="กรอกรหัสผ่านอีกครั้ง">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. จัดการเลือกสาขา
        const facultySelect = document.getElementById('faculty');
        const majorSelect = document.getElementById('major');

        if(facultySelect && majorSelect) {
            facultySelect.addEventListener('change', function() {
                const facultyId = this.value;
                majorSelect.innerHTML = '<option disabled selected value="">กำลังโหลดข้อมูล...</option>';
                majorSelect.disabled = true;

                if (facultyId) {
                    fetch(`{{ url('/api/majors') }}/${facultyId}`)
                        .then(response => response.json())
                        .then(data => {
                            majorSelect.innerHTML = '<option disabled selected value="">เลือกสาขาวิชา</option>';
                            data.forEach(major => {
                                const option = document.createElement('option');
                                option.value = major.id;
                                option.textContent = major.name;
                                majorSelect.appendChild(option);
                            });
                            majorSelect.disabled = false;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            majorSelect.innerHTML = '<option disabled selected value="">เกิดข้อผิดพลาด</option>';
                        });
                }
            });
        }

        // 2. จัดการรูปภาพ
        const photoInput = document.getElementById('photo');
        const previewImg = document.getElementById('image_preview');
        const placeholderIcon = document.getElementById('image_placeholder');
        const errorMsg = document.getElementById('upload_error');

        if(photoInput) {
            photoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                const maxSize = 2 * 1024 * 1024; 
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                
                errorMsg.classList.add('hidden');
                errorMsg.textContent = '';
                
                if (file) {
                    if (!allowedTypes.includes(file.type)) {
                        errorMsg.textContent = 'กรุณาอัปโหลดไฟล์รูปภาพ (JPG หรือ PNG) เท่านั้น';
                        errorMsg.classList.remove('hidden');
                        this.value = '';
                        resetPreview();
                        return;
                    }
                    if (file.size > maxSize) {
                        errorMsg.textContent = 'ขนาดไฟล์รูปภาพต้องไม่เกิน 2MB';
                        errorMsg.classList.remove('hidden');
                        this.value = '';
                        resetPreview();
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewImg.classList.remove('hidden');
                        placeholderIcon.classList.add('hidden');
                    }
                    reader.readAsDataURL(file);
                } else {
                    resetPreview();
                }
            });
        }

        function resetPreview() {
            previewImg.src = '#';
            previewImg.classList.add('hidden');
            placeholderIcon.classList.remove('hidden');
        }
    });
</script>
@endsection