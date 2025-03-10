@extends('layouts.mainLayout')

@section('content')

            <!--Page Body part -->
            <div class="page-body p-4 text-dark">
                <div class="page-heading border-bottom d-flex flex-row">
                    <h5 class="font-weight-normal">Create categories</h5>
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
                                <strong><i class="fa fa-plus"></i> Add New Categories Product</strong>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- ชื่อหมวดหมู่ -->
                                    <div class="form-group">
                                        <label for="name">id</label>
                                        <input type="text" class="form-control" id="name" name="id" placeholder="Enter you id" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Category Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name" required>
                                    </div>
                                
                                    <!-- คำอธิบายหมวดหมู่ -->
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" placeholder="Enter category description"></textarea>
                                    </div>
                                
                                    <!-- อัปโหลดภาพ -->
                                    <div class="form-group">
                                        <label for="image">Category Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                
                                    <button type="submit" class="btn btn-primary">Save Category</button>
                                </form>
                                
                            </div>
                        </div>
                        <!-- End create form -->
                        <br>
                    </div><!-- /.container -->
                    <script src="{{ asset('js/image_upload.js') }}"></script>

@endsection
