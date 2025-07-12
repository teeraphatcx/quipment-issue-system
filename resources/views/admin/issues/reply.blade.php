@extends('admin.layouts.app')

@section('title', 'ตอบกลับแจ้งปัญหา #' . $issue->id)

@section('content')
<h2>ตอบกลับแจ้งปัญหา #{{ $issue->id }}</h2>

<form method="POST" action="{{ route('admin.issues.submitReply', $issue->id) }}">
    @csrf

    <div class="mb-3">
        <label>รายละเอียดปัญหา:</label>
        <p>{{ $issue->description }}</p>
    </div>

    <div class="mb-3">
        <label for="admin_reply" class="form-label">ตอบกลับ</label>
        <textarea name="admin_reply" id="admin_reply" class="form-control" rows="5" required>{{ old('admin_reply', $issue->admin_reply) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">ส่งข้อความตอบกลับ</button>
</form>

@endsection
