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
                    <th>เปลี่ยนสถานะ</th> <!-- เพิ่มคอลัมน์เปลี่ยนสถานะ -->
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
                        <td>
                            <!-- Dropdown เลือกสถานะ -->
                            <select class="form-control status-select" data-order-id="{{ $order->order_id }}">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" {{ $order->Status == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
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

<!-- แจ้งเตือนด้วย SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".status-select").forEach(select => {
            select.addEventListener("change", function() {
                let orderId = this.getAttribute("data-order-id");
                let newStatus = this.value;

                fetch(`/orders/${orderId}/update-status`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire("สำเร็จ!", "เปลี่ยนสถานะเรียบร้อยแล้ว", "success");
                    } else {
                        Swal.fire("ผิดพลาด!", "เกิดข้อผิดพลาดในการเปลี่ยนสถานะ", "error");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    Swal.fire("ผิดพลาด!", "ไม่สามารถเปลี่ยนสถานะได้", "error");
                });
            });
        });
    });
</script>
@endsection
