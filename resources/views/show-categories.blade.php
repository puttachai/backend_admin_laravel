@extends('layouts.mainLayout')

@section('content')

            <!--Page Body part -->
            <div class="page-body p-4 text-dark">
                <div class="page-heading border-bottom d-flex flex-row">
                    <h5 class="font-weight-normal">Show Categories</h5>
                    {{-- <small class="mt-2 ml-2">Dashboard</small> --}}
                    <small class="mt-2 ml-2"> ID: {{ $categories->id }}, {{ $categories->name }}</small>
                </div>
                <div class="small-cards mt-5 mb-4">

                    <div class="container">
                        <a href="{{ route('categories.index') }}" class="btn btn-light mb-3"><< Go Back</a>
                        <!-- Show a Product -->
                        <div class="card border-danger">
                            <div class="card-header bg-danger text-white">
                                <strong><i class="fa fa-database"></i> Show Categories</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- รูปภาพด้านซ้าย -->
                                    <div class="col-md-4 text-center">
                                        <img src="{{ asset('images/categories/' . basename($categories->image)) }}" 
                                             alt="{{ $categories->name }}" 
                                             class="img-fluid img-thumbnail" 
                                             id="preview-image">
                                        
                                        <!-- อัปโหลดรูปภาพ -->
                                        {{-- <div class="mt-3">
                                            <input type="file" name="image" class="form-control-file" id="image-input">
                                        </div> --}}
                                    </div>

                                    <!-- ฟอร์มด้านขวา -->
                                    <div class="col-md-8">
                                        <div class="justify-item-center">

                                            <div class="form-group">
                                                <label for="name">ID</label>
                                                <input type="text" class="form-control" name="id" value="{{ $categories->id }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ $categories->name }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" class="form-control">{{ $categories->description }}</textarea>
                                            </div>

                                            {{-- <button type="submit" class="btn btn-success">
                                                <i class="fa fa-check-circle"></i> Update
                                            </button> --}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Show a product -->
                        <br>
                    </div><!-- /.container -->

                </div>
            </div>
       
@endsection
