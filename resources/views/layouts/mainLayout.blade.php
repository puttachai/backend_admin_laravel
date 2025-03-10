<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'QBAdminUI') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('qbadminui/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('qbadminui/css/vendor/bootstrap-4.3.1/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ mix('qbadminui/css/main.css') }}">
    
    <style>
    </style>
    <meta name="theme-color" content="#fafafa">
</head>
<body class="position-relative">
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
        
    <div class="container-fluid px-0">
        <!-- The side bar -->
        <div class="side-bar side-bar-lg-active" data-theme="purple">
            <!-- Brand details -->
            <div class="side-menu-brand d-flex flex-column justify-content-center align-items-center clear mt-3">
                <img src="{{ asset('qbadminui/img/BrandGekkoShop.png') }}" alt="bran_name" class="brand-img">
                <a href="{{ route('employee.home') }}" class="brand-name mt-2 ml-2 font-weight-bold">GekkoAdminUI</a>
            </div>
            <!-- Side bar menu -->
            <div class="the_menu mt-5">
                <!-- Heading -->
                <div class="side-menu-heading d-flex">
                    <h6 class=" font-weight-bold pb-2 mx-3"> Mr Admin </h6>
                    <a class="font-weight-bold ml-auto px-3" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>

                <!-- Menu item -->
                <div id="accordion">
                    <ul class="side-menu p-0 m-0 mt-3">
                        <li class="side-menu-item px-3"><a href="{{ route('employee.home') }}" class="w-100 py-3 pl-4">Dashboard</a>
                        {{-- <li class="side-menu-item px-3"><a href="{{ route('home') }}" class="w-100 py-3 pl-4">Dashboard</a> --}}
                        </li>
                        <li class="side-menu-item px-3"><a href="{{ route('indextest') }}" class="w-100 py-3 pl-4">seller</a></li>

                        <li class="side-menu-item px-3"><a href="#" class="w-100 py-3 pl-4 sub-menu-parent"
                                data-toggle="collapse" data-target="#sub_menu_12" aria-expanded="false"
                                aria-controls="sub_menu_12">Product</a></li>
                        <!-- Sub menu -->
                        <div id="sub_menu_12" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <ul class="side-sub-menu p-0">
                                <li class="side-sub-menu-item px-3"><a href="{{ url('/product') }}"
                                        class="w-100 pl-4">Products</a></li>
                                <li class="side-sub-menu-item px-3"><a href="{{ url('/categories') }}"
                                        class="w-100 pl-4">Categories</a></li>
                                <li class="side-sub-menu-item px-3"><a href="{{ url('/create-product') }}"
                                        class="w-100 pl-4">Create product</a></li>
                                <li class="side-sub-menu-item px-3"><a href="{{ route('categories.create') }}"
                                        class="w-100 pl-4">Create categories</a></li>
                                {{-- <li class="side-sub-menu-item px-3"><a href="{{ route('create-categoriestest') }}"
                                        class="w-100 pl-4">Create categories</a></li> --}}
                                {{-- <li class="side-sub-menu-item px-3"><a href="accordion.html" class="w-100 pl-4">Update
                                        product</a></li>
                                <li class="side-sub-menu-item px-3"><a href="badge.html" class="w-100 pl-4">Delete
                                        product</a></li>
                                <li class="side-sub-menu-item px-3"><a href="button.html" class="w-100 pl-4">Status
                                        product</a></li> --}}
                            </ul>
                        </div>


                        <!-- Sub menu parent -->
                        <li class="side-menu-item px-3"><a href="#" class="w-100 py-3 pl-4 sub-menu-parent"
                                data-toggle="collapse" data-target="#form-sub-menu" aria-expanded="false"
                                aria-controls="form-sub-menu">Form Elements</a></li>
                        <!-- Sub menu -->
                        <div id="form-sub-menu" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <ul class="side-sub-menu p-0">
                                <li class="side-sub-menu-item px-3"><a href="form_basic.html" class="w-100 pl-4">Basic
                                        Elements</a></li>
                                <li class="side-sub-menu-item px-3"><a href="form_basic_action.html"
                                        class="w-100 pl-4">Basic Action Bar</a></li>
                                <li class="side-sub-menu-item px-3"><a href="form_layout.html" class="w-100 pl-4">Form
                                        layouts</a></li>
                                <li class="side-sub-menu-item px-3"><a href="multi_column_forms.html"
                                        class="w-100 pl-4">Multi Column Forms</a></li>
                                <li class="side-sub-menu-item px-3"><a href="input_group.html" class="w-100 pl-4">Input
                                        Group</a></li>
                                <li class="side-sub-menu-item px-3"><a href="form_validation.html"
                                        class="w-100 pl-4">Form Validation</a></li>
                            </ul>
                        </div>

                        <!-- Sub menu parent -->
                        <li class="side-menu-item px-3"><a href="#" class="w-100 py-3 pl-4 sub-menu-parent"
                                data-toggle="collapse" data-target="#chart-sub-menu" aria-expanded="false"
                                aria-controls="chart-sub-menu">Charts</a></li>
                        <!-- Sub menu -->
                        <div id="chart-sub-menu" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <ul class="side-sub-menu p-0">
                                <li class="side-sub-menu-item px-3"><a href="chart_js.html" class="w-100 pl-4">Chart
                                        Js</a></li>
                            </ul>
                        </div>

                        <!-- Sub menu parent -->
                        <li class="side-menu-item px-3"><a href="#" class="w-100 py-3 pl-4 sub-menu-parent"
                                data-toggle="collapse" data-target="#table-sub-menu" aria-expanded="false"
                                aria-controls="table-sub-menu">Tables</a></li>
                        <!-- Sub menu -->
                        <div id="table-sub-menu" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <ul class="side-sub-menu p-0">
                                <li class="side-sub-menu-item px-3"><a href="basic_table.html" class="w-100 pl-4">Basic
                                        Table</a></li>
                                <li class="side-sub-menu-item px-3"><a href="datatables.html"
                                        class="w-100 pl-4">DataTables</a></li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main section -->
        <main class="bg-light main-full-body">

            <!-- Theme changer -->
            <div class="theme-option p-4">
                <div class="theme-pck">
                    <i class="fas fa-cog fa-lg"></i>
                </div>
                <p>Navbar:</p>
                <div class="side-nav-themes d-flex flex-row">
                    <p class="p-3 rounded side-nav-theme-primary side-nav-theme" theme-color="purple"></p>
                    <p class="p-3 rounded ml-2 side-nav-theme-light side-nav-theme" theme-color="light"></p>
                </div>
            </div>

            <!-- The navbar -->
            <nav class="navbar navbar-expand navbar-light bg-light py-3">
                <p class="navbar-brand mb-0 pb-0">
                    <span></span>
                    <span></span>
                    <span></span>
                </p>
                <!-- Navbar search section -->
                <div class="navb-search ml-5 d-none d-md-block">
                    <form action="#" method="POST" style="margin-bottom: 0%">
                        <div class="input-group search-round">
                            <input type="text" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <button class="btn border" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Navbar right menu section -->
                <div class="navb-menu ml-auto d-flex flex-row">
                    <!-- Message dropdown -->
                    <div class="dropdown dropdown-arow-none d-contents text-center mx-2 pt-1">

                       <!-- Notification dropdown -->
                    <div class="dropdown dropdown-arow-none d-contents text-center mx-2 pt-1">
                        <!-- icon -->
                        <a href="#" class="w-100 dropdown-toggle text-muted position-relative"
                            data-toggle="dropdown">
                            <!-- Notification -->
                            <i class="far fa-bell fa-2x"></i>
                            <span class="badge badge-primary  position-absolute notification-badge">2</span>
                        </a>
                        <!-- Dropdown menu -->
                        <div class="dropdown-menu dropdown-menu-right p-0 dropdown-menu-max-height">
                            <!-- Menu item -->
                            <a href="#" class="dropdown-item text-secondary-light p-0">
                                <div class="d-flex flex-row border-bottom">
                                    <div class="notification-icon bg-secondary-c pt-3 px-3"><i
                                            class="far fa-envelope text-primary fa-lg"></i></div>
                                    <div class="flex-grow-1 px-3 py-3">
                                        <p class="mb-0">New message <span
                                                class="badge badge-pill badge-primary">New</span></p>
                                        <small>James : Hey! Are you busy?</small>
                                    </div>
                                </div>
                            </a>

                            <!-- Menu item -->
                            <a href="#" class="dropdown-item text-secondary-light p-0">
                                <div class="d-flex flex-row border-bottom">
                                    <div class="notification-icon bg-secondary-c pt-3 px-3"><i
                                            class="fas fa-clipboard-list text-success fa-lg"></i></div>
                                    <div class="flex-grow-1 px-3 py-3">
                                        <p class="m-0">New order received <span
                                                class="badge badge-pill badge-success">New</span></p>
                                        <small>3 iPhone x</small>
                                    </div>
                                </div>
                            </a>
                            <!-- Menu item -->
                            <a href="#" class="dropdown-item text-secondary-light p-0 pr-2">
                                <div class="d-flex flex-row border-bottom">
                                    <div class="notification-icon bg-secondary-c pt-3 px-3"><i
                                            class="fas fa-box-open text-warning fa-lg"></i></div>
                                    <div class="flex-grow-1 px-3 py-3">
                                        <p class="m-0">Product out of stock <span
                                                class="badge badge-pill badge-warning small">1</span></p>
                                        <small>Headphone E63</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>



                    <!-- Profile action dropdown -->
                    <div class="dropdown dropdown-arow-none d-contents text-center mx-2">
                      
                        {{-- <a href="#" class="w-25 dropdown-toggle text-muted" data-toggle="dropdown"><img
                                src="{{ asset($employee->image_profile ? 'qbadminui/img/' . $employee->image_profile : 'qbadminui/img/1741026435210.jpg') }}" alt="profile"
                                class="profile-avatar"
                                ></a> --}}
                                <a href="#" class="w-25 dropdown-toggle text-muted" data-toggle="dropdown">
                                    @if ($employee && $employee->image_profile) <!-- ตรวจสอบว่า $employee และ image_profile มีค่า -->
                                        <img src="{{ asset('qbadminui/img/' . $employee->image_profile) }}" alt="profile" class="profile-avatar">
                                    @else
                                        <img src="{{ asset('qbadminui/img/1741026435210.jpg') }}" alt="profile" class="profile-avatar">
                                    @endif
                                </a>
                        <!-- Dropdown Menu -->
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-max-height">
                            <!-- Menu items Md.Maruf Ahmed-->
                            {{-- <a href="#" class="dropdown-item disabled small"><i class="far fa-user mr-1"></i>
                                {{$employee->empname}}</a> --}}
                            @if ($employee) <!-- ตรวจสอบว่า $employee มีค่า -->
                                <a href="#" class="dropdown-item disabled small"><i class="far fa-user mr-1"></i>
                                    {{ $employee->empname }}</a>
                            @else
                                <a href="#" class="dropdown-item disabled small"><i class="far fa-user mr-1"></i>
                                    Unknown User</a>
                            @endif
                            <a href="#" class="dropdown-item text-secondary-light">Account setting</a>
                            <a href="#" class="dropdown-item text-secondary-light">Billing history</a>
                            <a class="dropdown-item text-secondary-light" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Sign out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            @yield('content')

            {{-- </div> --}}
        {{-- </div> --}}
    </main>
    <!-- Footer section -->
    <footer class="footer-full-body p-4 d-flex flex-row justify-content-between text-secondary">
        <p>&copy; Copyright. <a href="https://qbytesoft.com" target="_Blank">Qbytesoft</a></p>
        <p>Version 1.0.0</p>
    </footer>

</div>


    <script src="{{ asset('qbadminui/js/vendor/bootstrap-4.3.1/modernizr-3.7.1.min.js') }}"></script>
    <script src="{{ asset('qbadminui/js/vendor/jquery-3.3.1/jquery-3.3.1.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('qbadminui/js/vendor/popper-js/popper1.14.7.js') }}"></script>
    <script src="{{ asset('qbadminui/js/vendor/bootstrap-4.3.1/bootstrap.min.js') }}"></script>
    <!-- eChart -->
    <script src="{{ asset('qbadminui/js/vendor/eChart/echarts.min.js') }}"></script>
    <script src="{{ asset('qbadminui/js/vendor/eChart/echarts.option.min.js') }}"></script>
    <!-- eChart script -->
    <script src="{{ asset('qbadminui/js/plugins/echart_drw.js') }}"></script>
    <script src="{{ asset('qbadminui/js/plugins.js') }}"></script>
    <script src="{{ asset('qbadminui/js/main.js') }}"></script>
    <!-- Add your scripts here, before the closing </body> tag -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/echarts@5.3.1/dist/echarts.min.js"></script>

</body>
</html>


{{-- @extends('layouts.app')

@section('content')
@yield('content')
     --}}
{{-- @endsection --}}


                     <!-- Icon -->
                        {{-- <a href="#" class="w-100 dropdown-toggle text-muted position-relative"
                            data-toggle="dropdown">
                            <!-- Message -->
                            <i class="far fa-envelope fa-2x"></i>
                            <span class="badge badge-danger position-absolute notification-badge">3</span>
                        </a> --}}

                        {{-- <!-- Dropdown menu -->
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-max-height p-0">
                            <!-- Dropdown item -->
                            <a href="#" class="dropdown-item text-secondary-light p-0">
                                <div class="d-flex flex-row border-bottom">
                                    <!-- Profile image -->
                                    <div class="notification-icon bg-secondary-c pt-3"><img
                                            src="{{ asset('qbadminui/img/profile.jpg') }}" alt="img"
                                            class="w-75 img-round"></div>
                                    <!-- Message notification -->
                                    <div class="flex-grow-1 px-3 py-3">
                                        <p class="mb-0">James <span class="badge badge-pill badge-primary">1</span></p>
                                        <small>James : Hey! Are you busy?</small>
                                    </div>
                                </div>
                            </a>

                            <!-- Dropdown item -->
                            <a href="#" class="dropdown-item text-secondary-light p-0">
                                <div class="d-flex flex-row border-bottom">
                                    <!-- Profile image -->
                                    <div class="notification-icon bg-secondary-c pt-3"><img
                                            src="{{ asset('qbadminui/img/profile.jpg') }}" alt="img"
                                            class="w-75 img-round"></div>
                                    <!-- Message notification -->
                                    <div class="flex-grow-1 px-3 py-3">
                                        <p class="mb-0">Jhone <span class="badge badge-pill badge-primary">1</span></p>
                                        <small>Jhone : Hey! I need help.</small>
                                    </div>
                                </div>
                            </a>
                            <!-- Dropdown item -->
                            <a href="#" class="dropdown-item text-secondary-light p-0">
                                <div class="d-flex flex-row border-bottom">
                                    <!-- Profile image -->
                                    <div class="notification-icon bg-secondary-c pt-3"><img
                                            src="{{ asset('qbadminui/img/profile.jpg') }}" alt="img"
                                            class="w-75 img-round"></div>
                                    <!-- Message notification -->
                                    <div class="flex-grow-1 px-3 py-3">
                                        <p class="mb-0">Mariam <span class="badge badge-pill badge-primary">1</span></p>
                                        <small>Mariam : information</small>
                                    </div>
                                </div>
                            </a>
                        </div>
</div> --}}