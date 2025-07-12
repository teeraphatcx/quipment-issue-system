@extends('admin.layouts.app')

@section('title', 'แดชบอร์ด')

@section('content')
<div class="container py-4">

    <h2 class="mb-4 text-primary fw-bold">แดชบอร์ดระบบแจ้งปัญหาครุภัณฑ์</h2>

    <div class="row g-4 mb-5">
        <!-- รวมแจ้งปัญหาทั้งหมด -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-white bg-primary h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5 class="card-title mb-3 fs-5 fw-semibold">แจ้งปัญหาทั้งหมด</h5>
                    <h1 class="display-4 fw-bold">{{ $total }}</h1>
                    <i class="bi bi-exclamation-circle-fill fs-1 mt-3"></i>
                </div>
            </div>
        </div>

        <!-- รอดำเนินการ -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-dark bg-warning h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5 class="card-title mb-3 fs-5 fw-semibold">รอดำเนินการ (Pending)</h5>
                    <h1 class="display-4 fw-bold">{{ $pending }}</h1>
                    <i class="bi bi-hourglass-split fs-1 mt-3"></i>
                </div>
            </div>
        </div>

        <!-- ตอบกลับแล้ว -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-white bg-success h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h5 class="card-title mb-3 fs-5 fw-semibold">ตอบกลับแล้ว (Replied)</h5>
                    <h1 class="display-4 fw-bold">{{ $replied }}</h1>
                    <i class="bi bi-check-circle-fill fs-1 mt-3"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- กราฟวงกลมสถานะ -->
    <div class="card shadow-sm border-0 p-4">
        <h4 class="mb-4 text-center fw-semibold">สัดส่วนสถานะแจ้งปัญหา</h4>
        <canvas id="statusChart" style="max-width: 600px; margin: 0 auto;"></canvas>
    </div>

</div>

<!-- Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('statusChart').getContext('2d');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['รอดำเนินการ', 'ตอบกลับแล้ว'],
                datasets: [{
                    label: 'สถานะแจ้งปัญหา',
                    data: [{{ $pending }}, {{ $replied }}],
                    backgroundColor: [
                        'rgba(255, 193, 7, 0.85)',   // สีเหลืองทอง
                        'rgba(40, 167, 69, 0.85)'    // สีเขียวสด
                    ],
                    borderColor: [
                        'rgba(255, 193, 7, 1)',
                        'rgba(40, 167, 69, 1)'
                    ],
                    borderWidth: 2,
                    hoverOffset: 30,
                    cutout: '70%'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 16, weight: '600' },
                            color: '#333'
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: '#222',
                        titleFont: { weight: '700' },
                        bodyFont: { size: 14 }
                    }
                }
            }
        });
    });
</script>
@endsection
