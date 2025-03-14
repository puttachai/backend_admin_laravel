@extends('layouts.mainLayout')

@section('content')
<div class="container">

    <div class="my-4" class="page-heading border-bottom d-flex flex-row">
        <h3 class="font-weight-normal">รายการสินค้าทั้งหมดของแต่ละ user</h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>รูป</th>
                <th>ชื่อสินค้า</th>
                <th>ราคา</th>
                <th>จำนวน</th>
                <th>คำอธิบาย</th>
                <th>Seller ID</th>
                <th>ชื่อผู้ขาย</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>
                    @if($product->image)
                        <img src="{{ asset('images/products/' . $product->image) }}" width="50">
                    @else
                        ไม่มีรูป
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->qty }}</td>
                {{-- <td>{{ $product->description }}</td> --}}
                <td>
                    @if(strlen($product->description) > 50)
                        {{ Str::limit($product->description, 50) }} 
                        <a href="#" data-toggle="modal" data-target="#descModal{{ $product->id }}">อ่านเพิ่มเติม</a>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="descModal{{ $product->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">รายละเอียดสินค้า</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        {{ $product->description }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{ $product->description }}
                    @endif
                </td>
                <td>{{ $product->seller->seller_id ?? '-' }}</td>
                <td>{{ $product->seller->name ?? 'ไม่มีข้อมูล' }}</td>
                <td>
                    <div class="d-flex justify-content-start">
                        <!-- ปุ่มแก้ไข -->
                        <a href="{{ route('sellers.products.edit', [$product->seller_id, $product->id]) }}" class="btn btn-warning btn-sm mr-2">แก้ไข</a>
                        
                        <!-- ปุ่มลบ -->
                        <form action="{{ route('sellers.products.destroy', [$product->seller->seller_id, $product->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                        </form>
                    </div>
                </td>
            </tr>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="pagination-container d-flex justify-content-center mt-4">
    {{ $products->links('pagination::bootstrap-4') }}
</div>

@endsection
