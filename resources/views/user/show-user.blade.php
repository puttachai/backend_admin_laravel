@extends('layouts.mainLayout')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">รายละเอียดผู้ใช้: {{ $user->name }}</h2>
    <p><strong>ชื่อ:</strong> {{ $user->name }}</p>
    <p><strong>อีเมล:</strong> {{ $user->email }}</p>
    <p><strong>วันที่สมัคร:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">ย้อนกลับ</a>
</div>
@endsection
