@extends('layouts.theme')

@section('content')

    <style>
        main{
            padding-top:100px !important;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            padding: 20px;
        }
        header {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
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
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
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
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 24px;
            margin-bottom: 30px;
        }

        .room-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .room-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .room-header {
            padding: 24px 24px 20px 24px;
            border-bottom: 1px solid #f0f0f0;
        }

        .room-title-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .room-title {
            font-size: 24px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .availability-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
        }

        .availability-badge.slots-1 {
            background: #FFF4E5;
            color: #FF9800;
        }

        .availability-badge.slots-2 {
            background: #FFF4E5;
            color: #FF9800;
        }

        .availability-badge.available {
            background: #E8F5E9;
            color: #2E7D32;
        }

        .room-info {
            display: flex;
            gap: 16px;
            color: #666;
            font-size: 14px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-item::before {
            content: '';
            width: 16px;
            height: 16px;
            background-size: contain;
            opacity: 0.7;
        }

        .info-item.location::before {
            content: '📍';
        }

        .info-item.capacity::before {
            content: '👥';
        }

        .room-body {
            padding: 20px 24px 24px 24px;
        }

        .booking-section-title {
            font-size: 14px;
            font-weight: 500;
            color: #666;
            margin-bottom: 12px;
        }

        .booked-times {
            background: #FFF3F3;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 16px;
        }

        .booked-times.available {
            background: #E8F5E9;
        }

        .booked-times-label {
            font-size: 13px;
            color: #666;
            margin-bottom: 6px;
        }

        .available-text {
            font-size: 13px;
            color: #2E7D32;
            font-weight: 500;
        }

        .time-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .time-tag {
            background: white;
            border: 1px solid #FFE0E0;
            color: #D32F2F;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
        }

        .time-selection {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 16px;
        }

        .time-select-group {
            position: relative;
        }

        .time-select-label {
            font-size: 13px;
            color: #666;
            margin-bottom: 6px;
            display: block;
        }

        .time-select {
            width: 100%;
            padding: 10px 36px 10px 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            color: #333;
            background: white;
            cursor: pointer;
            appearance: none;
            transition: border-color 0.2s;
            position: relative;
        }

        .time-select:hover {
            border-color: #2F80ED;
        }

        .time-select:focus {
            outline: none;
            border-color: #2F80ED;
        }

        .time-select-group::after {
            content: '⏰';
            position: absolute;
            right: 12px;
            top: 32px;
            pointer-events: none;
            font-size: 14px;
        }

        .time-select option {
            padding: 10px;
            font-size: 14px;
        }

        .time-select option:checked {
            background: #2F80ED;
            color: white;
        }

        .book-btn {
            width: 100%;
            padding: 14px;
            background: #8AB4F8;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }

        .book-btn:hover:not(:disabled) {
            background: #6B9FE8;
        }

        .book-btn:disabled {
            background: #E0E0E0;
            cursor: not-allowed;
            color: #999;
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

            .time-selection {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
 <!-- <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form> -->
    <script>
        const rooms = [
            { name: 'IT 401', building: 'อาคาร IT', capacity: 40 },
            { name: 'IT 402', building: 'อาคาร IT', capacity: 35 },
            { name: 'IT 403', building: 'อาคาร IT', capacity: 50 },
            { name: 'IT 501', building: 'อาคาร IT', capacity: 30 },
            { name: 'IT 502', building: 'อาคาร IT', capacity: 45 },
            { name: 'IT 503', building: 'อาคาร IT', capacity: 60 }
        ];

       const startTimes = [
            { value: '07:00', label: '07:00 น.' },
            { value: '07:30', label: '07:30 น.' },
            { value: '08:00', label: '08:00 น.' },
            { value: '08:30', label: '08:30 น.' },
            { value: '09:00', label: '09:00 น.' },
            { value: '09:30', label: '09:30 น.' },
            { value: '10:00', label: '10:00 น.' },
            { value: '10:30', label: '10:30 น.' },
            { value: '11:00', label: '11:00 น.' },
            { value: '11:30', label: '11:30 น.' },
            { value: '12:00', label: '12:00 น.' },
            { value: '12:30', label: '12:30 น.' },
            { value: '13:00', label: '13:00 น.' },
            { value: '13:30', label: '13:30 น.' },
            { value: '14:00', label: '14:00 น.' },
            { value: '14:30', label: '14:30 น.' },
            { value: '15:00', label: '15:00 น.' },
            { value: '15:30', label: '15:30 น.' },
            { value: '16:00', label: '16:00 น.' },
            { value: '16:30', label: '16:30 น.' },
            { value: '17:00', label: '17:00 น.' },
            { value: '17:30', label: '17:30 น.' },
            { value: '18:00', label: '18:00 น.' },
            { value: '18:30', label: '18:30 น.' },
            { value: '19:00', label: '19:00 น.' },
            { value: '19:30', label: '19:30 น.' },
            { value: '20:00', label: '20:00 น.' },
            { value: '20:30', label: '20:30 น.' },
            { value: '21:00', label: '21:00 น.' },
            { value: '21:30', label: '21:30 น.' },
            { value: '22:00', label: '22:00 น.' },
            { value: '22:30', label: '22:30 น.' },
            { value: '23:00', label: '23:00 น.' },
            { value: '23:30', label: '23:30 น.' },
            { value: '00:00', label: '00:00 น.' },
            { value: '00:30', label: '00:30 น.' },
            { value: '01:00', label: '01:00 น.' },
            { value: '01:30', label: '01:30 น.' },
        ];

        const endTimes = [...startTimes];

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

        function getBookingKey(room, date, startTime, endTime) {
            return `${room}-${date}-${startTime}-${endTime}`;
        }

        function getRandomBookedSlots(roomName, date) {
            const bookedSlots = [];
            const numBooked = Math.floor(Math.random() * 3);
            
            for (let i = 0; i < numBooked; i++) {
                const startIdx = Math.floor(Math.random() * (startTimes.length - 2));
                const endIdx = startIdx + 1 + Math.floor(Math.random() * 3);
                
                if (endIdx < endTimes.length) {
                    bookedSlots.push({
                        start: startTimes[startIdx].value,
                        end: endTimes[endIdx].value,
                        label: `${startTimes[startIdx].label} - ${endTimes[endIdx].label}`
                    });
                }
            }
            
            return bookedSlots;
        }

        function renderRooms() {
            const container = document.getElementById('rooms-container');
            const selectedDate = document.getElementById('booking-date').value;
            container.innerHTML = '';

            rooms.forEach((room, index) => {
                const bookedSlots = getRandomBookedSlots(room.name, selectedDate);
                const hasBookings = bookedSlots.length > 0;
                
                const card = document.createElement('div');
                card.className = 'room-card';

                let badgeClass = 'available';
                let badgeText = 'ว่างทั้งวัน';
                
                if (hasBookings) {
                    badgeClass = `slots-${bookedSlots.length}`;
                    badgeText = `จองแล้ว ${bookedSlots.length} ช่วง`;
                }

                let bookedTimesHTML = '';
                if (hasBookings) {
                    const timeTags = bookedSlots.map(slot => 
                        `<span class="time-tag">${slot.label}</span>`
                    ).join('');
                    
                    bookedTimesHTML = `
                        <div class="booked-times">
                            <div class="booked-times-label">ช่วงเวลาที่ถูกจอง:</div>
                            <div class="time-tags">${timeTags}</div>
                        </div>
                    `;
                } else {
                    bookedTimesHTML = `
                          <div class="booked-times available">
                            <div class="booked-times-label">ช่วงเวลาที่ถูกจอง</div>
                            <span class="available-text">ว่างทั้งวัน</span>
                        </div>
                    `;
                }

                card.innerHTML = `
                    <div class="room-header">
                        <div class="room-title-row">
                            <h2 class="room-title">${room.name}</h2>
                            <span class="availability-badge ${badgeClass}">${badgeText}</span>
                        </div>
                        <div class="room-info">
                            <span class="info-item location">${room.building}</span>
                            <span class="info-item capacity">${room.capacity} ที่นั่ง</span>
                        </div>
                    </div>
                    <div class="room-body">
                        ${bookedTimesHTML}
                        <button class="book-btn" onclick="bookRoom('${room.name}', '${selectedDate}')">
                            จองห้องเรียน
                        </button>
                    </div>
                `;

                container.appendChild(card);
            });
        }

        // function bookRoom(roomName, date) {
        //     const name = prompt('กรุณากรอกชื่อผู้จอง:');
        //     if (!name || !name.trim()) {
        //         return;
        //     }

        //     const startTime = prompt('กรุณากรอกเวลาเริ่ม (เช่น 08:30):');
        //     if (!startTime || !startTime.trim()) {
        //         return;
        //     }

        //     const endTime = prompt('กรุณากรอกเวลาสิ้นสุด (เช่น 10:30):');
        //     if (!endTime || !endTime.trim()) {
        //         return;
        //     }

        //     if (startTime >= endTime) {
        //         alert('เวลาสิ้นสุดต้องมากกว่าเวลาเริ่ม');
        //         return;
        //     }

        //     const purpose = prompt('กรุณากรอกวัตถุประสงค์:');
        //     if (!purpose || !purpose.trim()) {
        //         return;
        //     }

        //     const key = getBookingKey(roomName, date, startTime, endTime);
        //     bookings[key] = {
        //         name: name.trim(),
        //         purpose: purpose.trim(),
        //         bookedAt: new Date().toISOString()
        //     };

        //     alert(`จองห้อง ${roomName} สำเร็จ!\nช่วงเวลา: ${startTime} - ${endTime} น.\nวันที่: ${formatDateThai(date)}`);
        //     renderRooms();
        // }

        // function formatDateThai(dateString) {
        //     const date = new Date(dateString);
        //     const options = { year: 'numeric', month: 'long', day: 'numeric' };
        //     return date.toLocaleDateString('th-TH', options);
        // }

        // เริ่มต้นระบบ
        initializePage();
    </script>
@endsection