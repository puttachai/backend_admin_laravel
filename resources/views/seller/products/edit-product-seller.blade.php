@extends('layouts.mainLayout')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">แก้ไขสินค้า</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-lg p-4">
        <form action="{{ route('sellers.products.update', [$product->seller_id, $product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Seller ID</label>
                <label type="text" class="form-control" id="seller_id" name="seller_id" required>{{ $product->seller->seller_id }}</label>
            </div>

            <div class="form-group">
                <label for="name">Name Seller</label>
                <label type="text" class="form-control" id="name" name="name" required>{{ $product->seller->name }}</label>
            </div>

            <div class="form-group">
                <label for="name">Shop Name</label>
                <label type="text" class="form-control" id="shop_name" name="shop_name" required>{{ $seller->shop_name }}</label>
            </div>
            
            <div class="form-group">
                <label for="name">ชื่อสินค้า</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>

            <div class="form-group">
                <label for="price">ราคา</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
            </div>

            <div class="form-group">
                <label for="qty">จำนวนสินค้า</label>
                <input type="number" class="form-control" id="qty" name="qty" value="{{ $product->qty }}" required>
            </div>

            <div class="form-group">
                <label for="description">รายละเอียดสินค้า</label>
                <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">อัปโหลดรูปภาพ</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @if($product->image)
                    <div class="mt-2">
                        <img src="{{ asset('images/products/' . $product->image) }}" width="150" class="img-thumbnail">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary mt-3">บันทึกการเปลี่ยนแปลง</button>
            <a href="{{ route('sellers.products', [$product->seller->seller_id, $product->id]) }}" class="btn btn-danger mt-3">ยกเลิก</a>
        </form>
    </div>
</div>
@endsection
