@extends('layouts.themeNew')

@section('content')
<style>
    /* Toggle Switch CSS */
    .switch {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 24px;
    }
    .switch input { opacity: 0; width: 0; height: 0; }
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 24px;
    }
    .slider:before {
        position: absolute;
        content: "";
        height: 18px; width: 18px;
        left: 3px; bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }
    input:checked + .slider { background-color: #137fec; }
    input:checked + .slider:before { transform: translateX(20px); }
    .slider.disabled { opacity: 0.5; cursor: not-allowed; }
</style>

<div class="flex flex-col max-w-[1200px] w-full mx-auto p-4 md:p-8 gap-6">
    {{-- Header & Alert Messages (คงเดิมจากโค้ดที่คุณส่งมา) --}}
    <div class="flex flex-col gap-2 border-b border-gray-200 dark:border-gray-800 pb-4">
        <h2 class="text-3xl font-black tracking-tight text-[#111418] dark:text-white">จัดการห้องเรียน</h2>
        <p class="text-gray-500 dark:text-gray-400">เพิ่ม ลบ และจัดการสถานะห้องเรียนในระบบ</p>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 text-green-700 border border-green-200 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        {{-- Section 1: Form (คงเดิม) --}}
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-surface-dark p-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 sticky top-4">
                <div class="flex items-center gap-3 mb-6">
                    <div class="size-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">add_location_alt</span>
                    </div>
                    <h3 class="font-bold text-lg text-[#111418] dark:text-white">เพิ่มห้องเรียนใหม่</h3>
                </div>

                <form action="{{ url('/save_room') }}" method="POST" class="flex flex-col gap-5" autocomplete="off">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold mb-2 text-[#111418] dark:text-white">ชื่อห้องเรียน <span class="text-red-500">*</span></label>
                        <input type="text" name="name" class="w-full h-11 px-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-zinc-800 text-[#111418] dark:text-white outline-none focus:ring-2 focus:ring-primary/20" placeholder="เช่น it 304" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2 text-[#111418] dark:text-white">ชั้น (Floor) <span class="text-red-500">*</span></label>
                        <input type="text" name="floor" class="w-full h-11 px-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-zinc-800 text-[#111418] dark:text-white outline-none focus:ring-2 focus:ring-primary/20" placeholder="เช่น 3" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2 text-[#111418] dark:text-white">สถานะแรกเริ่ม <span class="text-red-500">*</span></label>
                        <select name="status" class="w-full h-11 px-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-zinc-800 text-[#111418] dark:text-white outline-none focus:ring-2 focus:ring-primary/20 appearance-none cursor-pointer" required>
                            <option value="Active">ใช้งานปกติ (Active)</option>
                            <option value="Inactive">ปิดปรับปรุง (Inactive)</option>
                        </select>
                    </div>
                    <button type="submit" class="mt-2 w-full h-12 bg-primary hover:bg-primary-dark text-white font-bold rounded-xl shadow-lg transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">save</span>
                        บันทึกข้อมูล
                    </button>
                </form>
            </div>
        </div>

        {{-- Section 2: Table List --}}
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-surface-dark rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/20">
                    <h3 class="font-bold text-lg text-[#111418] dark:text-white">รายการห้องเรียน</h3>
                    <span class="text-xs font-medium px-2 py-1 bg-gray-200 dark:bg-gray-700 rounded text-gray-600 dark:text-gray-300">ทั้งหมด {{ count($rooms) }} ห้อง</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[600px]">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">ชื่อห้อง</th>
                                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-500">ชั้น</th>
                                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-500">เปิดใช้งาน</th>
                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach($rooms as $room)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="size-8 rounded-lg bg-blue-50 flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined text-[20px]">meeting_room</span>
                                        </div>
                                        <div class="text-base font-bold text-[#111418] dark:text-white">{{ $room->name }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center font-medium">{{ $room->floor }}</td>
                                <td class="px-6 py-4 text-center">
                                    <label class="switch">
                                        <input type="checkbox" 
                                               class="status-toggle" 
                                               data-id="{{ $room->id }}" 
                                               {{ $room->status == 'Active' ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button type="button" onclick="openDeleteModal('{{ $room->id }}', '{{ $room->name }}')" class="p-2 text-gray-400 hover:text-red-500 transition-all cursor-pointer">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Modal (คงเดิม) --}}
<dialog id="deleteModal" class="modal rounded-2xl shadow-2xl p-0 backdrop:bg-gray-900/50 backdrop-blur-sm">
    <div class="bg-white dark:bg-surface-dark w-[450px] p-8 rounded-2xl border border-gray-100 dark:border-gray-800">
        <div class="text-center mb-6">
            <div class="size-16 rounded-full bg-red-100 text-red-500 mx-auto flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-3xl">warning</span>
            </div>
            <h3 class="font-black text-xl text-[#111418] dark:text-white mb-2">ยืนยันการลบห้องเรียน</h3>
            <p class="text-sm text-gray-500">คุณกำลังจะลบห้อง <span id="modalRoomName" class="font-bold text-red-500"></span></p>
        </div>
        <form action="{{ url('/delete_room') }}" method="POST" class="flex flex-col gap-4" autocomplete="off">
            @csrf
            <input type="hidden" id="modalRoomId" name="room_id">
            <div class="relative">
                <label class="block text-sm font-bold mb-2">กรุณากรอกรหัสผ่านเพื่อยืนยัน</label>
                <input type="password" id="confirmPassword" name="password" autocomplete="new-password" class="w-full h-11 px-4 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-red-500/20" placeholder="รหัสผ่านของคุณ" required>
            </div>
            <div class="flex gap-3 mt-4">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 py-2.5 rounded-xl border border-gray-200 font-bold hover:bg-gray-50">ยกเลิก</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-red-500 text-white font-bold hover:bg-red-600">ยืนยัน</button>
            </div>
        </form>
    </div>
</dialog>

<script>
    // --- API Toggle Status ---
    document.querySelectorAll('.status-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const roomId = this.getAttribute('data-id');
            const newStatus = this.checked ? 'Active' : 'Inactive';
            const slider = this.nextElementSibling;

            // ปิดการใช้งานชั่วคราวขณะโหลด
            this.disabled = true;
            slider.classList.add('disabled');

            fetch('{{ url("api/admin/update_room_status") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    room_id: roomId,
                    status: newStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('เกิดข้อผิดพลาดในการอัปเดตสถานะ');
                    this.checked = !this.checked; // คืนค่าเดิม
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !this.checked;
            })
            .finally(() => {
                this.disabled = false;
                slider.classList.remove('disabled');
            });
        });
    });

    // --- Modal Delete Scripts (คงเดิม) ---
    function openDeleteModal(roomId, roomName) {
        document.getElementById('modalRoomId').value = roomId;
        document.getElementById('modalRoomName').textContent = roomName;
        document.getElementById('deleteModal').showModal();
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').close();
    }
</script>
@endsection