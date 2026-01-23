@extends('layouts.themeNew')

@section('content')
<!-- modal ดูทั้งหมด -->
<div aria-modal="true"
    class="fixed inset-0 z-[60] bg-[#1a1513]/70 backdrop-blur-sm hidden items-center justify-center p-4 opacity-100 animate-in fade-in zoom-in duration-300"
    id="pending-modal"
    role="dialog">
    <div class="bg-white dark:bg-[#1a1513] w-full max-w-3xl rounded-3xl shadow-2xl flex flex-col max-h-[85vh] border border-[#f3e9e5] dark:border-[#3d2f2a] overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-[#f3e9e5] dark:border-[#3d2f2a] bg-white dark:bg-[#1a1513] sticky top-0 z-10">
            <div class="flex items-center gap-5">
                <div>
                    <h3 class="text-2xl font-black text-[#2d2421] dark:text-white tracking-tight">
                        รายการรอการอนุมัติสมาชิก
                    </h3>
                    <p class="text-sm text-[#8c746a]">
                        มีรายการที่ต้องตรวจสอบทั้งหมด {{ count($user_pending) }} รายการ
                    </p>
                </div>
            </div>
            <button onclick="closePendingModal()"
                class="size-10 rounded-full flex items-center justify-center bg-[#faf6f4] dark:bg-[#342a26] hover:bg-orange-100 dark:hover:bg-orange-900/20 text-[#8c746a] hover:text-primary transition-all">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <div class="overflow-y-auto custom-scrollbar p-6 space-y-4 bg-[#faf6f4]/30 dark:bg-[#1f1a17]">
            @foreach($user_pending as $item)
            <div class="group flex flex-col sm:flex-row items-start sm:items-center gap-4 p-5 rounded-2xl border border-[#f3e9e5] dark:border-[#3d2f2a] bg-white dark:bg-[#251d1a] shadow-sm hover:shadow-md hover:border-primary/30 transition-all">
                <div class="size-14 rounded-xl bg-cover bg-center shrink-0 border border-gray-100 dark:border-gray-700"
                    style="background-image: url('{{ url('storage/' . ($item->photo ?? 'default-avatar.jpg')) }}');"></div>
                <div class="flex-1 min-w-0">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-1">
                        <div>
                            <h4 class="text-base font-bold text-[#2d2421] dark:text-white">{{ $item->fullname }}</h4>
                            <p class="text-xs text-[#8c746a] font-medium mt-0.5">
                                รหัสนักศึกษา: <span class="text-primary font-bold">{{ $item->std_id }}</span>
                            </p>
                        </div>
                        <div class="text-left sm:text-right mt-1 sm:mt-0">
                            <p class="text-xs font-bold text-[#2d2421] dark:text-gray-300">{{ $item->facultyDetail->name }}</p>
                            <p class="text-[11px] text-[#8c746a]">{{ $item->majorDetail->name }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3 w-full sm:w-auto mt-2 sm:mt-0 pt-2 sm:pt-0 border-t sm:border-t-0 border-[#f3e9e5] dark:border-[#3d2f2a]">
                    <button onclick="openRejectModal('{{ $item->id }}', '{{ $item->fullname }}', '{{ $item->std_id }}', '{{ $item->facultyDetail->name }}', '{{ $item->majorDetail->name }}', '{{ $item->photo }}')"
                        class="flex-1 sm:flex-none px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-transparent text-gray-500 hover:text-accent-red hover:border-accent-red/30 hover:bg-accent-red/5 text-xs font-bold transition-all">
                        ปฏิเสธ
                    </button>
                    <button onclick="openApproveModal('{{ $item->id }}', '{{ $item->fullname }}', '{{ $item->std_id }}', '{{ $item->facultyDetail->name }}', '{{ $item->majorDetail->name }}', '{{ $item->photo }}')"
                        class="flex-1 sm:flex-none px-5 py-2 rounded-xl bg-primary text-white hover:bg-primary-hover shadow-lg shadow-primary/20 text-xs font-bold transition-all">
                        อนุมัติ
                    </button>
                </div>
            </div>
            @endforeach

            <!-- ปุ่มอนุมัติทั้งหมด -->
            @if(count($user_pending) > 0)
            <div class="flex justify-end pt-2">
                <button onclick="approveAllMembers()"
                    class="flex items-center gap-2 px-5 py-2.5 bg-accent-green text-white rounded-xl text-sm font-bold shadow-lg shadow-accent-green/25 bg-[#216b30] transition-all group hover:bg-[#1a5526]">
                    <span class="material-symbols-outlined text-xl group-hover:scale-110 transition-transform">done_all</span>
                    อนุมัติทั้งหมด ({{ count($user_pending) }} คน)
                </button>
            </div>
            @endif
        </div>
    </div>
</div>

<div id="addMemberModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4" role="dialog" aria-modal="true">
    <div onclick="closeAddMemberModal()" class="fixed inset-0 bg-[#2d2421]/60 backdrop-blur-sm transition-opacity"></div>
    
    <div class="relative w-full max-w-4xl transform overflow-hidden rounded-3xl bg-white dark:bg-[#1a1513] text-left shadow-2xl transition-all border border-[#f3e9e5] dark:border-[#3d2f2a] max-h-[90vh] flex flex-col">
        
        <div class="flex items-center justify-between p-6 border-b border-[#f3e9e5] dark:border-[#3d2f2a] sticky top-0 bg-white dark:bg-[#1a1513] z-10">
            <div>
                <h3 class="text-2xl font-black text-[#2d2421] dark:text-white">เพิ่มสมาชิกใหม่</h3>
                <p class="mt-1 text-sm text-[#8c746a]">กรอกข้อมูลเพื่อลงทะเบียนสมาชิกเข้าระบบ</p>
            </div>
            <button onclick="closeAddMemberModal()" class="rounded-full p-2 text-[#8c746a] hover:bg-[#f3e9e5] dark:hover:bg-[#3d2f2a] transition-colors">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>
        </div>

        <div class="overflow-y-auto custom-scrollbar p-6 bg-[#faf6f4]/30 dark:bg-[#1f1a17]">
            <form id="addMemberForm" class="flex flex-col gap-6" enctype="multipart/form-data">
                @csrf 
                
                <div class="bg-white dark:bg-[#251d1a] rounded-2xl border border-[#f3e9e5] dark:border-[#3d2f2a] p-6">
                    <div class="flex items-center gap-2 pb-4 mb-4 border-b border-[#f3e9e5] dark:border-[#3d2f2a]">
                        <span class="material-symbols-outlined text-primary">person</span>
                        <h4 class="text-lg font-bold text-[#2d2421] dark:text-white">ข้อมูลส่วนตัว</h4>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-[#2d2421] dark:text-white">ชื่อ-นามสกุล <span class="text-red-500">*</span></span>
                            <input name="fullname" required
                                class="w-full h-11 px-4 rounded-xl bg-white dark:bg-[#342a26] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none placeholder:text-[#8c746a]" 
                                placeholder="ระบุชื่อจริงและนามสกุล" 
                                type="text" />
                        </label>
                        
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-[#2d2421] dark:text-white">รหัสนักศึกษา <span class="text-red-500">*</span></span>
                            <input name="std_id" required
                                class="w-full h-11 px-4 rounded-xl bg-white dark:bg-[#342a26] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none placeholder:text-[#8c746a]" 
                                placeholder="รหัสนักศึกษา 10 หลัก" 
                                type="text" />
                        </label>
                        
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-[#2d2421] dark:text-white">
                                คณะ <span class="text-red-500">*</span>
                            </span>
                            <div class="relative">
                                <select id="modal_faculty" name="faculty" required
                                    class="w-full h-11 px-4 rounded-xl bg-white dark:bg-[#342a26] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none cursor-pointer appearance-none">
                                    <option value="" disabled selected>เลือกคณะ</option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-[#2d2421] dark:text-white">
                                    <span class="material-symbols-outlined text-[20px]">expand_more</span>
                                </div>
                            </div>
                        </label>

                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-[#2d2421] dark:text-white">
                                สาขาวิชา <span class="text-red-500">*</span>
                            </span>
                            <div class="relative">
                                <select id="modal_major" name="major" required disabled
                                    class="w-full h-11 px-4 rounded-xl bg-white dark:bg-[#342a26] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none cursor-pointer appearance-none disabled:opacity-50 disabled:cursor-not-allowed">
                                    <option value="" disabled selected>กรุณาเลือกคณะก่อน</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-[#2d2421] dark:text-white">
                                    <span class="material-symbols-outlined text-[20px]">expand_more</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="bg-white dark:bg-[#251d1a] rounded-2xl border border-[#f3e9e5] dark:border-[#3d2f2a] p-6">
                    <div class="flex items-center gap-2 pb-4 mb-4 border-b border-[#f3e9e5] dark:border-[#3d2f2a]">
                        <span class="material-symbols-outlined text-primary">badge</span>
                        <h4 class="text-lg font-bold text-[#2d2421] dark:text-white">รูปถ่าย</h4>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4 items-start">
                        <div id="photoPreviewContainer" class="size-24 shrink-0 bg-[#faf6f4] dark:bg-[#342a26] rounded-xl flex items-center justify-center border border-[#f3e9e5] dark:border-[#3d2f2a] overflow-hidden bg-cover bg-center bg-no-repeat">
                            <span id="photoPlaceholder" class="material-symbols-outlined text-4xl text-[#8c746a]">account_circle</span>
                        </div>
                        <div class="flex-1 w-full">
                            <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-[#f3e9e5] dark:border-[#3d2f2a] rounded-xl cursor-pointer bg-[#faf6f4] dark:bg-[#342a26] hover:bg-white dark:hover:bg-[#251d1a] transition-colors group">
                                <div class="flex flex-col items-center justify-center">
                                    <span class="material-symbols-outlined text-2xl text-[#8c746a] group-hover:text-primary mb-1 transition-colors">cloud_upload</span>
                                    <p class="text-xs text-[#2d2421] dark:text-white font-medium">คลิกเพื่ออัปโหลดรูปภาพ</p>
                                    <p class="text-[10px] text-[#8c746a]">PNG, JPG (สูงสุด 2MB)</p>
                                </div>
                                <input id="photoInput" name="photo" class="hidden" type="file" accept="image/*" />
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-[#251d1a] rounded-2xl border border-[#f3e9e5] dark:border-[#3d2f2a] p-6">
                    <div class="flex items-center justify-between pb-4 mb-4 border-b border-[#f3e9e5] dark:border-[#3d2f2a]">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">lock</span>
                            <h4 class="text-lg font-bold text-[#2d2421] dark:text-white">ข้อมูลบัญชีผู้ใช้</h4>
                        </div>
                        <button type="button" onclick="generateCredentials()" 
                            class="text-sm text-primary hover:text-primary-dark font-bold flex items-center gap-1 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">autorenew</span>
                            สุ่มข้อมูลอัตโนมัติ
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-[#2d2421] dark:text-white">อีเมล <span class="text-red-500">*</span></span>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#8c746a] text-[20px]">email</span>
                                <input name="email" type="email"
                                    class="w-full h-11 pl-12 pr-4 rounded-xl bg-white dark:bg-[#342a26] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none placeholder:text-[#8c746a]" 
                                    placeholder="กรอกอีเมลของคุณ" />
                            </div>
                        </label>
                        
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-[#2d2421] dark:text-white">Username <span class="text-red-500">*</span></span>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#8c746a] text-[20px]">alternate_email</span>
                                <input id="gen_username" name="username" required
                                    class="w-full h-11 pl-12 pr-4 rounded-xl bg-white dark:bg-[#342a26] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none placeholder:text-[#8c746a]" 
                                    placeholder="ตั้งชื่อผู้ใช้งาน (ภาษาอังกฤษ)" 
                                    type="text" />
                            </div>
                        </label>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-bold text-[#2d2421] dark:text-white">รหัสผ่าน <span class="text-red-500">*</span></span>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#8c746a] text-[20px]">vpn_key</span>
                                    <input id="gen_password" name="password" required type="text"
                                        class="w-full h-11 pl-12 pr-4 rounded-xl bg-white dark:bg-[#342a26] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none placeholder:text-[#8c746a]" 
                                        placeholder="อย่างน้อย 8 ตัวอักษร" />
                                </div>
                            </label>
                            
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-bold text-[#2d2421] dark:text-white">ยืนยันรหัสผ่าน <span class="text-red-500">*</span></span>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#8c746a] text-[20px]">check_circle</span>
                                    <input id="gen_confirm" name="password_confirmation" required type="text"
                                        class="w-full h-11 pl-12 pr-4 rounded-xl bg-white dark:bg-[#342a26] border border-[#f3e9e5] dark:border-[#3d2f2a] text-[#2d2421] dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none placeholder:text-[#8c746a]" 
                                        placeholder="กรอกรหัสผ่านอีกครั้ง" />
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-[#251d1a] rounded-2xl border border-[#f3e9e5] dark:border-[#3d2f2a] p-6">
                    <div class="flex items-center gap-2 pb-4 mb-4 border-b border-[#f3e9e5] dark:border-[#3d2f2a]">
                        <span class="material-symbols-outlined text-primary">toggle_on</span>
                        <h4 class="text-lg font-bold text-[#2d2421] dark:text-white">สถานะบัญชี</h4>
                    </div>
                    
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="auto_approve" checked
                            class="size-5 rounded border-[#f3e9e5] dark:border-[#3d2f2a] text-primary focus:ring-2 focus:ring-primary/20" />
                        <span class="text-sm font-medium text-[#2d2421] dark:text-white">อนุมัติสมาชิกอัตโนมัติ</span>
                    </label>
                    <p class="text-xs text-[#8c746a] mt-2 ml-8">เมื่อเลือกตัวเลือกนี้ สมาชิกจะสามารถเข้าใช้งานระบบได้ทันที</p>
                </div>
            </form>
        </div>

        <div class="flex gap-3 bg-white dark:bg-[#251d1a] px-6 py-4 border-t border-[#f3e9e5] dark:border-[#3d2f2a] sticky bottom-0">
            <button onclick="closeAddMemberModal()" 
                class="flex-1 rounded-xl border border-[#e5e7eb] dark:border-[#3d2f2a] bg-white dark:bg-[#342a26] py-2.5 text-sm font-bold text-[#2d2421] dark:text-white shadow-sm hover:bg-gray-50 dark:hover:bg-[#4d3c36] transition-all">
                ยกเลิก
            </button>
            <button onclick="submitAddMember(this)" 
                class="flex-1 rounded-xl bg-primary py-2.5 text-sm font-bold text-white shadow-lg shadow-primary/25 hover:bg-primary-hover transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">person_add</span>
                เพิ่มสมาชิก
            </button>
        </div>
    </div>
</div>

<script>
    // 1. ฟังก์ชันเปิด-ปิด Modal
    function openAddMemberModal() {
        document.getElementById('addMemberModal').classList.remove('hidden');
        document.getElementById('addMemberModal').classList.add('flex');
    }
    function closeAddMemberModal() {
        document.getElementById('addMemberModal').classList.add('hidden');
        document.getElementById('addMemberModal').classList.remove('flex');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // 2. จัดการรูปภาพ (Preview)
        const photoInput = document.getElementById('photoInput');
        const photoPreviewContainer = document.getElementById('photoPreviewContainer');
        const photoPlaceholder = document.getElementById('photoPlaceholder');

        if(photoInput) {
            photoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // ซ่อน icon
                        photoPlaceholder.style.display = 'none';
                        // ใส่รูปเป็น background-image
                        photoPreviewContainer.style.backgroundImage = `url('${e.target.result}')`;
                    }
                    reader.readAsDataURL(file);
                } else {
                    photoPlaceholder.style.display = 'block';
                    photoPreviewContainer.style.backgroundImage = 'none';
                }
            });
        }

        // 3. จัดการเลือกคณะ -> สาขา (Dynamic Dropdown)
        const modalFacultySelect = document.getElementById('modal_faculty');
        const modalMajorSelect = document.getElementById('modal_major');

        if (modalFacultySelect && modalMajorSelect) {
            modalFacultySelect.addEventListener('change', function() {
                const facultyId = this.value;
                modalMajorSelect.innerHTML = '<option disabled selected value="">กำลังโหลดข้อมูล...</option>';
                modalMajorSelect.disabled = true;

                if (facultyId) {
                    fetch(`{{ url("/") }}/api/majors/${facultyId}`)
                        .then(response => response.json())
                        .then(data => {
                            modalMajorSelect.innerHTML = '<option disabled selected value="">เลือกสาขาวิชา</option>';
                            if(data.length > 0){
                                data.forEach(major => {
                                    const option = document.createElement('option');
                                    option.value = major.id;
                                    option.textContent = major.name;
                                    modalMajorSelect.appendChild(option);
                                });
                                modalMajorSelect.disabled = false; 
                            } else {
                                modalMajorSelect.innerHTML = '<option disabled selected value="">ไม่พบสาขาวิชา</option>';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            modalMajorSelect.innerHTML = '<option disabled selected value="">เกิดข้อผิดพลาด</option>';
                        });
                } else {
                    modalMajorSelect.innerHTML = '<option disabled selected value="">กรุณาเลือกคณะก่อน</option>';
                }
            });
        }
    });

    // 4. สุ่ม Username / Password
    function generateCredentials() {
        const usernameInput = document.getElementById('gen_username');
        const passwordInput = document.getElementById('gen_password');
        const confirmInput = document.getElementById('gen_confirm');

        const randomNum = Math.floor(1000 + Math.random() * 9000);
        const newUsername = 'user' + randomNum;

        const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        let newPassword = "";
        for (let i = 0; i < 8; i++) {
            newPassword += chars.charAt(Math.floor(Math.random() * chars.length));
        }

        usernameInput.value = newUsername;
        passwordInput.value = newPassword;
        confirmInput.value = newPassword;
    }

    // 5. บันทึกข้อมูล (Submit Form)
    function submitAddMember(btn) {
        const form = document.getElementById('addMemberForm');
        const formData = new FormData(form);
        
        // ตรวจสอบความถูกต้องเบื้องต้น
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        
        // เช็ค Password ตรงกันไหม
        const password = formData.get('password');
        const passwordConfirm = formData.get('password_confirmation');
        
        if (password !== passwordConfirm) {
            alert('รหัสผ่านไม่ตรงกัน กรุณาตรวจสอบอีกครั้ง');
            return;
        }
        
        // แปลงสถานะจาก Checkbox เป็น Text
        const autoApprove = document.querySelector('input[name="auto_approve"]').checked;
        formData.set('status', autoApprove ? 'Active' : 'Pending');
        
        // UI Loading
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin text-[20px]">progress_activity</span> กำลังบันทึก...';
        
        // ส่งข้อมูลไปยัง API
        fetch("{{ url('/') }}/api/add_member", {
            method: 'POST',
            headers: {
                // ถ้ามี CSRF Token ใน meta tag ให้ใช้ document.querySelector... แต่ในนี้ผมใส่ @csrf hidden input แล้ว มันจะไปกับ FormData อัตโนมัติ (แต่ถ้า API route แยก อาจต้องใช้ header นี้)
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('เพิ่มสมาชิกเรียบร้อยแล้ว');
                closeAddMemberModal();
                location.reload();
            } else {
                // กรณี Validation Error จาก Laravel จะส่งกลับมาเป็น errors object
                if(data.errors) {
                    let errorMsg = "";
                    for (const [key, value] of Object.entries(data.errors)) {
                        errorMsg += value + "\n";
                    }
                    alert('ตรวจสอบข้อมูล:\n' + errorMsg);
                } else {
                    alert('เกิดข้อผิดพลาด: ' + (data.message || 'Unknown error'));
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('เกิดข้อผิดพลาดในการเชื่อมต่อ');
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = originalText;
        });
    }
</script>

<style type="text/tailwindcss">
    @layer base {
            body {
                font-family: 'Manrope', 'Noto Sans Thai', sans-serif;
            }
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
          cursor: pointer;
        }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #3d2f2a;
        }main.items-center{
            align-items: start !important;
        }main.flex{
            display: block !important;
        }
    </style>
<div class="max-w-[1400px] mx-auto p-4 md:p-8 flex flex-col gap-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-1">
            <h1 class="text-4xl font-black tracking-tight text-[#2d2421] dark:text-white">หน้าจัดการสมาชิก</h1>
            <p class="text-[#8c746a] dark:text-gray-400 text-lg">ตรวจสอบคำขอใหม่และบริหารจัดการข้อมูลนักศึกษา</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-3">
                <button onclick="openAddMemberModal()" class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-xl text-sm font-bold shadow-xl shadow-primary/25 hover:bg-primary-hover transition-all">
                    <span class="material-symbols-outlined text-xl">person_add</span>
                    เพิ่มสมาชิกใหม่
                </button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // ใช้ ID ที่ตั้งใหม่ใน Modal
        const modalFacultySelect = document.getElementById('modal_faculty');
        const modalMajorSelect = document.getElementById('modal_major');

        if (modalFacultySelect && modalMajorSelect) {
            modalFacultySelect.addEventListener('change', function() {
                const facultyId = this.value;

                // 1. เคลียร์ค่าและปิดการใช้งานช่องสาขา
                modalMajorSelect.innerHTML = '<option disabled selected value="">กำลังโหลดข้อมูล...</option>';
                modalMajorSelect.disabled = true;

                if (facultyId) {
                    // 2. เรียก API ไปดึงข้อมูลสาขา (ใช้ Route เดิมที่มีอยู่)
                    fetch(`{{ url('/api/majors') }}/${facultyId}`)
                        .then(response => response.json())
                        .then(data => {
                            // 3. ใส่ข้อมูลลงใน Dropdown
                            modalMajorSelect.innerHTML = '<option disabled selected value="">เลือกสาขาวิชา</option>';
                            
                            if(data.length > 0){
                                data.forEach(major => {
                                    const option = document.createElement('option');
                                    option.value = major.id;
                                    option.textContent = major.name;
                                    modalMajorSelect.appendChild(option);
                                });
                                modalMajorSelect.disabled = false; // ปลดล็อก
                            } else {
                                modalMajorSelect.innerHTML = '<option disabled selected value="">ไม่พบสาขาวิชา</option>';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            modalMajorSelect.innerHTML = '<option disabled selected value="">เกิดข้อผิดพลาด</option>';
                        });
                } else {
                    modalMajorSelect.innerHTML = '<option disabled selected value="">กรุณาเลือกคณะก่อน</option>';
                }
            });
        }
    });
</script>

<script>

// ปิด Modal เมื่อกด ESC (อัพเดทเพิ่ม addMemberModal)
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeApproveModal();
        closeRejectModal();
        closePendingModal();
        closeAddMemberModal();
    }
});
    </script>
    @if(count($user_pending) != 0)
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-primary text-2xl font-semibold">assignment_late</span>
            <h3 class="text-lg font-bold text-[#2d2421] dark:text-white uppercase tracking-wide">
                รอการอนุมัติเร่งด่วน
                <span class="text-primary ml-2 font-black">({{ count($user_pending) }})</span>
            </h3>
        </div>
        <a onclick="openPendingModal()" class="text-sm font-bold text-primary hover:underline cursor-pointer">
            ดูทั้งหมด
        </a>
    </div>
    @endif
    <div class="flex gap-4 overflow-x-auto pb-4 custom-scrollbar snap-x">
        @foreach($user_pending as $item)
        <div class="min-w-[340px] snap-start bg-white dark:bg-[#251d1a] border border-primary/20 rounded-2xl p-4 shadow-sm flex items-center gap-4">
            <div class="size-14 rounded-xl bg-cover bg-center border border-primary/10 shrink-0" style="background-image: url('{{ url('storage/' . ($item->photo ?? 'default-avatar.jpg')) }}');"></div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-black text-[#2d2421] dark:text-white truncate">{{$item->fullname}}</p>
                <p class="text-[11px] text-primary font-bold">{{$item->std_id}} • {{ $item->majorDetail->name ?? '-' }}</p>
                <div class="flex gap-2 mt-2">
                    <button onclick="openRejectModal('{{$item->id}}', '{{$item->fullname}}', '{{$item->std_id}}', '{{$item->facultyDetail->name}}', '{{$item->majorDetail->name}}', '{{$item->photo}}')"
                        class="flex-1 py-1.5 bg-accent-red/10 text-accent-red hover:bg-accent-red rounded-lg text-[11px] font-bold transition-all border border-accent-red/20 hover:text-red-600">
                        ปฏิเสธ
                    </button>
                    <button onclick="openApproveModal('{{$item->id}}', '{{$item->fullname}}', '{{$item->std_id}}', '{{$item->facultyDetail->name}}', '{{$item->majorDetail->name}}', '{{$item->photo}}')"
                        class="flex-1 py-1.5 bg-primary text-white hover:bg-primary-hover rounded-lg text-[11px] font-bold transition-all">
                        อนุมัติ
                    </button>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <!-- Modal อนุมัติสมาชิก -->
    <div id="approveModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 sm:p-6" role="dialog" aria-modal="true" aria-labelledby="approve-modal-title">
        <div onclick="closeApproveModal()" class="fixed inset-0 bg-[#2d2421]/60 backdrop-blur-sm transition-opacity"></div>
        <div class="relative w-full max-w-[420px] transform overflow-hidden rounded-3xl bg-white dark:bg-[#1a1513] text-left shadow-2xl transition-all border border-[#f3e9e5] dark:border-[#3d2f2a]">
            <div class="absolute right-4 top-4 z-10">
                <button onclick="closeApproveModal()" class="rounded-full p-2 text-[#8c746a] hover:bg-[#f3e9e5] dark:hover:bg-[#3d2f2a] transition-colors" type="button">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>
            <div class="px-6 pt-8 pb-4 text-center">
                <h3 class="text-xl font-black text-[#2d2421] dark:text-white" id="approve-modal-title">ยืนยันการอนุมัติสมาชิก</h3>
                <p class="mt-1 text-sm text-[#8c746a]">ตรวจสอบข้อมูลก่อนยืนยันสถานะ</p>
            </div>
            <div class="px-6 pb-2">
                <div class="relative flex flex-col items-center rounded-2xl bg-[#ffffff] dark:bg-[#251d1a] p-6 border border-[#f3e9e5] dark:border-[#3d2f2a]">
                    <div class="relative mb-4">
                        <div id="approveProfileImage" class="size-20 rounded-2xl bg-cover bg-center shadow-md border-2 border-white dark:border-[#3d2f2a]"></div>
                        <div class="absolute -bottom-2 -right-2 flex size-6 items-center justify-center rounded-full bg-accent-green text-white shadow-sm ring-2 ring-white dark:ring-[#251d1a]">
                            <span class="material-symbols-outlined text-sm font-bold">check</span>
                        </div>
                    </div>
                    <h4 id="approveFullname" class="text-lg font-black text-[#2d2421] dark:text-white"></h4>
                    <div class="mt-1 inline-flex items-center rounded-lg bg-white dark:bg-[#342a26] px-2.5 py-1 text-xs font-bold text-[#8c746a] shadow-sm border border-[#f3e9e5] dark:border-[#3d2f2a]">
                        ID: <span id="approveStdId" class="ml-1"></span>
                    </div>
                    <div class="my-4 h-px w-full bg-[#f3e9e5] dark:bg-[#3d2f2a]"></div>
                    <div class="text-center">
                        <p class="text-xs font-bold uppercase tracking-wider text-[#8c746a]">สังกัดคณะ/สาขาวิชา</p>
                        <p id="approveFaculty" class="mt-1 text-sm font-bold text-primary"></p>
                        <p id="approveDepartment" class="text-sm font-medium text-[#2d2421] dark:text-gray-300"></p>
                    </div>
                </div>
            </div>
            <div class="px-8 py-3 text-center">
                <p class="text-xs text-[#8c746a]">
                    คุณได้ตรวจสอบความถูกต้องของข้อมูลและเอกสารแนบของนักศึกษาเรียบร้อยแล้ว
                </p>
            </div>
            <div class="flex gap-3 bg-[#ffffff] dark:bg-[#251d1a] px-6 py-5 border-t border-[#f3e9e5] dark:border-[#3d2f2a]">
                <button onclick="closeApproveModal()" class="flex-1 rounded-xl border border-[#e5e7eb] dark:border-[#3d2f2a] bg-white dark:bg-[#342a26] py-2.5 text-sm font-bold text-[#2d2421] dark:text-white shadow-sm hover:bg-gray-50 dark:hover:bg-[#4d3c36] transition-all" type="button">
                    ยกเลิก
                </button>
                <button onclick="confirmApprove()" class="flex-1 rounded-xl bg-primary py-2.5 text-sm font-bold text-white shadow-lg shadow-primary/25 hover:bg-primary-hover transition-all" type="button">
                    ยืนยันการอนุมัติ
                </button>
            </div>
        </div>
    </div>

    <!-- Modal ปฏิเสธสมาชิก -->
    <div id="rejectModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 sm:p-6" role="dialog" aria-modal="true" aria-labelledby="reject-modal-title">
        <div onclick="closeRejectModal()" class="fixed inset-0 bg-[#2d2421]/60 backdrop-blur-sm transition-opacity"></div>
        <div class="relative w-full max-w-[420px] transform overflow-hidden rounded-3xl bg-white dark:bg-[#1a1513] text-left shadow-2xl transition-all border border-[#f3e9e5] dark:border-[#3d2f2a]">
            <div class="absolute right-4 top-4 z-10">
                <button onclick="closeRejectModal()" class="rounded-full p-2 text-[#8c746a] hover:bg-[#f3e9e5] dark:hover:bg-[#3d2f2a] transition-colors" type="button">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>
            <div class="px-6 pt-8 pb-4 text-center">
                <h3 class="text-xl font-black text-[#2d2421] dark:text-white" id="reject-modal-title">ยืนยันการปฏิเสธสมาชิก</h3>
                <p class="mt-1 text-sm text-[#8c746a]">กรุณาระบุเหตุผลในการปฏิเสธ</p>
            </div>
            <div class="px-6 pb-2">
                <div class="relative flex flex-col items-center rounded-2xl bg-[#fdfdfd] dark:bg-[#251d1a] p-6 border border-[#f3e9e5] dark:border-[#3d2f2a]">
                    <div class="relative mb-4">
                        <div id="rejectProfileImage" class="size-20 rounded-2xl bg-cover bg-center shadow-md border-2 border-white dark:border-[#3d2f2a]"></div>
                        <div class="absolute -bottom-2 -right-2 flex size-6 items-center justify-center rounded-full bg-accent-red text-white shadow-sm ring-2 ring-white dark:ring-[#251d1a]">
                            <span class="material-symbols-outlined text-sm font-bold">close</span>
                        </div>
                    </div>
                    <h4 id="rejectFullname" class="text-lg font-black text-[#2d2421] dark:text-white"></h4>
                    <div class="mt-1 inline-flex items-center rounded-lg bg-white dark:bg-[#342a26] px-2.5 py-1 text-xs font-bold text-[#8c746a] shadow-sm border border-[#f3e9e5] dark:border-[#3d2f2a]">
                        ID: <span id="rejectStdId" class="ml-1"></span>
                    </div>
                    <div class="my-4 h-px w-full bg-[#f3e9e5] dark:bg-[#3d2f2a]"></div>
                    <div class="text-center">
                        <p class="text-xs font-bold uppercase tracking-wider text-[#8c746a]">สังกัดคณะ/สาขาวิชา</p>
                        <p id="rejectFaculty" class="mt-1 text-sm font-bold text-primary"></p>
                        <p id="rejectDepartment" class="text-sm font-medium text-[#2d2421] dark:text-gray-300"></p>
                    </div>
                </div>
            </div>
            <div class="px-8 py-3 text-center">
                <p class="text-xs text-accent-red/80">
                    ⚠️ การดำเนินการนี้ไม่สามารถยกเลิกได้
                </p>
            </div>
            <div class="flex gap-3 bg-[#fff] dark:bg-[#251d1a] px-6 py-5 border-t border-[#f3e9e5] dark:border-[#3d2f2a]">
                <button onclick="closeRejectModal()" class="flex-1 rounded-xl border border-[#e5e7eb] dark:border-[#3d2f2a] bg-white dark:bg-[#342a26] py-2.5 text-sm font-bold text-[#2d2421] dark:text-white shadow-sm hover:bg-gray-50 dark:hover:bg-[#4d3c36] transition-all" type="button">
                    ยกเลิก
                </button>
                <button onclick="confirmReject()" class="border flex-1 rounded-xl bg-white-red py-2.5 text-sm font-bold text-red-600 shadow-lg shadow-accent-red/25 hover:bg-red-600 hover:text-white transition-all" type="button">
                    ยืนยันการปฏิเสธ
                </button>
            </div>
        </div>
    </div>

    <script>
        // เพิ่มใน <script> section ของ blade file

        let currentUserId = null;

        // ฟังก์ชันเปิด Modal ดูทั้งหมด
        function openPendingModal() {
            const modal = document.getElementById('pending-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        // ฟังก์ชันปิด Modal ดูทั้งหมด
        function closePendingModal() {
            const modal = document.getElementById('pending-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // ฟังก์ชันอนุมัติทั้งหมด
        function approveAllMembers() {
            if (!confirm('คุณต้องการอนุมัติสมาชิกทั้งหมดใช่หรือไม่?')) {
                return;
            }

            fetch("{{ url('/') }}/api/approve_all_members", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert(`อนุมัติสมาชิกทั้งหมดเรียบร้อยแล้ว (${data.count} คน)`);
                        closePendingModal();
                        location.reload();
                    } else {
                        alert('เกิดข้อผิดพลาด: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('เกิดข้อผิดพลาดในการเชื่อมต่อ');
                });
        }

        // ฟังก์ชันเปิด Modal อนุมัติ
        function openApproveModal(id, fullname, stdId, faculty, department, profileImage) {
            currentUserId = id;
            document.getElementById('approveFullname').textContent = fullname;
            document.getElementById('approveStdId').textContent = stdId;
            document.getElementById('approveFaculty').textContent = faculty;
            document.getElementById('approveDepartment').textContent = department;
            const imageUrl = profileImage ? `{{ url('/') }}/storage/${profileImage}` : '/images/default-avatar.jpg';

            document.getElementById('approveProfileImage').style.backgroundImage = `url("${imageUrl}")`;

            const modal = document.getElementById('approveModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        // ฟังก์ชันปิด Modal อนุมัติ
        function closeApproveModal() {
            const modal = document.getElementById('approveModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
            currentUserId = null;
        }

        // ฟังก์ชันเปิด Modal ปฏิเสธ
        function openRejectModal(id, fullname, stdId, faculty, department, profileImage) {
            currentUserId = id;
            document.getElementById('rejectFullname').textContent = fullname;
            document.getElementById('rejectStdId').textContent = stdId;
            document.getElementById('rejectFaculty').textContent = faculty;
            document.getElementById('rejectDepartment').textContent = department;
            const imageUrl = profileImage ? `{{ url('/') }}/storage/${profileImage}` : '/images/default-avatar.jpg';
            document.getElementById('rejectProfileImage').style.backgroundImage = `url("${imageUrl}")`;

            const modal = document.getElementById('rejectModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        // ฟังก์ชันปิด Modal ปฏิเสธ
        function closeRejectModal() {
            const modal = document.getElementById('rejectModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
            currentUserId = null;
        }

        function confirmApprove() {
            fetch("{{ url('/') }}/api/approve_member", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        user_id: currentUserId,
                        action: 'approve'
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert('อนุมัติสมาชิกเรียบร้อยแล้ว');
                        closeApproveModal();
                        location.reload();
                    } else {
                        alert('เกิดข้อผิดพลาด: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('เกิดข้อผิดพลาดในการเชื่อมต่อ');
                });
        }

        function confirmReject() {
            fetch("{{ url('/') }}/api/approve_member", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        user_id: currentUserId,
                        action: 'reject'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('ปฏิเสธสมาชิกเรียบร้อยแล้ว');
                        closeRejectModal();
                        location.reload();
                    } else {
                        alert('เกิดข้อผิดพลาด: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('เกิดข้อผิดพลาดในการเชื่อมต่อ');
                });
        }

        // ปิด Modal เมื่อกด ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeApproveModal();
                closeRejectModal();
                closePendingModal();
            }
        });
    </script>
    <section class="space-y-6 flex-1">
        <div class="flex flex-col lg:flex-row gap-6 items-center justify-between">
            <h3 class="text-xl font-bold text-[#2d2421] dark:text-white uppercase tracking-wide">สมาชิกที่อนุมัติแล้ว</h3>
            <form method="GET" action="{{ url()->current() }}">
                <div class="flex flex-wrap items-center gap-4 w-full lg:w-auto">
                    <div class="relative flex-1 min-w-[300px]">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#8c746a]">search</span>
                        
                        <input 
                            name="search" 
                            value="{{ request('search') }}"
                            class="w-full pl-12 pr-4 py-2.5 bg-white dark:bg-[#251d1a] border border-[#f3e9e5] dark:border-[#3d2f2a] rounded-xl text-sm focus:ring-2 focus:ring-primary/20 transition-all outline-none" 
                            placeholder="ค้นหาชื่อ รหัสนักศึกษา หรือ Username..." 
                            type="text" 
                        />
                    </div>
                </div>
            </form>
        </div>
        <div class="bg-white dark:bg-[#251d1a] rounded-2xl border border-[#f3e9e5] dark:border-[#3d2f2a] overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">ข้อมูลสมาชิก</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">Username</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">คณะ/สาขา</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400">สถานะ</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-text-sub dark:text-gray-400 text-right">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#f3e9e5] dark:divide-[#3d2f2a]">
                        @foreach($user_active as $item)
                        <tr class="hover:bg-orange-50/30 dark:hover:bg-orange-900/5 transition-colors group">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="size-10 rounded-lg bg-cover bg-center border border-primary/10" style="background-image: url('{{ url('storage/' . ($item->photo ?? 'default-avatar.jpg')) }}');"></div>
                                    <div>
                                        <p class="text-sm font-bold text-[#2d2421] dark:text-white">{{$item->fullname}}</p>
                                        @if($item->role == 'อาจารย์')
                                        <p class="text-xs text-primary font-medium tracking-tight">อาจารย์</p>

                                        @else
                                        <p class="text-xs text-primary font-medium tracking-tight">ID: {{$item->std_id}}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-[#8c746a]">{{$item->username}}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1">
                                    <span class="text-[11px] font-bold text-[#2d2421] dark:text-white">{{ $item->facultyDetail->name ?? '-' }}</span>
                                    <span class="text-[10px] text-[#8c746a]">{{ $item->majorDetail->name ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5  bg-accent-green/10 text-accent-green text-xs font-bold rounded-full">
                                    <span class="size-1.5 bg-accent-green rounded-full"></span>
                                    @if($item->status == 'Active')
                                        อนุมัติแล้ว
                                    @else
                                        ระงับบัญชี
                                    @endif
                                </span>
                            </td>
                            <td class="px-8 py-4 text-right flex justify-end">
                                <div class="flex items-center justify-end gap-1  group-hover:opacity-100 transition-opacity">
                                    <button class="p-2 text-[#8c746a] hover:bg-blue-50 hover:text-blue-500 rounded-lg " title="แก้ไข">
                                        <span class="material-symbols-outlined text-xl">edit</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                        <!-- <tr class="hover:bg-orange-50/30 dark:hover:bg-orange-900/5 transition-colors group">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="size-10 rounded-lg bg-cover bg-center border border-primary/10" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuArE-0296CoVk2w-evrA0R2GkYCVgmgvy2SCsiwajItMwiL1uwF70vdNrdDoE7Qj9V11E7XC-T3r_wZnn57qlQL7wxcWy3tud-TsXLM14QM1OAPtL9DOmAvIVBC7tWRyirULjwMG0p25xF-wy6XGrPAupYlzghaZkWXdCPcfnLmNvArd9FH6jggXYuvs5BVCA_jMAoKeOvl36xvcvdBLz8ZGP-kgfsRF231xvluImSVESJZTGq1Syd5AB_ZwKdm08n-MhxB6t2IDOQ');"></div>
                                    <div>
                                        <p class="text-sm font-bold text-[#2d2421] dark:text-white">นายมานะ อดทน</p>
                                        <p class="text-xs text-primary font-medium tracking-tight">ID: 6401003</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 bg-orange-50 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400 text-[10px] font-bold rounded uppercase">ศิลปศาสตร์</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-[#8c746a]">mana_o</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-accent-green/10 text-accent-green text-xs font-bold rounded-full">
                                    <span class="size-1.5 bg-accent-green rounded-full"></span>
                                    อนุมัติแล้ว
                                </span>
                            </td>
                            <td class="px-8 py-4 text-right flex justify-end">
                                <div class="flex items-center justify-end gap-1  group-hover:opacity-100 transition-opacity">
                                    <button class="p-2 text-[#8c746a] hover:bg-blue-50 hover:text-blue-500 rounded-lg " title="แก้ไข">
                                        <span class="material-symbols-outlined text-xl">edit</span>
                                    </button>
                                    <button class="p-2 text-[#8c746a] hover:bg-accent-red/10 hover:text-accent-red rounded-lg " title="ลบ">
                                        <span class="material-symbols-outlined text-xl">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
            <style>
                ul.pagination {
                    display: flex;
                    align-items: center;
                    gap: 15px;
                }

                ul.pagination li {
                    width: 36px;
                    height: 36px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 12px;
                    color: #8c746a;
                    background: transparent;
                    cursor: pointer;
                    transition: background-color 0.2s ease;
                    font-size: 0.75rem;
                    font-weight: 700;

                }

                ul.pagination li:nth-child(1),
                ul.pagination li:nth-last-child(1) {

                    border: 1px solid #f3e9e5 !important;
                }

                ul.pagination li.active {
                    background-color: #137fec;
                    color: #fff;
                }

                /* Disabled */
                ul.pagination li.disabled {
                    opacity: 0.5;
                    cursor: not-allowed;
                }
            </style>
            <div class="bg-surface-light dark:bg-surface-dark border-t border-gray-200 dark:border-gray-800 px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-[11px] font-bold text-[#8c746a] uppercase tracking-wider">แสดง  {{ $user_active->firstItem() }} ถึง  {{ $user_active->lastItem() }} จากทั้งหมด {{ number_format($user_active->total()) }} สมาชิก</p>
                <div class="pagination-wrapper"> {!! $user_active->appends(['search' => Request::get('search')])->render() !!} </div>

            </div>
        </div>
    </section>
</div>
@endsection