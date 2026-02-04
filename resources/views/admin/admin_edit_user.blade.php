@extends('layouts.themeNew')

@section('content')

<div class="max-w-[1200px] mx-auto p-4 md:p-8">
    
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ url('/manage_user') }}" class="size-10 rounded-full bg-white dark:bg-[#251d1a] border border-[#f3e9e5] dark:border-[#3d2f2a] flex items-center justify-center text-[#8c746a] hover:text-primary hover:border-primary transition-all">
            <span class="material-symbols-outlined text-xl">arrow_back</span>
        </a>
        <div>
            <h1 class="text-2xl font-black text-[#2d2421] dark:text-white">แก้ไขข้อมูลสมาชิก</h1>
            <p class="text-[#8c746a] text-sm">จัดการข้อมูลบัญชีและรหัสผ่าน</p>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 flex items-center gap-3 text-green-700 dark:text-green-400">
        <span class="material-symbols-outlined">check_circle</span>
        <span class="font-bold">{{ session('success') }}</span>
    </div>
    @endif

    <form action="{{ route('admin.user.update', $data_user->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        
        <div class="lg:col-span-1 space-y-6">
            
            <div class="bg-white dark:bg-[#251d1a] rounded-2xl border border-[#f3e9e5] dark:border-[#3d2f2a] p-6 text-center">
                <div class="relative inline-block group">
                    <div id="preview-image" 
                         class="size-32 rounded-2xl bg-cover bg-center border-4 border-[#faf6f4] dark:border-[#3d2f2a] shadow-lg mx-auto mb-4"
                         style="background-image: url('{{ $data_user->photo ? asset('storage/'.$data_user->photo) : asset('storage/profile_photos/default-avatar.jpg') }}');">
                    </div>
                    <label for="photo-upload" class="absolute bottom-2 -right-2 size-10 bg-primary text-white rounded-full flex items-center justify-center cursor-pointer shadow-md hover:bg-primary-hover transition-all">
                        <span class="material-symbols-outlined text-xl">edit</span>
                    </label>
                    <input type="file" id="photo-upload" name="photo" class="hidden" accept="image/*" onchange="previewFile()">
                </div>
                <h3 class="text-lg font-bold text-[#2d2421] dark:text-white">{{ $data_user->fullname }}</h3>
                <p class="text-sm text-[#8c746a]">{{ $data_user->role }}</p>
            </div>

            <div class="bg-white dark:bg-[#251d1a] rounded-2xl border border-[#f3e9e5] dark:border-[#3d2f2a] p-6 shadow-sm ring-1 ring-primary/5">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-primary">lock_reset</span>
                    <h4 class="font-bold text-[#2d2421] dark:text-white">รีเซ็ทรหัสผ่าน</h4>
                </div>

                <div class="space-y-3">
                    <div class="relative">
                        <input type="text" id="new_password" name="password" 
                            class="w-full h-11 pl-4 pr-10 rounded-xl bg-[#faf6f4] dark:bg-[#1a1513] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white font-mono text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none"
                            placeholder="ระบุรหัสผ่านใหม่ หรือกดสุ่ม" autocomplete="off">
                        
                        <button type="button" onclick="generateNewPassword()" class="absolute right-2 top-1/2 -translate-y-1/2 text-[#8c746a] hover:text-primary transition-colors p-1" title="สุ่มรหัสผ่าน">
                            <span class="material-symbols-outlined text-xl">autorenew</span>
                        </button>
                    </div>

                    <div class="flex gap-2">
                        <button type="button" onclick="copyCredentials()" class="flex-1 h-10 rounded-lg bg-gray-100 dark:bg-[#342a26] text-[#2d2421] dark:text-gray-300 font-bold text-xs flex items-center justify-center gap-2 hover:bg-gray-200 dark:hover:bg-[#4d3c36] transition-all">
                            <span class="material-symbols-outlined text-base">content_copy</span>
                            คัดลอกส่งให้ นศ.
                        </button>
                        </div>
                    
                    <p class="text-[13px] text-[#EF0000] text-center mt-2">
                        * รหัสผ่านจะถูกบันทึกเมื่อกดปุ่ม "บันทึกการแก้ไข"
                    </p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-[#251d1a] rounded-2xl border border-[#f3e9e5] dark:border-[#3d2f2a] p-6 sm:p-8">
                <div class="flex items-center gap-2 mb-6 pb-4 border-b border-[#f3e9e5] dark:border-[#3d2f2a]">
                    <span class="material-symbols-outlined text-primary">edit_note</span>
                    <h3 class="text-xl font-bold text-[#2d2421] dark:text-white">ข้อมูลทั่วไป</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="form-group">
                        <label class="block text-sm font-bold text-[#2d2421] dark:text-white mb-2">Username</label>
                        <input type="text" name="username" value="{{ $data_user->username }}"
                            class="w-full h-11 px-4 rounded-xl bg-white dark:bg-[#1a1513] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary outline-none">
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-bold text-[#2d2421] dark:text-white mb-2">อีเมล</label>
                        <input type="email" name="email" value="{{ $data_user->email }}"
                            class="w-full h-11 px-4 rounded-xl bg-white dark:bg-[#1a1513] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary outline-none">
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-bold text-[#2d2421] dark:text-white mb-2">ชื่อ-นามสกุล</label>
                        <input type="text" id="fullname_input" name="fullname" value="{{ $data_user->fullname }}" required
                            class="w-full h-11 px-4 rounded-xl bg-white dark:bg-[#1a1513] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary outline-none">
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-bold text-[#2d2421] dark:text-white mb-2">รหัสนักศึกษา</label>
                        <input type="text" id="std_id_input" name="std_id" value="{{ $data_user->std_id }}" required
                            class="w-full h-11 px-4 rounded-xl bg-white dark:bg-[#1a1513] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary outline-none">
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-bold text-[#2d2421] dark:text-white mb-2">คณะ</label>
                        <select id="faculty_select" name="faculty" required
                            class="w-full h-11 px-4 rounded-xl bg-white dark:bg-[#1a1513] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary outline-none cursor-pointer">
                            <option value="" disabled>เลือกคณะ</option>
                            @foreach($faculties as $faculty)
                                <option value="{{ $faculty->id }}" {{ $data_user->faculty_id == $faculty->id ? 'selected' : '' }}>
                                    {{ $faculty->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-bold text-[#2d2421] dark:text-white mb-2">สาขาวิชา</label>
                        <select id="major_select" name="major" required
                            class="w-full h-11 px-4 rounded-xl bg-white dark:bg-[#1a1513] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary outline-none cursor-pointer disabled:opacity-50">
                            <option value="" disabled selected>กำลังโหลดข้อมูล...</option>
                        </select>
                    </div>

                    <div class="form-group md:col-span-2">
                        <label class="block text-sm font-bold text-[#2d2421] dark:text-white mb-2">สถานะบัญชี</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="status" value="Active" {{ $data_user->status == 'Active' ? 'checked' : '' }} class="text-primary focus:ring-primary">
                                <span class="text-sm text-[#2d2421] dark:text-white">ใช้งานปกติ</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="status" value="Inactive" {{ $data_user->status == 'Inactive' ? 'checked' : '' }} class="text-red-500 focus:ring-red-500">
                                <span class="text-sm text-[#2d2421] dark:text-white">ระงับการใช้งาน</span>
                            </label>
                        </div>
                    </div>

                </div>

                <div class="mt-8 pt-6 border-t border-[#f3e9e5] dark:border-[#3d2f2a] flex justify-end gap-3">
                    <a href="{{ url('/manage_user') }}" class="px-6 py-2.5 rounded-xl border border-[#e5e7eb] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white font-bold text-sm hover:bg-gray-50 dark:hover:bg-[#342a26] transition-all">
                        ยกเลิก
                    </a>
                    <button type="submit" class="px-8 py-2.5 rounded-xl bg-primary text-white font-bold text-sm shadow-lg shadow-primary/25 hover:bg-primary-hover transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">save</span>
                        บันทึกการแก้ไข
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // 1. Preview Image
    function previewFile() {
        const preview = document.getElementById('preview-image');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            preview.style.backgroundImage = `url(${reader.result})`;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    // 2. Dynamic Faculty/Major
    const facultySelect = document.getElementById('faculty_select');
    const majorSelect = document.getElementById('major_select');
    const currentMajorId = "{{ $data_user->major_id }}"; // รับค่าเดิมจาก DB

    function loadMajors(facultyId, selectedMajorId = null) {
        majorSelect.innerHTML = '<option disabled selected value="">กำลังโหลด...</option>';
        majorSelect.disabled = true;

        if (facultyId) {
            fetch(`{{ url('/api/majors') }}/${facultyId}`)
                .then(response => response.json())
                .then(data => {
                    majorSelect.innerHTML = '<option disabled selected value="">เลือกสาขาวิชา</option>';
                    if(data.length > 0){
                        data.forEach(major => {
                            const isSelected = (selectedMajorId == major.id) ? 'selected' : '';
                            const option = `<option value="${major.id}" ${isSelected}>${major.name}</option>`;
                            majorSelect.insertAdjacentHTML('beforeend', option);
                        });
                        majorSelect.disabled = false;
                    } else {
                        majorSelect.innerHTML = '<option disabled selected value="">ไม่พบสาขาวิชา</option>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    majorSelect.innerHTML = '<option disabled selected value="">เกิดข้อผิดพลาด</option>';
                });
        }
    }

    // โหลดครั้งแรกเมื่อเปิดหน้า
    document.addEventListener('DOMContentLoaded', function() {
        const initialFacultyId = facultySelect.value;
        if(initialFacultyId) {
            loadMajors(initialFacultyId, currentMajorId);
        }
    });

    // โหลดเมื่อเปลี่ยนคณะ
    facultySelect.addEventListener('change', function() {
        loadMajors(this.value);
    });

    // 3. Generate Password
    function generateNewPassword() {
        const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        let newPassword = "";
        for (let i = 0; i < 8; i++) {
            newPassword += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        document.getElementById('new_password').value = newPassword;
    }

    // 4. Copy Credentials
    function copyCredentials() {
        const fullname = document.getElementById('fullname_input').value;
        const stdId = document.getElementById('std_id_input').value;
        const password = document.getElementById('new_password').value;
        
        if(!password) {
            alert('กรุณากำหนดรหัสผ่านใหม่ก่อนคัดลอก');
            return;
        }

        const textToCopy = `แจ้งข้อมูลการเข้าใช้งานระบบ\nชื่อ: ${fullname}\nรหัส: ${stdId}\nรหัสผ่านใหม่: ${password}\n\nกรุณาเปลี่ยนรหัสผ่านหลังเข้าใช้งาน`;

        navigator.clipboard.writeText(textToCopy).then(() => {
            alert("คัดลอกข้อมูลเรียบร้อยแล้ว!\nสามารถนำไปส่งให้นักศึกษาได้เลย");
        });
    }
</script>

@endsection