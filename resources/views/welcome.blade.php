<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>QBAdminUI Laravel Broilerplate</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                align-content: center;
                width: 100%;
                height: 100%;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
    background-color: #f8f9fa; /* พื้นหลังของ Navbar */
    border-bottom: 1px solid #ddd;
}

.logo img {
    height: 50px; /* ปรับขนาดโลโก้ */
    width: auto;
}

.top-right.links {
    display: flex;
    gap: 15px;
}

.top-right.links a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    padding: 8px 12px;
    border-radius: 5px;
}

.top-right.links a:hover {
    background-color: #ddd;
}

        </style>
    </head>
    <body>
        <div class="navbar">
            <!-- โลโก้ที่มุมซ้าย -->
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('qbadminui/img/image.png') }}" alt="Logo">
                </a>
            </div>
        
            <!-- Navbar ด้านขวา -->
            <div class="top-right links">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
        
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
        
        <!-- เนื้อหาหลักของหน้าเว็บ -->
        <div class="content">
            <div class="title m-b-md">
                Welcome to Administrator
            </div>
        
            <div class="links">
                <a href="">GekkoShop.co.th</a> 
                <a href="https://github.com/puttachai/backup-project-E-Commerce-React.git">GitHub</a>
            </div>
        </div>
        
    </body>
</html>

{{-- 
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- โลโก้ -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('qbadminui/img/logo.png') }}" alt="Logo" width="100" height="50">
        </a>

        <!-- ปุ่มสำหรับเปิด/ปิด Navbar บนมือถือ -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- รายการลิงก์ -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">Home</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- ส่วนเนื้อหาหลัก -->
<div class="container text-center mt-5">
    <h1 class="mb-4">Welcome to Administrator</h1>
    <div class="d-flex justify-content-center">
        <a href="#" class="btn btn-primary me-2">GekkoShop.co.th</a>
        <a href="https://github.com/puttachai/backup-project-E-Commerce-React.git" class="btn btn-dark">GitHub</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
