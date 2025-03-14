@extends('layouts.mainLayout')

@section('content')

<div class="page-body p-4 text-dark">
    <div class="page-heading border-bottom d-flex flex-row">
        <h5 class="font-weight-normal">Edit User</h5>
    </div>
    <div class="small-cards mt-5 mb-4">

        <div class="container">
            <a href="{{ route('users.index') }}" class="btn btn-light mb-3"><< Go Back</a>
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <strong><i class="fa fa-edit"></i> Edit User</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $users->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="name">ชื่อ</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $users->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $users->username }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">เบอร์โทรศัพย์</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ $users->phoneNumber }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">อีเมล</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $users->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="password">รหัสผ่าน (ไม่ต้องกรอกหากไม่ต้องการเปลี่ยน)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">ยืนยันรหัสผ่าน</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check-circle"></i> อัพเดตข้อมูล
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
