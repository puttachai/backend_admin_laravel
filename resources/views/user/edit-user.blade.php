@extends('layouts.mainLayout')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">แก้ไขข้อมูลผู้ใช้: {{ $user->name }}</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">อีเมล</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">รหัสผ่าน (ไม่ต้องกรอกหากไม่ต้องการเปลี่ยน)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">ยืนยันรหัสผ่าน</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">อัพเดตข้อมูล</button>
    </form>
</div>
@endsection
