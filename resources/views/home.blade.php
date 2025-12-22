@extends('layouts.theme')

@section('content')
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจองห้องเรียน</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(47, 128, 237, 0.1);
            margin-bottom: 30px;
        }

        h1 {
            color: #2F80ED;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #6c757d;
            font-size: 14px;
        }

        .date-selector {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(47, 128, 237, 0.1);
            margin-bottom: 30px;
        }

        .date-selector label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-weight: 500;
        }

        .date-selector input {
            width: 100%;
            max-width: 300px;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .date-selector input:focus {
            outline: none;
            border-color: #2F80ED;
        }

        .rooms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .room-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(47, 128, 237, 0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .room-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 16px rgba(47, 128, 237, 0.2);
        }

        .room-header {
            background: #2F80ED;
            color: white;
            padding: 20px;
            font-size: 20px;
            font-weight: 600;
        }

        .room-body {
            padding: 20px;
        }

        .time-slot {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .time-slot:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .time-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .time-text {
            font-weight: 500;
            color: #333;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }

        .status-badge.available {
            background: #d4edda;
            color: #155724;
        }

        .status-badge.booked {
            background: #f8d7da;
            color: #721c24;
        }

        .status-badge::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 6px;
        }

        .status-badge.available::before {
            background: #28a745;
        }

        .status-badge.booked::before {
            background: #dc3545;
        }

        .book-btn {
            width: 100%;
            padding: 10px;
            background: #2F80ED;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }

        .book-btn:hover:not(:disabled) {
            background: #1a6bd6;
        }

        .book-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            animation: fadeIn 0.3s;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            max-width: 500px;
            width: 90%;
            animation: slideUp 0.3s;
        }

        .modal-header {
            color: #2F80ED;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2F80ED;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .modal-buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .modal-buttons button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-confirm {
            background: #2F80ED;
            color: white;
        }

        .btn-confirm:hover {
            background: #1a6bd6;
        }

        .btn-cancel {
            background: #f0f0f0;
            color: #333;
        }

        .btn-cancel:hover {
            background: #e0e0e0;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            header {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            .rooms-grid {
                grid-template-columns: 1fr;
            }

            .modal-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>ระบบจองห้องเรียน</h1>
            <p class="subtitle">เลือกวันที่และห้องที่ต้องการจอง</p>
        </header>

        <div class="date-selector">
            <label for="booking-date">เลือกวันที่</label>
            <input type="date" id="booking-date">
        </div>

        <div class="rooms-grid" id="rooms-container"></div>
    </div>

    <div class="modal" id="booking-modal">
        <div class="modal-content">
            <h2 class="modal-header">จองห้องเรียน</h2>
            <div class="form-group">
                <label>ห้อง</label>
                <input type="text" id="modal-room" readonly>
            </div>
            <div class="form-group">
                <label>ช่วงเวลา</label>
                <input type="text" id="modal-time" readonly>
            </div>
            <div class="form-group">
                <label>วันที่</label>
                <input type="text" id="modal-date" readonly>
            </div>
            <div class="form-group">
                <label>ชื่อผู้จอง</label>
                <input type="text" id="booker-name" placeholder="กรอกชื่อของคุณ">
            </div>
            <div class="form-group">
                <label>วัตถุประสงค์</label>
                <textarea id="booking-purpose" placeholder="กรอกวัตถุประสงค์การใช้ห้อง"></textarea>
            </div>
            <div class="modal-buttons">
                <button class="btn-cancel" onclick="closeModal()">ยกเลิก</button>
                <button class="btn-confirm" onclick="confirmBooking()">ยืนยันการจอง</button>
            </div>
        </div>
    </div>

    <script>
        const rooms = ['IT 401', 'IT 402', 'IT 403', 'IT 404'];
        const timeSlots = [
            { label: '8.30 - 12.30 น.', value: 'morning' },
            { label: '13.30 - 16.30 น.', value: 'afternoon' }
        ];

        // จำลองข้อมูลการจองห้อง
        const bookings = {};

        let currentBooking = null;

        function initializePage() {
            const dateInput = document.getElementById('booking-date');
            const today = new Date().toISOString().split('T')[0];
            dateInput.value = today;
            dateInput.min = today;
            
            dateInput.addEventListener('change', renderRooms);
            renderRooms();
        }

        function getBookingKey(room, date, timeSlot) {
            return `${room}-${date}-${timeSlot}`;
        }

        function isRoomAvailable(room, date, timeSlot) {
            const key = getBookingKey(room, date, timeSlot);
            return !bookings[key];
        }

        function renderRooms() {
            const container = document.getElementById('rooms-container');
            const selectedDate = document.getElementById('booking-date').value;
            container.innerHTML = '';

            rooms.forEach(room => {
                const card = document.createElement('div');
                card.className = 'room-card';

                const header = document.createElement('div');
                header.className = 'room-header';
                header.textContent = `ห้อง ${room}`;

                const body = document.createElement('div');
                body.className = 'room-body';

                timeSlots.forEach(slot => {
                    const isAvailable = isRoomAvailable(room, selectedDate, slot.value);
                    
                    const timeSlot = document.createElement('div');
                    timeSlot.className = 'time-slot';

                    const timeLabel = document.createElement('div');
                    timeLabel.className = 'time-label';

                    const timeText = document.createElement('span');
                    timeText.className = 'time-text';
                    timeText.textContent = slot.label;

                    const statusBadge = document.createElement('span');
                    statusBadge.className = `status-badge ${isAvailable ? 'available' : 'booked'}`;
                    statusBadge.textContent = isAvailable ? 'ว่าง' : 'ไม่ว่าง';

                    timeLabel.appendChild(timeText);
                    timeLabel.appendChild(statusBadge);

                    const bookBtn = document.createElement('button');
                    bookBtn.className = 'book-btn';
                    bookBtn.textContent = 'จองห้อง';
                    bookBtn.disabled = !isAvailable;
                    
                    if (isAvailable) {
                        bookBtn.onclick = () => openBookingModal(room, slot, selectedDate);
                    }

                    timeSlot.appendChild(timeLabel);
                    timeSlot.appendChild(bookBtn);
                    body.appendChild(timeSlot);
                });

                card.appendChild(header);
                card.appendChild(body);
                container.appendChild(card);
            });
        }

        function openBookingModal(room, timeSlot, date) {
            currentBooking = { room, timeSlot, date };
            
            document.getElementById('modal-room').value = `ห้อง ${room}`;
            document.getElementById('modal-time').value = timeSlot.label;
            document.getElementById('modal-date').value = formatDateThai(date);
            document.getElementById('booker-name').value = '';
            document.getElementById('booking-purpose').value = '';
            
            const modal = document.getElementById('booking-modal');
            modal.classList.add('active');
        }

        function closeModal() {
            const modal = document.getElementById('booking-modal');
            modal.classList.remove('active');
            currentBooking = null;
        }

        function confirmBooking() {
            const name = document.getElementById('booker-name').value.trim();
            const purpose = document.getElementById('booking-purpose').value.trim();

            if (!name) {
                alert('กรุณากรอกชื่อผู้จอง');
                return;
            }

            if (!purpose) {
                alert('กรุณากรอกวัตถุประสงค์');
                return;
            }

            const key = getBookingKey(
                currentBooking.room,
                currentBooking.date,
                currentBooking.timeSlot.value
            );

            bookings[key] = {
                name,
                purpose,
                bookedAt: new Date().toISOString()
            };

            alert(`จองห้อง ${currentBooking.room} สำเร็จ!\nช่วงเวลา: ${currentBooking.timeSlot.label}\nวันที่: ${formatDateThai(currentBooking.date)}`);
            
            closeModal();
            renderRooms();
        }

        function formatDateThai(dateString) {
            const date = new Date(dateString);
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('th-TH', options);
        }

        // ปิด modal เมื่อคลิกนอก modal content
        document.getElementById('booking-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // เริ่มต้นระบบ
        initializePage();
    </script>
</body>
</html>
@endsection
