@extends('layouts.mainLayout')

@section('content')

<div class="page-body p-4 text-dark">
    <div class="page-heading border-bottom d-flex flex-row">
        <h5 class="font-weight-normal">Edit Seller</h5>
    </div>
    <div class="small-cards mt-5 mb-4">

        <div class="container">
            <a href="{{ route('sellers.index') }}" class="btn btn-light mb-3"><< Go Back</a>
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <strong><i class="fa fa-edit"></i> Edit Seller</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('sellers.update', $sellers->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">ชื่อ-นามสกุล</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $sellers->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $sellers->username }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phoneNumber">เบอร์โทรศัพย์</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ $sellers->phoneNumber }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">อีเมล</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $sellers->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="pickup_address">Pickup Address</label>
                            <input type="text" class="form-control" id="pickup_address" name="Pickup_address" value="{{ $sellers->Pickup_address }}" required>
                        </div>

                        <div class="form-group">
                            <label for="shop_name">Shop Name</label>
                            <input type="text" class="form-control" id="shop_name" name="shop_name" value="{{ $sellers->shop_name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="thai_national_id">Thai National ID</label>
                            <input type="text" class="form-control" id="thai_national_id" name="thai_national_id" value="{{ $sellers->thai_national_id }}" required>
                        </div>

                        <div class="form-group">
                            <label for="id_card_copy">ID Card Copy (If changing)</label>
                            <input type="file" class="form-control" id="id_card_copy" name="id_card_copy" accept="image/*">
                            {{-- @if ($sellers->id_card_copy)
                                <p>Current ID Card Copy: <a href="{{ asset('storage/' . $sellers->id_card_copy) }}" target="_blank">View File</a></p>
                            @endif --}}
                            @if ($sellers->id_card_copy)
                                <p>Current ID Card Copy: <a href="{{ asset('images/products/' . $sellers->id_card_copy) }}" target="_blank">View File</a></p>
                            @endif
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
