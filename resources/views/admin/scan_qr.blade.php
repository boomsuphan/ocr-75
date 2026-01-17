@extends('layouts.themeNew')

@section('content')

{{-- Import Library --}}
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<style>
    #reader {
        width: 100%;
        border-radius: 12px;
        overflow: hidden;
        border: none !important;
    }
    #reader video {
        object-fit: cover;
        border-radius: 12px;
    }
    #qr-input-file {
        display: none;
    }
</style>

<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
    <div class="layout-container flex h-full grow flex-col">
        <div class="px-4 md:px-40 flex flex-1 justify-center py-10">
            <div class="layout-content-container flex flex-col w-full max-w-[480px]">
                
                {{-- Header --}}
                <div class="flex flex-col gap-2 p-4 text-center mb-2">
                    <h1 class="text-[#111418] dark:text-white text-3xl font-black leading-tight">สแกน QR Code</h1>
                </div>

                {{-- Card สำหรับ Scanner --}}
                <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-lg border border-zinc-100 dark:border-zinc-800 p-4">
                    
                    {{-- พื้นที่แสดงกล้อง --}}
                    <div class="relative bg-black rounded-xl overflow-hidden min-h-[300px] flex items-center justify-center mb-4">
                        <div id="reader"></div>
                        
                        {{-- ข้อความรอโหลด --}}
                        <div id="camera-placeholder" class="absolute text-white text-center">
                            <span class="material-symbols-outlined text-4xl mb-2">photo_camera</span>
                            <p>กำลังเปิดกล้อง...</p>
                        </div>
                    </div>

                    {{-- ปุ่มควบคุม --}}
                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="startCamera()" id="btn-camera" class="flex items-center justify-center h-12 rounded-lg bg-primary text-white font-bold gap-2 transition-all hover:bg-blue-600">
                            <span class="material-symbols-outlined">videocam</span>
                            เปิดกล้อง
                        </button>

                        <button onclick="triggerFileUpload()" class="flex items-center justify-center h-12 rounded-lg bg-zinc-100 dark:bg-zinc-800 text-[#111418] dark:text-white font-bold gap-2 transition-all hover:bg-zinc-200 dark:hover:bg-zinc-700">
                            <span class="material-symbols-outlined">image</span>
                            อัปโหลดรูป
                        </button>
                    </div>

                    {{-- Input File (ซ่อนอยู่) --}}
                    <input type="file" id="qr-input-file" accept="image/*" onchange="scanFile(this)">
                    
                    {{-- *** จุดสำคัญ: ต้องมี Div นี้สำหรับแสดง Error *** --}}
                    <div id="error-message" class="hidden mt-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm text-center"></div>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // --- Configuration ---
    const checkUrlBase = "{{ url('/check_qr') }}";
    const html5QrCode = new Html5Qrcode("reader");
    let isCameraRunning = false;

    // --- 1. ฟังก์ชันเมื่อสแกนสำเร็จ ---
    const onScanSuccess = (decodedText, decodedResult) => {
        console.log(`Scan result: ${decodedText}`);

        if (decodedText.startsWith(checkUrlBase)) {
            // >>> กรณีถูกต้อง
            if(isCameraRunning) {
                html5QrCode.stop().catch(() => {}).finally(() => {
                    window.location.href = decodedText;
                });
            } else {
                window.location.href = decodedText;
            }
        } else {
            // >>> กรณี QR Code ไม่ถูกต้อง
            handleScanError("QR Code ไม่ถูกต้อง! กรุณาสแกน QR Code จากระบบจองห้องเท่านั้น");
        }
    };

    // --- ฟังก์ชันจัดการ Error ---
    function handleScanError(message) {
        showError(message);
        document.getElementById('qr-input-file').value = '';
        if (!isCameraRunning) {
            startCamera(); 
        }
    }

    // --- 2. ฟังก์ชันเปิดกล้อง ---
    function startCamera() {
        document.getElementById('camera-placeholder').style.display = 'flex';
        
        if(isCameraRunning) return;

        const config = { fps: 10, qrbox: { width: 250, height: 250 } };
        
        html5QrCode.start({ facingMode: "environment" }, config, onScanSuccess)
        .then(() => {
            isCameraRunning = true;
            document.getElementById('camera-placeholder').style.display = 'none';
            document.getElementById('btn-camera').classList.add('ring-2', 'ring-offset-2', 'ring-primary');
        })
        .catch(err => {
            console.error(err);
            showError("ไม่สามารถเปิดกล้องได้ กรุณาอนุญาตการเข้าถึงกล้อง");
        });
    }

    // --- 3. ฟังก์ชันอัปโหลดไฟล์ ---
    function triggerFileUpload() {
        hideError(); // <--- จุดที่ Error: ตอนนี้แก้ไขให้ปลอดภัยแล้ว

        if (isCameraRunning) {
            html5QrCode.stop().then(() => {
                isCameraRunning = false;
                document.getElementById('btn-camera').classList.remove('ring-2', 'ring-offset-2', 'ring-primary');
            });
        }
        
        document.getElementById('camera-placeholder').style.display = 'none';
        document.getElementById('qr-input-file').click();
    }

    function scanFile(input) {
        if (input.files.length === 0) {
            startCamera();
            return;
        }

        const imageFile = input.files[0];
        
        html5QrCode.scanFile(imageFile, true)
        .then(decodedText => {
            onScanSuccess(decodedText);
        })
        .catch(err => {
            handleScanError("ไม่พบ QR Code ในรูปภาพที่อัปโหลด หรือรูปภาพไม่ชัดเจน");
        });
    }

    // --- Helper UI Functions (แก้ไขเพิ่ม if check) ---
    function showError(msg) {
        const errDiv = document.getElementById('error-message');
        if (errDiv) { // เช็คก่อนว่ามี Element ไหม
            errDiv.innerText = msg;
            errDiv.classList.remove('hidden');
        } else {
            console.error("Error div not found! Message:", msg);
            alert(msg); // ถ้าหา div ไม่เจอ ให้ alert แทน
        }
    }

    function hideError() {
        const errDiv = document.getElementById('error-message');
        if (errDiv) { // เช็คก่อนว่ามี Element ไหม
            errDiv.classList.add('hidden');
        }
    }

    // เริ่มต้นให้เปิดกล้องเลย
    startCamera();

</script>

@endsection