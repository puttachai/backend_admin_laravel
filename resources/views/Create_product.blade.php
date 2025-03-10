@extends('layouts.mainLayout')

@section('content')


            <!--Page Body part -->
            <div class="page-body p-4 text-dark">
                <div class="page-heading border-bottom d-flex flex-row">
                    <h5 class="font-weight-normal">Create Product</h5>
                    <small class="mt-2 ml-2">Dashboard</small>
                </div>
                <div class="small-cards mt-5 mb-4">

                    <div class="container">
                        <a href="{{ route('product.index') }}" class="btn btn-light mb-3"><< Go Back</a>
                        <?php if (isset($_GET['status']) && $_GET['status'] == "created") : ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Created</strong>
                        </div>
                        <?php endif ?>
                        <?php if (isset($_GET['status']) && $_GET['status'] == "fail_create") : ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Fail Create</strong>
                        </div>
                        <?php endif ?>
                        <!-- Create Form -->
                        <div class="card border-danger">
                            <div class="card-header bg-danger text-white">
                                <strong><i class="fa fa-plus"></i> Add New Product</strong>
                            </div>
                            <div class="card-body">
                                {{-- product.store --}}
                                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="barcode" class="col-form-label">Barcode</label>
                                            <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name" class="col-form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="price" class="col-form-label">Price</label>
                                            <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="qty" class="col-form-label">Qty</label>
                                            <input type="number" class="form-control" name="qty" id="qty" placeholder="Qty" required>
                                        </div>
                                        {{-- <div class="form-group col-md-4">
                                            <label for="image" class="col-form-label">Image</label>
                                            <input type="text" class="form-control" name="image" id="image" placeholder="Image URL">
                                        </div> --}}
                                        <div class="form-group col-md-4 marginT">
                                            <label for="image-upload" class="col-form-label">Upload Image</label>
                                            <input type="file" class="form-control " name="image-upload" id="image-upload">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12" style="padding-right: 0;padding-left: 0;">
                                        <label for="categories_id">Category</label>
                                        <select class="form-control" name="categories_id" required>
                                            <option value="">-- Select Category --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" 
                                                    {{ old('categories_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="note" class="col-form-label">Description</label>
                                        <textarea name="description" id="" rows="5" class="form-control" placeholder="Description"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Save</button>
                                </form>
                            </div>
                        </div>
                        <!-- End create form -->
                        <br>
                    </div><!-- /.container -->

@endsection


@if(session('logData'))
    <script>
        console.log('Product Log:', {!! session('logData') !!});
    </script>
@endif
