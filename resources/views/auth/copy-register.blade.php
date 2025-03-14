@extends('layouts.app')

@section('content')
<div class="login-page d-flex flex-row justify-content-center align-items-center">
    <!-- Login card -->
    <div class="card mx-3 mx-md-0 border-0 rounded-lg w-75">
        <div class="card-body">
            <div class="row">
                <!-- Left side -->
                <div class="col-md-6 border-0 border-md-right">
                    <div class="login-brand d-flex justify-content-center align-items-center">
                        <img src="{{ asset('qbadminui/img/image.png') }}" alt="image" class="w-50 pt-4" style="width: 250px; height: 250px; object-fit: contain;">
                    </div>
                    <h5 class="text-dark my-3 mt-4 text-center">Sign Up</h5>
                    
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Column 1 -->
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="empname" class="text-muted">Full Name</label>
                                    <input id="empname" type="text" class="form-control bg-light" name="empname" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="email" class="text-muted">Email</label>
                                    <input id="email" type="email" class="form-control bg-light" name="email" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="password" class="text-muted">Password</label>
                                    <input id="password" type="password" class="form-control bg-light" name="password" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="password_confirmation" class="text-muted">Confirm Password</label>
                                    <input id="password_confirmation" type="password" class="form-control bg-light" name="password_confirmation" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="phone_number" class="text-muted">Phone</label>
                                    <input id="phone_number" type="text" class="form-control bg-light" name="phone_number" required>
                                </div>
                            </div>

                            <!-- Column 2 -->
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="first_name" class="text-muted">First Name</label>
                                    <input id="first_name" type="text" class="form-control bg-light" name="first_name" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="last_name" class="text-muted">Last Name</label>
                                    <input id="last_name" type="text" class="form-control bg-light" name="last_name" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="address" class="text-muted">Address</label>
                                    <input id="address" type="text" class="form-control bg-light" name="address" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="position" class="text-muted">Position</label>
                                    <input id="position" type="text" class="form-control bg-light" name="position" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="start_date" class="text-muted">Start Date</label>
                                    <input id="start_date" type="date" class="form-control bg-light" name="start_date" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="salary" class="text-muted">Salary</label>
                            <input id="salary" type="number" step="0.01" class="form-control bg-light" name="salary" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block w-100">Sign Up</button>
                    </form>
                </div>

                <!-- Right side -->
                <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                    <button class="btn btn-danger btn-block w-75 mb-2"><i class="fab fa-google"></i> Sign in with Google</button>
                    <button class="btn btn-primary btn-block w-75 mb-2"><i class="fab fa-facebook-f"></i> Sign in with Facebook</button>
                    <a href="{{ route('login') }}" class="w-75">
                        <button class="btn btn-outline-primary btn-block">Sign In</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



{{-- @extends('layouts.app')

@section('content')
    <div class="login-page d-flex flex-row justify-content-center align-items-center">
        <!-- Login card -->
        <div class="card mx-3 mx-md-0 border-0 rounded-lg">
            <div class="card-body">
                <!-- Row -->
                <div class="row">
                    <!-- Left side -->
                    <div class="col-md-6 border-0 border-md-right">
                        <!-- Brand -->
                        <div class="login-brand m-3 m-md-0 d-flex justify-content-center align-items-center">
                            <img src="{{ asset('qbadminui/img/image.png') }}" alt="image" class="w-50 pt-4" alt="image" style="width: 350px; height: 350px; object-fit: cover;">
                        </div>
                        <form action="{{ route('register') }}" method="POST" >  <!--{{ url('/employees/store') }}-->
                            @csrf
                            <h5 class="text-dark my-3">Sign Up</h5>
                            <!-- Name -->
                            <div class="form-group mb-2">
                                <label for="name" class="text-muted">Your name</label>
                                <input id="name" type="text" class="form-control badge-pill bg-light @error('empname') is-invalid @enderror" name="empname" value="{{ old('empname') }}" required autocomplete="empname" autofocus>
                                @error('empname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Email -->
                            <div class="form-group mb-2">
                                <label for="email" class="text-muted">Email Address</label>
                                <input id="email" type="email" class="form-control badge-pill bg-light @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- password -->
                            <div class="form-group mb-2">
                                <label for="password" class="text-muted">Password</label>
                                <input id="password" type="password" class="form-control badge-pill bg-light @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Password -->
                            <div class="form-group mb-4">
                                <label for="c-pass" class="text-muted">Confirm Password</label>
                                <input id="c-pass" class="form-control badge-pill bg-light" type="password" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-primary btn-outline-primary badge-pill btn-block w-75 m-auto">Sign Up</button>
                        </form>
                    </div>
                    <!-- Right side -->
                    <div class="col-md-6 d-flex flex-column justify-content-center align-items-center pt-3 pt-md-0">
                        <button class="btn btn-raised btn-google btn-icon m-2 badge-pill btn-block w-75"><i class="fab fa-google"></i> <p class="d-inline">Sign in with Google</p></button>
                        <button class="btn btn-raised btn-facebook btn-icon m-2 badge-pill btn-block w-75"><i class="fab fa-facebook-f"></i> <p class="d-inline">Sign in with Facebook</p></button>
                        <a href="{{ route('login') }}" class="w-75"><button class="btn btn-primary btn-outline-primary badge-pill btn-block"><p class="d-inline">Sign In</p></button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


@error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

@error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

@error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror


@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 --}}
