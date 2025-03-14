@extends('layouts.mainLayout')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">รายการสลิปการชำระเงิน</h2>

    <div class="table-responsive shadow-lg">
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>ผู้ใช้</th>
                    <th>หมายเลขออร์เดอร์</th>
                    <th>จำนวนเงิน</th>
                    <th>ส่วนลด</th>
                    <th>ภาษี</th>
                    <th>ยอดรวมสุทธิ</th>
                    <th>วันที่สร้าง</th>
                    <th>สลิป</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->referenceNumber }}</td>
                        <td>{{ number_format($order->TotalAmount, 2) }} บาท</td>
                        <td>{{ number_format($order->Discount, 2) }} บาท</td>
                        <td>{{ number_format($order->Tax, 2) }} บาท</td>
                        <td>{{ number_format($order->FinalAmount, 2) }} บาท</td>
                        <td>{{ \Carbon\Carbon::parse($order->CreatedAt)->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($order->slip_image)
                                <a href="{{ asset('images/product/' . $order->slip_image) }}" target="_blank">
                                    <img src="{{ asset('images/product/' . $order->slip_image) }}" width="100" class="img-thumbnail">
                                </a>
                            @else
                                <span class="text-muted">ไม่มีสลิป</span>
                            @endif
                        </td>
                        <td>
                            <select class="form-select status-dropdown" data-id="{{ $order->order_id }}">
                                @foreach(['Pending', 'Being Shipped', 'Shipped', 'Cancelled', 'Completed', 'Verified successfully'] as $status)
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

<!-- AJAX Script -->
<!-- แจ้งเตือนด้วย SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.status-dropdown').forEach(dropdown => {
        dropdown.addEventListener('change', function () {
            let orderId = this.dataset.id;
            let newStatus = this.value;

            fetch(`/update-order-status/${orderId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // alert('สถานะถูกอัปเดตเรียบร้อยแล้ว!');
                    Swal.fire("สำเร็จ!", "สถานะถูกอัปเดตเรียบร้อยแล้ว!", "success");
                } else {
                        Swal.fire("ผิดพลาด!", "เกิดข้อผิดพลาดในการเปลี่ยนสถานะ", "error");
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script>

@endsection
