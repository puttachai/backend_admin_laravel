@extends('layouts.mainLayout')

@section('content')
    <!--Page Body part -->
    <div class="page-body p-4 text-dark">
        <div class="page-heading border-bottom d-flex flex-row">
            <h5 class="font-weight-normal">Version 1</h5>
            <small class="mt-2 ml-2">Dashboard</small>
        </div>
        <!-- Small card component -->
        <div class="small-cards mt-5 mb-4">
            <div class="row">
                <!-- Col sm 6, col md 6, col lg 3 -->
                <div class="col-sm-6 col-md-6 col-lg-3 mt-3 mt-lg-0">
                    <!-- Card -->
                    <div class="card border-0 rounded-lg">
                        <!-- Card body -->
                        <div class="card-body">

                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <!-- Icon -->
                                <div class="small-card-icon">
                                    <i class="far fa-user-circle card-icon-bg-primary fa-4x"></i>
                                </div>
                                <!-- Text -->
                                <div class="small-card-text w-100 text-center">
                                    <p class="font-weight-normal m-0 text-muted">New Leads</p>
                                    <h4 class="font-weight-normal m-0 text-primary">{{ $totalUsers }}</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Col sm 6, col md 6, col lg 3 -->
                <div class="col-sm-6 col-md-6 col-lg-3 mt-3 mt-lg-0">
                    <!-- Card -->
                    <div class="card border-0 rounded-lg">
                        <!-- Card body -->
                        <div class="card-body">

                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <!-- Icon -->
                                <div class="small-card-icon">
                                    <i class="fas fa-coins card-icon-bg-primary fa-4x"></i>
                                </div>
                                <!-- Text -->
                                <div class="small-card-text w-100 text-center">
                                    <p class="font-weight-normal m-0 text-muted">Sales</p>
                                    <h4 class="font-weight-normal m-0 text-primary">฿{{ number_format($totalSales, 2) }}
                                    </h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Col sm 6, col md 6, col lg 3 -->
                <div class="col-sm-6 col-md-6 col-lg-3 mt-3 mt-lg-0">
                    <!-- Card -->
                    <div class="card border-0 rounded-lg">
                        <!-- Card body -->
                        <div class="card-body">

                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <!-- Icon -->
                                <div class="small-card-icon">
                                    <i class="fas fa-shopping-basket card-icon-bg-primary fa-4x"></i>
                                </div>
                                <!-- Text -->
                                <div class="small-card-text w-100 text-center">
                                    <p class="font-weight-normal m-0 text-muted">Orders</p>
                                    <h4 class="font-weight-normal m-0 text-primary">{{ $completedOrdersCount }}</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Col sm 6, col md 6, col lg 3 -->
                <div class="col-sm-6 col-md-6 col-lg-3 mt-3 mt-lg-0">
                    <!-- Card -->
                    <div class="card border-0 rounded-lg">
                        <!-- Card body -->
                        <div class="card-body">

                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <!-- Icon -->
                                <div class="small-card-icon">
                                    <i class="fas fa-users card-icon-bg-primary fa-4x"></i>
                                </div>
                                <!-- Text -->
                                <div class="small-card-text w-100 text-center">
                                    <p class="font-weight-normal m-0 text-muted">Sellers</p>
                                    <h4 class="font-weight-normal m-0 text-primary">{{ $totalSeller }}</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>


        <!-- Data chart component -->
        <div class="row mb-4">
            <!-- Col lg 8, col md 12 -->
            <div class="col-lg-8 col-md-12 mt-4 mt-lg-0">
                <!-- Card -->
                <div class="card border-0 rounded-lg">
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- Card title -->
                        {{-- <div class="card-title">This Year Sales</div> --}}
                        <!-- Chart -->
                        <div id="echartBartest" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            <!-- Col lg 4, col md 12 -->
            <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
                <!-- Card -->
                <div class="card border-0 rounded-lg">
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- Card title -->
                        {{-- <div class="card-title">Sales by Countries</div> --}}
                        <!-- Chart -->
                        <div id="echartPieTest"
                            style="width:100%;height: 300px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative;">
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <!-- Row -->
        <div class="row">
            <!-- Col lg 6, col md 12 -->
            <div class="col-lg-6 col-md-12">
                <!-- Row -->
                <div class="row mb-4">
                    <!-- Col lg 6, col md 12 -->
                    <div class="col-lg-6 col-md-12 mt-4 mt-lg-0">
                        <!-- Card -->
                        <div class="card border-0 rounded-lg">
                            <!-- Card body -->
                            <div class="card-body">
                                <!-- Card title -->
                                <div class="text-muted">Last Month Sales</div>
                                {{-- <p class="mb-4 text-primary lead font-weight-bold">฿49000</p> --}}
                                <p class="mb-4 text-primary lead font-weight-bold">
                                    ฿{{ number_format($lastMonthSales->sum('total_sales'), 2) }}</p>
                            </div>
                            <!-- Chart -->
                            <div id="echart1"
                                style="height: 260px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative;">
                            </div>
                        </div>

                    </div>

                    <!-- Col lg 6, col md 12 -->
                    <div class="col-lg-6 col-md-12 mt-4 mt-lg-0">
                        <!-- Card -->
                        <div class="card border-0 rounded-lg">
                            <!-- Card body -->
                            <div class="card-body">
                                <!-- Card title -->
                                <div class="text-muted">Last Week Sales</div>
                                <p class="mb-4 text-primary lead font-weight-bold">
                                    ฿{{ number_format($lastWeekSales->sum('total_sales'), 2) }}</p>
                            </div>
                            <!-- Chart -->
                            <div id="echart2"
                                style="height: 260px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative;">
                            </div>
                        </div>

                    </div>

                </div>
                <!-- Row -->
                <div class="row">
                    <!-- col 12 -->
                    <div class="col-12">
                        <!-- Card -->
                        <div class="card border-0">

                            <!-- Card header -->
                            <div class="card-header border-0">
                                <!-- Card title -->
                                <p class="card-title d-inline">New Users</p>
                                <!-- Dropdown -->
                                <div class="dropdown dropdown-arow-none dropleft float-right">
                                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                                        <i class="fas fa-cog text-secondary-light"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item text-secondary-light">Add new user</a>
                                        <a href="#" class="dropdown-item text-secondary-light">View all user</a>
                                        <a href="#" class="dropdown-item text-secondary-light">Something else here</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Card body -->
                            <div class="card-body p-0">
                                <!-- responsive table -->
                                <div class="table-responsive" style="max-height: 728px; overflow: scroll; ">
                                    <table class="table text-dark">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="10%">#</th>
                                                <th width="20%">Name</th>
                                                <th width="10%">Avatar</th>
                                                <th width="30%">Email</th>
                                                <th width="15%">Status</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataAllusers as $key => $user)
                                                <tr class="text-center">
                                                    <td>
                                                        <p class="mb-0 font-weight-bold">{{ $key + 1 }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 font-weight-normal">{{ $user->name }}</p>
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset($user->image_profile ? 'qbadminui/img/' . $user->image_profile : 'qbadminui/img/profile.jpg') }}"
                                                            alt="Avatar" class="profile-avatar w-50 mb-0">
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 font-weight-normal">{{ $user->email }}</p>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge 
                                                                    {{ $user->statusSellers == 'Active' ? 'badge-success' : ($user->statusSellers == 'Pending' ? 'badge-info' : 'badge-warning') }} 
                                                                    badge-pill">
                                                            {{ $user->statusSellers }}
                                                        </span>
                                                    </td>
                                                    <td class="p-3">
                                                        <div
                                                            class="d-flex flex-row justify-content-around align-items-center">
                                                            <a href="#"><i
                                                                    class="fas fa-pencil-alt text-success"></i></a>
                                                            <a href="#"><i
                                                                    class="fas fa-times-circle text-danger"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Col lg 6, col md 12 -->
            <div class="col-lg-6 col-md-12 mt-4 mt-lg-0">
                <!-- row -->
                <div class="row">

                    <div class="col-12 mb-4">
                        <div class="card border-0 rounded-lg">
                            <div class="card-body max-height: 400px; overflow-y: auto;">
                                <div class="card-title">Top Selling Products</div>
                                @foreach ($products as $product)
                                    <div
                                        class="top-selling-product mt-4 d-flex flex-column flex-xl-row justify-content-between">
                                        <div class="d-flex flex-row">
                                            <!-- Product thumbnail -->
                                            <div class="product-thumbnail w-15">
                                                <img src="{{ asset($product->image ? 'images/products/' . $product->image : 'images/products/default.png') }}"
                                                    alt="product" class="w-100 h-75">
                                            </div>
                                            <!-- Product info -->
                                            <div class="produst-info ml-4">
                                                <h6 class="text-primary font-weight-normal">{{ $product->name }}</h6>
                                                <p class="mb-0 text-secondary-light">
                                                    {{ Str::limit($product->description, 50) }}</p>
                                                <p class="text-danger">${{ number_format($product->price, 2) }}
                                                    <del
                                                        class="text-secondary-light">${{ number_format($product->price + 50, 2) }}</del>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Details Button -->
                                        <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn w-50 btn-outline-primary rounded btn-sm align-self-center mb-4">Viewdetails</a>
                                        {{-- <button href="{{ route('product.show', ['id' => $product->id]) }}" class="btn w-50 btn-outline-primary rounded btn-sm align-self-center mb-4">Viewdetails</button> --}}
                                        {{-- {{ route('product.show', ['id' => $product->id]) }} --}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="card border-0" style="width: 100%;">

                        <!-- Card header -->
                        <div class="card-header border-0"
                            style="justify-content: space-between; display: flex; align-items: baseline;">
                            <!-- Card title -->
                            {{-- <p class="card-title d-inline">New Users</p> --}}
                            <span>User activity</span>
                            <span class="badge badge-pill badge-warning font-weight-normal">Update daily</span>
                            <!-- Dropdown -->
                            {{-- <div class="dropdown dropdown-arow-none dropleft float-right">
                                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                                <i class="fas fa-cog text-secondary-light"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="#" class="dropdown-item text-secondary-light">Add new user</a>
                                                <a href="#" class="dropdown-item text-secondary-light">View all user</a>
                                                <a href="#" class="dropdown-item text-secondary-light">Something else here</a>
                                            </div>
                                        </div> --}}
                        </div>
                        <!-- Col 12 -->
                        <div class="col-12 card-body p-0">
                            <!-- User activity section -->
                            <div class="card border-0 rounded-lg">
                                <!-- Card body -->
                                <div class="card-body p-0" style="max-height: 450px; overflow-y: auto;">
                                    <!-- Card title -->
                                    {{-- <div class="card-title m-0 p-3 d-flex flex-row align-items-center justify-content-between">
                                            <span>User activity</span>
                                            <span class="badge badge-pill badge-warning font-weight-normal">Update daily</span>
                                    </div> --}}
                                    <!-- Activity details -->
                                    @foreach ($activities as $activity)
                                        <div class="d-flex flex-row justify-content-between border-bottom p-3">
                                            <div class="flex-grow-1">
                                                <span class="small text-muted">Page URL</span>
                                                <h5 class="m-0 font-weight-normal">{{ $activity->page_url }}</h5>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="small text-muted">Action</span>
                                                <h5 class="m-0 font-weight-normal">{{ $activity->action }}</h5>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="small text-muted">User</span>
                                                <h5 class="m-0 font-weight-normal">
                                                    {{-- @if($activity->employee) --}}
                                                        {{ $employee->empname }}
                                                    {{-- @else
                                                        Unknown
                                                    @endif --}}
                                                    {{-- {{ $activity->employee ? $activity->employee->empname : 'Unknown' }} --}}
                                                </h5>
                                                {{-- <h5 class="m-0 font-weight-normal">
                                                    {{ \App\Models\Employee::find($activity->emp_id)->empname }}</h5> --}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            
            {{-- <!-- Col 12 -->
            <div class="col-12 mt-4">
                <!-- Card -->
                <div class="card mb-4">
                    <!-- Card body -->
                    <div class="card-body p-0">
                        <!-- Card title -->
                        <div class="card-title m-0 p-3">Last 20 Day Leads</div>
                        <!-- Chart -->
                        <div id="echart3"
                            style="height: 360px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative;">
                        </div>
                    </div>

                </div>

            </div> --}}

        </div>
    </div>
@endsection


@if (session('logData'))
    <script>
        console.log('Product Log:', {!! session('logData') !!});
    </script>
@endif

<script src="https://cdn.jsdelivr.net/npm/echarts@5.3.1/dist/echarts.min.js"></script>
<script>
    var salesData = @json($salesData); // ดึงข้อมูลจาก PHP มาเป็น JavaScript

    console.log('log salesData: ', salesData); // ตรวจสอบข้อมูลที่ได้จาก PHP

    // แปลงข้อมูลเป็น array ที่สามารถใช้ใน echart
    var weeks = salesData.map(function(item) {
        return 'Week ' + item.week_number;
    });

    var totalSales = salesData.map(function(item) {
        return item.total_sales;
    });

    // ใช้ DOMContentLoaded เพื่อให้แน่ใจว่า DOM ถูกโหลดก่อน
    document.addEventListener('DOMContentLoaded', function() {
        var chart = echarts.init(document.getElementById('echartBartest'));

        var option = {
            title: {
                text: 'Weekly Sales',
            },
            tooltip: {},
            xAxis: {
                type: 'category',
                data: weeks
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                data: totalSales,
                type: 'bar'
            }]
        };

        chart.setOption(option);

        // ให้กราฟปรับขนาดเมื่อหน้าต่างมีการเปลี่ยนแปลง
        window.addEventListener('resize', function() {
            chart.resize();
        });
    });
</script>


{{-- 
<script src="https://cdn.jsdelivr.net/npm/echarts@5.3.1/dist/echarts.min.js"></script> --}}
<script>
    var salesByCountryData = @json($salesByCountryData); // ดึงข้อมูลยอดขายตามประเทศจาก PHP มาเป็น JavaScript

    console.log('log salesByCountryData: ', salesByCountryData); // ตรวจสอบข้อมูล

    // แปลงข้อมูลเป็น array ที่สามารถใช้ใน echart
    var countries = salesByCountryData.map(function(item) {
        return item.country;
    });

    var totalSales = salesByCountryData.map(function(item) {
        return item.total_sales;
    });

    // ใช้ DOMContentLoaded เพื่อให้แน่ใจว่า DOM ถูกโหลดก่อน
    document.addEventListener('DOMContentLoaded', function() {
        // กำหนดค่า options สำหรับ echartPie
        var chart = echarts.init(document.getElementById('echartPieTest'));

        var option = {
            title: {
                text: 'Sales by Countries',
                subtext: 'Completed Orders Only',
                left: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b}: {c} ({d}%)'
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: countries
            },
            series: [{
                name: 'Sales',
                type: 'pie',
                radius: '55%',
                center: ['50%', '60%'],
                data: countries.map(function(country, index) {
                    return {
                        value: totalSales[index],
                        name: country
                    };
                }),
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };

        chart.setOption(option);

        // ให้กราฟปรับขนาดเมื่อหน้าต่างมีการเปลี่ยนแปลง
        window.addEventListener('resize', function() {
            chart.resize();
        });

    });
</script>

<script>
    var salesData = @json($lastMonthSales); // ดึงข้อมูลจาก PHP มาเป็น JavaScript

    // แปลงข้อมูลเป็น array ที่สามารถใช้ใน echart
    var days = salesData.map(function(item) {
        return 'Day ' + item.day;
    });

    var totalSales = salesData.map(function(item) {
        return item.total_sales;
    });

    // ใช้ DOMContentLoaded เพื่อให้แน่ใจว่า DOM ถูกโหลดก่อน
    document.addEventListener('DOMContentLoaded', function() {
        // กำหนดค่า options สำหรับ echart1
        var chart = echarts.init(document.getElementById('echart1test'));

        var option = {
            title: {
                text: 'Last Month Sales',
            },
            tooltip: {},
            xAxis: {
                type: 'category',
                data: days
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                data: totalSales,
                type: 'bar'
            }]
        };

        chart.setOption(option);

        // ให้กราฟปรับขนาดเมื่อหน้าต่างมีการเปลี่ยนแปลง
        window.addEventListener('resize', function() {
            chart.resize();
        });

    });
</script>

{{--  --}}
<script>
    var lastWeekSales = @json($lastWeekSales); // ดึงข้อมูลจาก PHP มาเป็น JavaScript

    // แปลงข้อมูลเป็น array ที่สามารถใช้ใน echart
    var days = lastWeekSales.map(function(item) {
        var daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        return daysOfWeek[item.day_of_week - 1]; // ให้แสดงชื่อวันในสัปดาห์ (จาก Carbon)
    });

    var totalSales = lastWeekSales.map(function(item) {
        return item.total_sales;
    });

    // ใช้ DOMContentLoaded เพื่อให้แน่ใจว่า DOM ถูกโหลดก่อน
    document.addEventListener('DOMContentLoaded', function() {
        // กำหนดค่า options สำหรับ echart2
        var chart = echarts.init(document.getElementById('echart2test'));

        var option = {
            title: {
                text: 'Last Week Sales',
            },
            tooltip: {},
            xAxis: {
                type: 'category',
                data: days
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                data: totalSales,
                type: 'bar'
            }]
        };

        chart.setOption(option);

        // ให้กราฟปรับขนาดเมื่อหน้าต่างมีการเปลี่ยนแปลง
        window.addEventListener('resize', function() {
            chart.resize();
        });

    });
</script>

{{-- 

<tbody>
    @foreach ($dataAllusers as $key => $user)
        <tr class="text-center">
            <td><p class="mb-0 font-weight-bold">{{ $key + 1 }}</p></td>
            <td><p class="mb-0 font-weight-normal">{{ $user->name }}</p></td>
            <td>
                <img src="{{ asset($user->image_profile ? 'qbadminui/img/' . $user->image_profile : 'qbadminui/img/default.png') }}" 
                    alt="Avatar" class="profile-avatar w-50 mb-0">
            </td>
            <td><p class="mb-0 font-weight-normal">{{ $user->email }}</p></td>
            <td>
                <span class="badge badge-{{ $user->statusSellers == 'seller' ? 'non-seller' : 'warning' }} badge-pill">
                    {{ ucfirst($user->statusSellers) }}
                </span>
            </td>
            <td class="p-3">
                <div class="d-flex flex-row justify-content-around align-items-center">
                    <a href="#"><i class="fas fa-pencil-alt text-success"></i></a>
                    <a href="#"><i class="fas fa-times-circle text-danger"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
</tbody> --}}
