

@extends('layouts.mainLayout')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">รายชื่อผู้ขาย</h2>

    <div class="mb-3"> {{--{{ route('users.create') }}--}}
        <a href="{{ route('sellers.create') }}" class="btn btn-success">สร้างผู้ขายใหม่</a>
    </div>

    <div class="table-responsive shadow-lg">
        <table class="table table-hover table-striped rounded-lg overflow-hidden">
            <thead class="table-dark">
                <tr>
                    <th>ชื่อ</th>
                    <th>อีเมล</th>
                    <th>ร้านค้า</th>
                    <th>วันที่สมัคร</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sellers as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->shop_name }}</td>
                        {{-- <td>{{ $user->created_at->format('d/m/Y H:i') }}</td> --}}
                        <td>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : '-' }}</td>
                        <td>
                            {{-- {{ route('sellers.show', $user->id) }} --}}
                            <a href="{{ route('sellers.show', $user->id) }}" class="btn btn-info btn-sm">ดูรายละเอียด</a>
                            {{-- {{ route('sellers.edit', $user->id) }} --}}
                            <a href="{{ route('sellers.edit', $user->id) }}" class="btn btn-warning btn-sm">แก้ไข</a>

                            <!-- Delete Form -->
                            {{-- {{ route('sellers.destroy', $user->id) }} --}}
                            {{-- <form action="" method="POST" style="display:inline;"> --}}
                            <form action="{{ route('sellers.destroy', $user->id) }}" method="POST" style="display:inline;">

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('คุณต้องการลบผู้ใช้หรือไม่?')">ลบ</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-container d-flex justify-content-center mt-4">
        {{ $sellers->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
