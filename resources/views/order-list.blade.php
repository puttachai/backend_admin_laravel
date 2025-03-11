

@extends('layouts.mainLayout')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">รายการสั่งซื้อ</h2>
    <div class="table-responsive shadow-lg">
        <table class="table table-hover table-striped rounded-lg overflow-hidden">
            <thead class="table-dark">
                <tr>
                    <th>userId</th>
                    <th>ลูกค้า</th>
                    <th>ยอดรวม</th>
                    <th>สถานะ</th>
                    <th>วันที่สั่งซื้อ</th>
                    <th>รายละเอียด</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->user_id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ number_format($order->FinalAmount, 2) }} บาท</td>
                        <td>
                            <span class="badge @if($order->Status == 'สำเร็จ') bg-success @elseif($order->Status == 'กำลังดำเนินการ') bg-warning @else bg-danger @endif">
                                {{ $order->Status }}
                            </span>
                        </td>
                        <td>{{ $order->CreatedAt->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->order_id) }}" class="btn btn-info btn-sm">ดูรายละเอียด</a>
                        </td>
                        {{-- {{ route('orders.show', $order->id) }} --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-container d-flex justify-content-center mt-4">
        {{ $orders->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
