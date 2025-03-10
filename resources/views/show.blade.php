@extends('layouts.mainLayout')

@section('content')

            <!--Page Body part -->
            <div class="page-body p-4 text-dark">
                <div class="page-heading border-bottom d-flex flex-row">
                    <h5 class="font-weight-normal">Product</h5>
                    {{-- <small class="mt-2 ml-2">Dashboard</small> --}}
                    <small class="mt-2 ml-2"> ID: {{ $product->id }}, {{ $product->name }}</small>
                </div>
                <div class="small-cards mt-5 mb-4">

                    <div class="container">
                        <a href="{{ route('product.index') }}" class="btn btn-light mb-3"><< Go Back</a>
                        <!-- Show a Product -->
                        <div class="card border-danger">
                            <div class="card-header bg-danger text-white">
                                <strong><i class="fa fa-database"></i> Show Product</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>Barcode</th>
                                                <td>{{ $product->barcode }}</td>
                                                <th>Name</th>
                                                <td>{{ $product->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Price</th>
                                                <td>${{ number_format($product->price, 2) }}</td>
                                                <th>Qty</th>
                                                <td>{{ $product->qty }}</td>
                                            </tr>
                                            <tr>
                                                <th>Description</th>
                                                <td colspan="3">{{ $product->description }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-3">
                                        {{-- <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid img-thumbnail"> --}}
                                        <img src="{{ asset('images/products/' . basename($product->image)) }}" alt="{{ $product->name }}" class="img-fluid img-thumbnail">
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
