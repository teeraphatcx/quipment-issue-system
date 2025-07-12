<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <title>คำถามที่พบบ่อย</title>
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

@section('title', 'คำถามที่พบบ่อย (FAQ)')

@section('content')

<div class="container py-5">
    <h2 class="mb-4 text-primary">
        <i class="bi bi-question-circle"></i> คำถามที่พบบ่อย (FAQ)
    </h2>

    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                    แจ้งปัญหาผ่านระบบยังไง?
                </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    ไปที่หน้าแรกของเว็บไซต์ แล้วกรอกข้อมูลในฟอร์มแจ้งปัญหาให้ครบถ้วน จากนั้นกด "ส่งแจ้งปัญหา"
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                    ต้องแนบรูปภาพหรือไม่?
                </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    ไม่จำเป็น แต่หากแนบรูปภาพมาด้วยจะช่วยให้เจ้าหน้าที่เข้าใจปัญหาได้ชัดเจนมากขึ้น
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                    จะทราบได้อย่างไรว่าปัญหาถูกตอบกลับแล้ว?
                </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    หากคุณกรอกอีเมลไว้ เจ้าหน้าที่จะส่งอีเมลตอบกลับเมื่อมีการดำเนินการ หรือสามารถติดต่อผ่านแอดมินได้
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq4">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                    ใช้เวลาในการแก้ไขนานแค่ไหน?
                </button>
            </h2>
            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    ปกติจะดำเนินการภายใน 1-3 วันทำการ ทั้งนี้ขึ้นอยู่กับความเร่งด่วนของปัญหา
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
