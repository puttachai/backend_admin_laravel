@extends('layouts.mainLayout')

@section('content')

<div class="page-body p-4 text-dark">
    <div class="page-heading border-bottom d-flex flex-row">
        <h5 class="font-weight-normal">User Details</h5>
    </div>
    <div class="small-cards mt-5 mb-4">

        <div class="container">
            <a href="{{ route('users.index') }}" class="btn btn-light mb-3">
                <i class="fa fa-arrow-left"></i> Go Back
            </a>
            <div class="card border-info">
                <div class="card-header bg-info text-white">
                    <strong><i class="fa fa-user"></i> User Details</strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="30%">ชื่อ</th>
                                <td>{{ $users->name }}</td>
                            </tr>
                            <tr>
                                <th>อีเมล</th>
                                <td>{{ $users->email }}</td>
                            </tr>
                            <tr>
                                <th>สถานะผู้ใช้</th>
                                <td>{{ $users->statususers == 1 ? 'Admin' : 'User' }}</td>
                            </tr>
                            <tr>
                                <th>สถานะการเป็นผู้ขาย</th>
                                <td>{{ $users->statusSellers }}</td>
                            </tr>
                            <tr>
                                <th>เบอร์โทร</th>
                                <td>{{ $users->phoneNumber ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>เพศ</th>
                                <td>{{ $users->Gender ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>วันเกิด</th>
                                <td>{{ $users->date_of_birth ? \Carbon\Carbon::parse($users->date_of_birth)->format('d/m/Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <th>วันที่สมัคร</th>
                                <td>{{ $users->created_at ? \Carbon\Carbon::parse($users->created_at)->format('d/m/Y H:i') : '-' }}</td>
                            </tr>
                            {{-- <tr>
                                <th>รูปโปรไฟล์</th>
                                <td>
                                    @if ($users->image_profile)
                                        <img src="{{ asset('storage/images/profile/'.$users->image_profile) }}" alt="Profile Image" width="100" />
                                    @else
                                        <p>No profile image</p>
                                    @endif
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> ย้อนกลับ
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
