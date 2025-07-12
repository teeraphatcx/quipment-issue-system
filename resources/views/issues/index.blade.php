<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายการแจ้งปัญหา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">รายการแจ้งปัญหาครุภัณฑ์</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>วันที่</th>
                <th>อาคาร</th>
                <th>ห้อง</th>
                <th>ครุภัณฑ์</th>
                <th>อีเมล</th>
                <th>ภาพ</th>
                <th>สถานะ</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($issues as $issue)
                <tr>
                    <td>{{ $issue->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $issue->building }}</td>
                    <td>{{ $issue->room }}</td>
                    <td>{{ $issue->equipment }}</td>
                    <td>{{ $issue->email }}</td>
                    <td>
                        @if($issue->image_path)
                            <img src="{{ asset('storage/' . $issue->image_path) }}" alt="ภาพ" width="80">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($issue->status == 'pending')
                            <span class="badge bg-warning text-dark">รอดำเนินการ</span>
                        @else
                            <span class="badge bg-success">ตอบแล้ว</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.issues.reply', $issue->id) }}" class="btn btn-sm btn-primary">ตอบกลับ</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $issues->links() }}
</div>
</body>
</html>
