<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <title>แจ้งปัญหาการใช้งาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        .text-orange {
            color: #e36200; /* สีส้ม */
        }
    </style>
</head>
<body>
<header class="bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
<h5 class="mb-1 fw-bold">
  <a href="/" class="text-orange text-decoration-none">
    ระบบแจ้งปัญหาการใช้งานอุปกรณ์ห้องเรียน ห้องปฏิบัติการ ห้องประชุม
  </a>
</h5>


  <nav>
    <ul class="nav align-items-center gap-3 mb-0">
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center text-secondary" href="/faq">
          <i class="bi bi-question-circle me-1"></i>คำถามที่พบบ่อย
        </a>
      </li>
      <li>
        <div class="vr"></div>
      </li>
      <li class="nav-item">
        <a href="/admin/login" class="btn btn-warning ms-3">สำหรับเจ้าหน้าที่</a>
      </li>
    </ul>
  </nav>
</header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@extends('layouts.app') {{-- อ้างอิง layout หลัก --}}

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Sarabun', sans-serif, sans-serif;
        }
        .form-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .form-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #0d6efd;
        }
        .form-header h2 {
            color: #0d6efd;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .form-header p {
            color: #6c757d;
            margin: 0;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 16px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.15s ease-in-out;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
        .building-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
        }
        .building-btn {
            background-color: #e9ecef;
            border: 1px solid #dee2e6;
            color: #495057;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
        }
        .building-btn:hover {
            background-color: #dee2e6;
            border-color: #adb5bd;
        }
        .building-btn.active {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }
        .alert {
            border-radius: 6px;
            border: none;
            padding: 15px;
            margin-bottom: 20px;
        }
        .alert-success {
            background-color: #d1edff;
            color: #0c5460;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .required {
            color: #dc3545;
        }
        .form-section {
            margin-bottom: 25px;
        }
        .form-section:last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
<div class="form-container">
    <div class="form-header">
        <h2>ระบบแจ้งปัญหาครุภัณฑ์</h2>
        <p>กรุณากรอกข้อมูลให้ครบถ้วนเพื่อความรวดเร็วในการแก้ไข</p>
    </div>

    {{-- แสดงข้อความแจ้งเตือนจาก Laravel --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- แสดงข้อความ error validation --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="reportForm" method="POST" action="{{ route('issues.store') }}" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        <!-- อาคาร -->
        <div class="form-section">
            <label class="form-label">เลือกอาคาร <span class="required">*</span></label>
            <div class="building-buttons">
                <button type="button" class="building-btn" onclick="selectBuilding('อาคาร A', this)">อาคาร A</button>
                <button type="button" class="building-btn" onclick="selectBuilding('อาคาร B', this)">อาคาร B</button>
                <button type="button" class="building-btn" onclick="selectBuilding('อาคาร C', this)">อาคาร C</button>
                <button type="button" class="building-btn" onclick="selectBuilding('อาคาร D', this)">อาคาร D</button>
                <button type="button" class="building-btn" onclick="selectBuilding('อาคาร E', this)">อาคาร E</button>
            </div>
            <input type="hidden" name="building" id="buildingInput" value="{{ old('building') }}" required>
        </div>

        <!-- ห้อง -->
        <div class="form-section">
            <label for="room" class="form-label">เลือกห้อง <span class="required">*</span></label>
            <select name="room" id="room" class="form-select" required>
                <option value="">-- กรุณาเลือกอาคารก่อน --</option>
            </select>
        </div>

        <!-- ครุภัณฑ์ -->
        <div class="form-section">
            <label for="equipment" class="form-label">เลือกครุภัณฑ์ <span class="required">*</span></label>
            <select name="equipment" id="equipment" class="form-select" required onchange="loadDevices(this.value)" >
                <option value="">-- เลือกครุภัณฑ์ --</option>
                <option value="คอมพิวเตอร์">คอมพิวเตอร์</option>
                <option value="เครื่องปริ้น">เครื่องปริ้น</option>
                <option value="เครื่องฉาย">เครื่องฉาย</option>
                <option value="แอร์">แอร์</option>
                <option value="ไฟ">ไฟ</option>
                <option value="พัดลม">พัดลม</option>
                <option value="เครื่องเสียง">เครื่องเสียง</option>
                <option value="โต๊ะ">โต๊ะ</option>
                <option value="เก้าอี้">เก้าอี้</option>
                <option value="กระดานดำ">กระดานดำ</option>
                <option value="กระดานขาว">กระดานขาว</option>
                <option value="อื่นๆ">อื่นๆ</option>
            </select>
        </div>

        <!-- เครื่อง (ถ้ามี) -->
        <div class="form-section">
            <label for="device" class="form-label">เลือกเครื่อง (ถ้ามี)</label>
            <select name="device" id="device" class="form-select" disabled>
                <option value="">-- เลือกเครื่อง --</option>
            </select>
        </div>

        <!-- รายละเอียดเพิ่มเติม -->
        <div class="form-section">
            <label for="description" class="form-label">รายละเอียดปัญหา</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="อธิบายปัญหาที่พบ เช่น ไม่สามารถเปิดได้, เสียงดัง, หน้าจอเสีย เป็นต้น">{{ old('description') }}</textarea>
        </div>

        <!-- อีเมล -->
        <div class="form-section">
            <label for="email" class="form-label">อีเมลติดต่อ <span class="required">*</span></label>
            <input type="email" name="email" id="email" class="form-control" placeholder="example@university.ac.th" value="{{ old('email') }}" required>
        </div>

        <!-- รูปภาพ -->
        <div class="form-section">
            <label for="image" class="form-label">แนบรูปภาพ (ถ้ามี)</label>
            <input type="file" name="image" id="image" accept="image/*" class="form-control">
            <div class="form-text">รองรับไฟล์ JPG, PNG, GIF ขนาดไม่เกิน 5MB</div>
        </div>

        <button type="submit" class="btn btn-primary">ส่งแจ้งปัญหา</button>
    </form>
</div>

<script>
    // ตัวอย่างข้อมูลเครื่องย่อยตามครุภัณฑ์
    const devicesData = {
        'คอมพิวเตอร์': ['Dell Optiplex', 'HP Pavilion', 'Lenovo ThinkCentre'],
        'เครื่องปริ้น': ['HP LaserJet', 'Canon Pixma', 'Epson EcoTank'],
        'เครื่องฉาย': ['Epson Projector', 'BenQ Projector'],
        'แอร์': ['Daikin', 'Mitsubishi', 'Samsung'],
        'ไฟ': ['หลอด LED', 'หลอดฟลูออเรสเซนต์'],
        'พัดลม': ['พัดลมตั้งพื้น', 'พัดลมติดผนัง'],
        'เครื่องเสียง': ['ลำโพง JBL', 'เครื่องขยายเสียง Yamaha'],
        'โต๊ะ': [],
        'เก้าอี้': [],
        'กระดานดำ': [],
        'กระดานขาว': [],
        'อื่นๆ': []
    };

    function loadDevices(equipment) {
        const deviceSelect = document.getElementById('device');
        deviceSelect.innerHTML = '<option value="">-- เลือกเครื่อง --</option>';

        if (devicesData[equipment] && devicesData[equipment].length > 0) {
            devicesData[equipment].forEach(device => {
                const option = document.createElement('option');
                option.value = device;
                option.textContent = device;
                deviceSelect.appendChild(option);
            });
            deviceSelect.disabled = false;
        } else {
            deviceSelect.disabled = true;
        }
    }

    // ข้อมูลห้องแต่ละอาคาร
    const roomData = {
        'อาคาร A': [
            'ห้อง A101', 'ห้อง A102', 'ห้อง A103', 'ห้อง A104', 'ห้อง A105',
            'ห้อง A201', 'ห้อง A202', 'ห้อง A203', 'ห้อง A204', 'ห้อง A205',
            'ห้อง A301', 'ห้อง A302', 'ห้อง A303', 'ห้อง A304', 'ห้อง A305'
        ],
        'อาคาร B': [
            'ห้อง B101', 'ห้อง B102', 'ห้อง B103', 'ห้อง B104', 'ห้อง B105',
            'ห้อง B201', 'ห้อง B202', 'ห้อง B203', 'ห้อง B204', 'ห้อง B205',
            'ห้อง B301', 'ห้อง B302', 'ห้อง B303', 'ห้อง B304', 'ห้อง B305'
        ],
        'อาคาร C': [
            'ห้อง C101', 'ห้อง C102', 'ห้อง C103', 'ห้อง C104', 'ห้อง C105',
            'ห้อง C201', 'ห้อง C202', 'ห้อง C203', 'ห้อง C204', 'ห้อง C205',
            'ห้อง C301', 'ห้อง C302', 'ห้อง C303', 'ห้อง C304', 'ห้อง C305'
        ],
        'อาคาร D': [
            'ห้อง D101', 'ห้อง D102', 'ห้อง D103', 'ห้อง D104', 'ห้อง D105',
            'ห้อง D201', 'ห้อง D202', 'ห้อง D203', 'ห้อง D204', 'ห้อง D205',
            'ห้อง D301', 'ห้อง D302', 'ห้อง D303', 'ห้อง D304', 'ห้อง D305'
        ],
        'อาคาร E': [
            'ห้อง E101', 'ห้อง E102', 'ห้อง E103', 'ห้อง E104', 'ห้อง E105',
            'ห้อง E201', 'ห้อง E202', 'ห้อง E203', 'ห้อง E204', 'ห้อง E205',
            'ห้อง E301', 'ห้อง E302', 'ห้อง E303', 'ห้อง E304', 'ห้อง E305'
        ],
    };

    function selectBuilding(buildingName, button) {
        document.querySelectorAll('.building-btn').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
        document.getElementById('buildingInput').value = buildingName;
        loadRooms(buildingName);
    }

    function loadRooms(buildingName) {
        const roomSelect = document.getElementById('room');
        roomSelect.innerHTML = '<option value="">-- เลือกห้อง --</option>';

        if(roomData[buildingName]) {
            roomData[buildingName].forEach(room => {
                const option = document.createElement('option');
                option.value = room;
                option.textContent = room;
                roomSelect.appendChild(option);
            });

            // ถ้ามีค่า old room ให้เลือกไว้ด้วย (ถ้าใช้ Laravel old)
            @if(old('room'))
                let oldRoom = @json(old('room'));
                roomSelect.value = oldRoom;
            @endif
        }
    }

    // กรณีหน้าโหลดแล้ว มีค่า old ของ building ให้เซ็ต active และโหลดห้องอัตโนมัติ
    window.onload = function() {
        let oldBuilding = document.getElementById('buildingInput').value;
        if (oldBuilding) {
            // เลือกปุ่มอาคารที่ตรงกัน
            document.querySelectorAll('.building-btn').forEach(btn => {
                if(btn.textContent.trim() === oldBuilding) {
                    btn.classList.add('active');
                }
            });
            loadRooms(oldBuilding);
        }
    }

    function validateForm() {
        const building = document.getElementById('buildingInput').value.trim();
        const room = document.getElementById('room').value.trim();
        const equipment = document.getElementById('equipment').value.trim();
        const email = document.getElementById('email').value.trim();

        if (!building) {
            alert('กรุณาเลือกอาคาร');
            return false;
        }
        if (!room) {
            alert('กรุณาเลือกห้อง');
            return false;
        }
        if (!equipment) {
            alert('กรุณาเลือกครุภัณฑ์');
            return false;
        }
        if (!email) {
            alert('กรุณากรอกอีเมล');
            return false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('กรุณากรอกอีเมลให้ถูกต้อง');
            return false;
        }

        return true;
    }
</script>
</body>
</html>
