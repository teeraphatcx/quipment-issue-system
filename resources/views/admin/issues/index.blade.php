@extends('admin.layouts.app')

@section('title', 'รายการแจ้งปัญหาครุภัณฑ์')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary fw-bold"><i class="bi bi-tools"></i> รายการแจ้งปัญหาครุภัณฑ์</h2>

    <!-- ฟอร์มค้นหา -->
    <form method="GET" action="{{ route('admin.issues.index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="keyword" class="form-control" placeholder="ค้นหา อาคาร ห้อง ครุภัณฑ์..." value="{{ request('keyword') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">-- สถานะทั้งหมด --</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>รอดำเนินการ</option>
                <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>ตอบแล้ว</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100"><i class="bi bi-search"></i> ค้นหา</button>
        </div>
    </form>

    <!-- ตารางข้อมูล -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered align-middle table-hover">
            <thead class="table-light">
                <tr class="text-center">
                    <th>ID</th>
                    <th>อาคาร</th>
                    <th>ห้อง</th>
                    <th>ครุภัณฑ์</th>
                    <th>รายละเอียด</th>
                    <th>อีเมล</th>
                    <th>รูปภาพ</th>
                    <th>สถานะ</th>
                    <th>วันที่แจ้ง</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($issues as $issue)
                <tr>
                    <td class="text-center">{{ $issue->id }}</td>
                    <td>{{ $issue->building }}</td>
                    <td>{{ $issue->room }}</td>
                    <td>{{ $issue->equipment }}</td>
                    <td>{{ Str::limit($issue->description, 50) }}</td>
                    <td>{{ $issue->email }}</td>
                    <td class="text-center">
                        @if($issue->image_path)
                            <a href="{{ asset('storage/' . $issue->image_path) }}" target="_blank">
                                <img src="{{ asset('storage/' . $issue->image_path) }}" alt="รูปภาพ" width="60" class="rounded shadow-sm">
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($issue->status === 'pending')
                            <span class="badge bg-warning text-dark">รอดำเนินการ</span>
                        @else
                            <span class="badge bg-success">ตอบแล้ว</span>
                        @endif
                    </td>
                    <td class="text-center">{{ $issue->created_at->format('d/m/Y H:i') }}</td>
                    <td class="text-center">
                        <!-- เปลี่ยนสถานะ -->
                        <form method="POST" action="{{ route('admin.issues.toggleStatus', $issue->id) }}" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-outline-warning" title="เปลี่ยนสถานะ">
                                <i class="bi bi-arrow-repeat"></i>
                            </button>
                        </form>

                        <!-- ลบ -->
                        <form method="POST" action="{{ route('admin.issues.destroy', $issue->id) }}" class="d-inline" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าจะลบรายการนี้?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="ลบรายการ">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted py-4">
                        <i class="bi bi-inbox"></i> ไม่มีรายการแจ้งปัญหาในขณะนี้
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $issues->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
