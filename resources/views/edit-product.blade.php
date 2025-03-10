@extends('layouts.mainLayout')

@section('content')

            <!--Page Body part -->
            <div class="page-body p-4 text-dark">
                <div class="page-heading border-bottom d-flex flex-row">
                    <h5 class="font-weight-normal">Edit Product</h5>
                    <small class="mt-2 ml-2">Dashboard</small>
                </div>
                <div class="small-cards mt-5 mb-4">

                    <div class="container">
                        <a href="{{ route('product.index') }}" class="btn btn-light mb-3">
                            << Go Back</a>
                                <div class="card border-danger">
                                    <div class="card-header bg-danger text-white">
                                        <strong><i class="fa fa-edit"></i> Edit Product</strong>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('product.update', $product->id) }}" method="POST">
                                            @csrf
                                            @method('PUT') {{-- ใช้ @method แทน input hidden --}}
                                            <input type="hidden" > {{-- name="_method" value="PUT" --}}
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="barcode">Barcode</label>
                                                    <input type="text" class="form-control" name="barcode"
                                                        value="{{ $product->barcode }}" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ $product->name }}" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="price">Price</label>
                                                    <input type="number" class="form-control" name="price"
                                                        value="{{ $product->price }}" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="qty">Qty</label>
                                                    <input type="number" class="form-control" name="qty"
                                                        value="{{ $product->qty }}" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="categories_id">Category</label>
                                                    <select class="form-control" name="categories_id" required>
                                                        <option value="">-- Select Category --</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->categories_id }}" 
                                                                {{ $product->categories_id == $category->categories_id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-success"><i
                                                    class="fa fa-check-circle"></i>
                                                Update</button>
                                        </form>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>

@endsection
