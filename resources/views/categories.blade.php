@extends('layouts.mainLayout')

@section('content')

                <!--Page Body part -->
            <div class="page-body p-4 text-dark">
                <div class="page-heading border-bottom d-flex flex-row">
                    <h5 class="font-weight-normal">Categories</h5>
                    <small class="mt-2 ml-2">Product</small>
                </div>
                <div class="small-cards mt-5 mb-4">
                    
                    <div class="container">
                        @if (request()->query('status') === 'deleted')
                            <div class="alert alert-success" role="alert">
                                <strong>Deleted</strong>
                            </div>
                        @endif
                        @if (request()->query('status') === 'fail_delete')
                            <div class="alert alert-danger" role="alert">
                                <strong>Fail Delete</strong>
                            </div>
                        @endif
                        <!-- Table Product -->
                        <div class="card border-danger">
                            <div class="card-header bg-danger text-white">
                                <strong><i class="fa fa-database"></i> Products Categories</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="card-title float-left">Table Products Categories</h5>
                                        {{-- <a href="{{ url('add') }}" class="btn btn-success float-right mb-3"><i class="fa fa-plus"></i> Add New</a> --}}
                                        <a href="{{ route('categories.create') }}" class="btn btn-success float-right mb-3"><i class="fa fa-plus"></i> Add New</a>
                                    </div>
                                </div>
                                <table class="table table-bordered table-striped">
                                    <thead> 
                                        <tr>
                                            <th>ID</th>
                                            <th>image</th>
                                            <th>categories Name</th>
                                            <th>description</th>
                                            <th style="width: 20%;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($category as $categories)
                                            <tr>
                                                <td>{{ $categories->id }}</td>
                                                <td>
                                                    @if($categories->image)
                                                        <img src="{{ asset('images/categories/' . $categories->image) }}" style="width: 100px; height: 100px;">
                                                    @else
                                                        <span>No Image</span>
                                                    @endif
                                                </td>
                                                <td>{{ $categories->name }}</td>
                                                {{-- <td>${{ number_format($categories->price, 2) }}</td> --}}
                                                <td>{{ $categories->description }}</td>
                                                <td>

                                                    <a href="{{ route('categories.show', ['id' => $categories->categories_id]) }}" class="btn btn-sm btn-light">
                                                        <i class="fa fa-th-list"></i>
                                                    </a>    
                                                    <a href="{{ route('categories.edit', ['id' => $categories->categories_id]) }}" class="btn btn-sm btn-info">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-{{ $categories->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    
                           
                                                </td>
                                                
                                                {{-- <td>
                                                    <a href="{{ route('dashboard', ['id' => $product->id, 'name' => $product->name]) }}" class="btn btn-sm btn-light">
                                                        <i class="fa fa-th-list"></i>
                                                    </a>
                                                </td> --}}
                                                
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No products found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Table Product -->
                        <br>
                    </div><!-- /.container -->
                    <script src="{{ asset('js/image_upload.js') }}"></script>
            
@endsection

<!-- Modal markup -->
@foreach($category as $categories)
<div class="modal fade" id="modal-delete-{{ $categories->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">ยืนยันการลบสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                คุณแน่ใจหรือว่าต้องการลบสินค้านี้?
            </div>
            <div class="modal-footer">
                <form action="{{ route('categories.destroy', ['id' => $categories->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-danger">ลบ</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach



{{-- 
<!-- Modal markup -->
@foreach($products as $product)
<div class="modal fade" id="modal-delete-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">ยืนยันการลบสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                คุณแน่ใจหรือว่าต้องการลบสินค้านี้?
            </div>
            <div class="modal-footer">
                <form action="{{ route('product.destroy', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-danger">ลบ</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach --}}
