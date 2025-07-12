@component('mail::message')
# แจ้งเตือน: มีการแจ้งปัญหาใหม่

- อาคาร: {{ $issue->building }}
- ห้อง: {{ $issue->room }}
- ครุภัณฑ์: {{ $issue->equipment }}
- อีเมล: {{ $issue->email }}
- รายละเอียด: {{ $issue->description ?? '-' }}
- วันที่แจ้ง: {{ $issue->created_at->format('d/m/Y H:i') }}

@if ($issue->image_path)
รูปภาพประกอบ:  
![issue image]({{ asset('storage/' . $issue->image_path) }})
@endif

ขอบคุณ,<br>
{{ config('app.name') }}
@endcomponent
