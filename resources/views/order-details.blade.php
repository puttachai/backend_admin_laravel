@extends('layouts.mainLayout')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4 text-uppercase text-primary">รายละเอียดคำสั่งซื้อที่ #{{ $order->order_id }}</h2>

    <h4 class="mb-3">รายการสินค้า</h4>
    
    <!-- Table for order items -->
    <div class="table-responsive shadow-lg " style="border-radius: 8px">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr class="">
                    <th>รูปภาพ</th>
                    <th>สินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>
                    <th>รวม</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $detail)
                    <tr>
                        <td>
                            <img src="{{ asset('images/products/' . basename($detail->product->image)) }}" 
                                 alt="{{ $detail->product->name }}" 
                                 class="img-fluid img-thumbnail rounded" 
                                 style="height: 100px; width: 100px;">
                        </td>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->UnitPrice, 2) }} บาท</td>
                        <td>{{ number_format($detail->TotalPrice, 2) }} บาท</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Order Details Card -->
    <div class="mt-4 card shadow-lg mb-4">
        <div class="card-body">
            <p><strong>ลูกค้า:</strong> <span class="badge bg-info text-white">{{ $order->user->name }}</span></p>
            <p><strong>ยอดรวม:</strong> <span class="text-success">{{ number_format($order->FinalAmount, 2) }} บาท</span></p>
            <p><strong>สถานะ:</strong> 
                <span class="badge @if($order->Status == 'สำเร็จ') bg-success @elseif($order->Status == 'กำลังดำเนินการ') bg-warning @else bg-danger @endif">
                    {{ $order->Status }}
                </span>
            </p>
            <p><strong>วันที่สั่งซื้อ:</strong> <span class="text-muted">{{ $order->CreatedAt->format('d/m/Y H:i') }}</span></p>
        </div>
    </div>

    <!-- Back Button -->
    <div class="text-center mt-4">
        <a href="{{ route('orders.index') }}" class="btn btn-primary btn-lg">ย้อนกลับ</a>
    </div>
</div>
@endsection
