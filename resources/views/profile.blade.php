@extends('layouts.themeNew')

@section('content')

<div class="max-w-[1200px] mx-auto p-4 md:p-8">
    
    <div class="flex items-center gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#2d2421] dark:text-white">ข้อมูลส่วนตัว</h1>
            <p class="text-[#8c746a] text-sm">ดูและแก้ไขข้อมูลส่วนตัวของคุณ</p>
        </div>
    </div>

    {{-- Alert แจ้งเตือน --}}
    @if(session('success'))
    <div class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 flex items-center gap-3 text-green-700 dark:text-green-400">
        <span class="material-symbols-outlined">check_circle</span>
        <span class="font-bold">{{ session('success') }}</span>
    </div>
    @endif

    <form action="{{ url('/profile/update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        
        {{-- Column 1: รูปโปรไฟล์ (ซ้ายมือ) --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-[#251d1a] rounded-2xl border border-[#f3e9e5] dark:border-[#3d2f2a] p-6 text-center shadow-sm">
                <div class="relative inline-block group">
                    {{-- Preview รูปภาพ --}}
                    <div id="preview-image" 
                         class="size-40 rounded-full bg-cover bg-center border-4 border-[#faf6f4] dark:border-[#3d2f2a] shadow-lg mx-auto mb-4"
                         style="background-image: url('{{ $data_user->photo ? asset('storage/'.$data_user->photo) : asset('storage/profile_photos/default-avatar.jpg') }}');">
                    </div>
                    
                    {{-- ปุ่มอัปโหลดรูป --}}
                    <label for="photo-upload" class="absolute bottom-2 right-2 size-10 bg-primary text-white rounded-full flex items-center justify-center cursor-pointer shadow-md hover:bg-primary-hover transition-all z-10">
                        <span class="material-symbols-outlined text-xl">camera_alt</span>
                    </label>
                    <input type="file" id="photo-upload" name="photo" class="hidden" accept="image/*" onchange="previewFile()">
                </div>
                
                <h3 class="text-xl font-bold text-[#2d2421] dark:text-white mt-2">{{ $data_user->fullname }}</h3>
                <p class="text-sm text-[#8c746a]">{{ $data_user->role }}</p>
            </div>
        </div>

        {{-- Column 2-3: ฟอร์มข้อมูล (ขวามือ) --}}
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-[#251d1a] rounded-2xl border border-[#f3e9e5] dark:border-[#3d2f2a] p-6 sm:p-8 shadow-sm">
                <div class="flex items-center gap-2 mb-6 pb-4 border-b border-[#f3e9e5] dark:border-[#3d2f2a]">
                    <span class="material-symbols-outlined text-primary">person</span>
                    <h3 class="text-xl font-bold text-[#2d2421] dark:text-white">รายละเอียดข้อมูล</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Username (Read-only / ห้ามแก้ไข) --}}
                    <div class="form-group">
                        <label class="block text-sm font-bold text-[#8c746a] dark:text-gray-400 mb-2">Username (แก้ไขไม่ได้)</label>
                        <div class="relative">
                            <input type="text" value="{{ $data_user->username }}" readonly
                                class="w-full h-11 px-4 rounded-xl bg-gray-100 dark:bg-[#15100e] border border-gray-200 dark:border-[#3d2f2a] text-gray-500 dark:text-gray-400 cursor-not-allowed select-none">
                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">lock</span>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label class="block text-sm font-bold text-[#2d2421] dark:text-white mb-2">อีเมล</label>
                        <input type="email" name="email" value="{{ $data_user->email }}"
                            class="w-full h-11 px-4 rounded-xl bg-white dark:bg-[#1a1513] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary outline-none transition-all focus:ring-2 focus:ring-primary/10">
                    </div>

                    {{-- ชื่อ-นามสกุล --}}
                    <div class="form-group">
                        <label class="block text-sm font-bold text-[#2d2421] dark:text-white mb-2">ชื่อ-นามสกุล</label>
                        <input type="text" name="fullname" value="{{ $data_user->fullname }}" required
                            class="w-full h-11 px-4 rounded-xl bg-white dark:bg-[#1a1513] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary outline-none transition-all focus:ring-2 focus:ring-primary/10">
                    </div>

                    {{-- รหัสนักศึกษา --}}
                    <div class="form-group">
                        <label class="block text-sm font-bold text-[#2d2421] dark:text-white mb-2">รหัสนักศึกษา</label>
                        <input type="text" name="std_id" value="{{ $data_user->std_id }}" required
                            class="w-full h-11 px-4 rounded-xl bg-white dark:bg-[#1a1513] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary outline-none transition-all focus:ring-2 focus:ring-primary/10">
                    </div>

                    {{-- คณะ --}}
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

                    {{-- สาขาวิชา --}}
                    <div class="form-group">
                        <label class="block text-sm font-bold text-[#2d2421] dark:text-white mb-2">สาขาวิชา</label>
                        <select id="major_select" name="major" required
                            class="w-full h-11 px-4 rounded-xl bg-white dark:bg-[#1a1513] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary outline-none cursor-pointer disabled:opacity-50">
                            <option value="" disabled selected>กำลังโหลดข้อมูล...</option>
                        </select>
                    </div>

                </div>

                <div class="mt-8 pt-6 border-t border-[#f3e9e5] dark:border-[#3d2f2a] flex justify-end gap-3">
                    <a href="{{ url('/') }}" class="px-6 py-2.5 rounded-xl border border-[#e5e7eb] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white font-bold text-sm hover:bg-gray-50 dark:hover:bg-[#342a26] transition-all">
                        ยกเลิก
                    </a>
                    <button type="submit" class="px-8 py-2.5 rounded-xl bg-primary text-white font-bold text-sm shadow-lg shadow-primary/25 hover:bg-primary-hover transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">save</span>
                        บันทึกการเปลี่ยนแปลง
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // 1. Preview Image Script
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

    // 2. Dynamic Faculty/Major Script
    const facultySelect = document.getElementById('faculty_select');
    const majorSelect = document.getElementById('major_select');
    // ดึงค่า Major ID เดิมจาก Database มาเก็บไว้ในตัวแปร JS
    const currentMajorId = "{{ $data_user->major_id }}"; 

    function loadMajors(facultyId, selectedMajorId = null) {
        majorSelect.innerHTML = '<option disabled selected value="">กำลังโหลด...</option>';
        majorSelect.disabled = true;

        if (facultyId) {
            // เรียก API เพื่อดึงข้อมูลสาขา
            fetch(`{{ url('/api/majors') }}/${facultyId}`)
                .then(response => response.json())
                .then(data => {
                    majorSelect.innerHTML = '<option disabled selected value="">เลือกสาขาวิชา</option>';
                    if(data.length > 0){
                        data.forEach(major => {
                            // ตรวจสอบว่าสาขานี้ตรงกับค่าเดิมหรือไม่ ถ้าใช่ให้ selected
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

    // ทำงานทันทีเมื่อโหลดหน้าเว็บเสร็จ
    document.addEventListener('DOMContentLoaded', function() {
        const initialFacultyId = facultySelect.value;
        if(initialFacultyId) {
            // โหลดสาขาวิชา โดยส่งค่า Faculty ID และ Major ID เดิมไปด้วย
            loadMajors(initialFacultyId, currentMajorId);
        }
    });

    // ทำงานเมื่อมีการเปลี่ยนคณะ
    facultySelect.addEventListener('change', function() {
        loadMajors(this.value);
    });
</script>

@endsection