@extends('layouts.mainLayout')

@section('content')

<div class="page-body p-4 text-dark">
    <div class="page-heading border-bottom d-flex flex-row">
        <h5 class="font-weight-normal">Create New User</h5>
    </div>
    <div class="small-cards mt-5 mb-4">

        <div class="container">
            <a href="{{ route('users.index') }}" class="btn btn-light mb-3">
                <i class="fa fa-arrow-left"></i> Go Back
            </a>
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <strong><i class="fa fa-user-plus"></i> Create New User</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="fa fa-user"></i> ชื่อ-นามสกุล</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fa fa-envelope"></i> อีเมล</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="username"><i class="fa fa-user-circle"></i> Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="phone"><i class="fa fa-phone"></i> Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="fa fa-lock"></i> รหัสผ่าน</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation"><i class="fa fa-lock"></i> ยืนยันรหัสผ่าน</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check-circle"></i> สร้างผู้ใช้
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
