<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // $employee = Auth::user(); // ดึงข้อมูลผู้ใช้ที่ล็อกอิน
        // dd(session('seller_id'));
        // $seller_ids = session('seller_id');  // ดึงค่า seller_id จาก session
        // dd($seller_ids);
         // โหลดข้อมูล activities พร้อมกับข้อมูลของ employee
        //  $activities = UserActivity::with('employee')->get();

        $employee = Auth::guard('employee')->user(); // ดึงข้อมูล employee ที่ล็อกอินอยู่
        
        // 🔍 Log ค่าที่ได้ไปที่ laravel.log
        Log::info('User Logged In:', ['employee' => $employee]);
        // 🔍 Debug ค่าที่ได้
        //  dd($employee); // จะแสดงค่าของ user แล้วหยุด execution

        $totalUsers = User::count(); // นับจำนวน user ทั้งหมด
        $totalSales = DB::table('ordersexample')
        ->where('status', 'Completed') // นับเฉพาะออเดอร์ที่เสร็จสมบูรณ์
        ->sum('FinalAmount'); // รวมยอดขายจาก FinalAmount

        // นับจำนวนคำสั่งซื้อที่มีสถานะเป็น 'Completed'
        $completedOrdersCount = DB::table('ordersexample')
        ->where('status', 'Completed')
        ->count(); // นับจำนวนแถวที่ตรงเงื่อนไข

        // นับจำนวนคำสั่งซื้อที่มีสถานะเป็น 'Completed'
        $totalSeller = DB::table('sellers') // นับจำนวน seller ทั้งหมด
        ->count(); // นับจำนวนแถวที่ตรงเงื่อนไข

        // Query to get sales per week where status is 'Completed'
        $salesData = DB::table('ordersexample')
            ->select(DB::raw('WEEK(CreatedAt) as week_number, SUM(FinalAmount) as total_sales'))
            ->where('Status', 'Completed')
            ->groupBy(DB::raw('WEEK(CreatedAt)'))
            ->orderBy('week_number', 'asc')
            ->get();

             // แปลง salesData เป็น array
            // $salesData = $salesData->toArray();

            $salesData = $salesData->map(function($item) {
                return (object)[
                    'week_number' => $item->week_number,
                    'total_sales' => (float)$item->total_sales
                ];
            })->toArray();

            Log::info('Log salesData In:', ['salesData' => $salesData]);

            // ดึงข้อมูลยอดขายจากแต่ละประเทศ โดยให้เงื่อนไขเป็นสถานะ Completed
            $salesByCountry = DB::table('ordersexample')
                ->select('Country', DB::raw('SUM(FinalAmount) as total_sales'))
                ->where('Status', 'Completed')
                ->groupBy('Country')
                ->get();

            // ให้ประเทศที่ไม่มีข้อมูลแสดงเป็น 0
            $countries = ['Thailand', 'USA', 'Japan', 'Germany']; // ตัวอย่างประเทศ
            $salesByCountryData = [];
            foreach ($countries as $country) {
                $sales = $salesByCountry->firstWhere('Country', $country);
                $salesByCountryData[] = [
                    'country' => $country,
                    'total_sales' => $sales ? $sales->total_sales : 0
                ];
            }

            // ดึงวันที่ปัจจุบัน
            $currentDate = Carbon::now();
            // ดึงข้อมูลเดือนที่แล้ว
            $lastMonthStart = $currentDate->copy()->subMonth()->startOfMonth();
            $lastMonthEnd = $currentDate->copy()->subMonth()->endOfMonth();

            // ดึงยอดขายเดือนที่แล้ว
            $lastMonthSales = DB::table('ordersexample')
                ->where('Status', 'Completed')
                ->whereBetween('CreatedAt', [$lastMonthStart, $lastMonthEnd])
                ->select(DB::raw('DAY(CreatedAt) as day, SUM(FinalAmount) as total_sales'))
                ->groupBy(DB::raw('DAY(CreatedAt)'))
                ->orderBy('day', 'asc')
                ->get();

                 // ดึงวันที่ปัจจุบัน
                $currentDate = Carbon::now();
                
                // คำนวณวันเริ่มต้น (วันจันทร์) และวันสิ้นสุด (วันอาทิตย์) ของสัปดาห์ที่แล้ว
                $lastWeekStart = $currentDate->copy()->subWeek()->startOfWeek();
                $lastWeekEnd = $currentDate->copy()->subWeek()->endOfWeek();

                // ดึงข้อมูลยอดขายของสัปดาห์ที่แล้ว
                $lastWeekSales = DB::table('ordersexample')
                    ->where('Status', 'Completed')
                    ->whereBetween('CreatedAt', [$lastWeekStart, $lastWeekEnd])
                    ->select(DB::raw('DAYOFWEEK(CreatedAt) as day_of_week, SUM(FinalAmount) as total_sales'))
                    ->groupBy(DB::raw('DAYOFWEEK(CreatedAt)'))
                    ->orderBy('day_of_week', 'asc')
                    ->get();
            
                // นับจำนวนคำสั่งซื้อที่มีสถานะเป็น 'Completed'
                // ดึงข้อมูลทั้งหมดจาก users table
                $dataAllusers = DB::table('users')->get();

                $products = DB::table('products')->orderBy('id', 'desc')->limit(5)->get();

                $activities = UserActivity::latest()->limit(10)->get();
                // dd($activities);  // เพิ่มการตรวจสอบ
                // return view('home', compact('activities'));


                // ->count(); // นับจำนวนแถวที่ตรงเงื่อนไข

        // $employee = Auth::user(); // ดึงข้อมูล User ที่ล็อกอินอยู่ตอนนี้
        return view('home', compact('employee', 'totalUsers', 'totalSales', 'completedOrdersCount', 'totalSeller', 'salesData','salesByCountryData', 'lastMonthSales', 'lastWeekSales','dataAllusers', 'products', 'activities'));

        // return view('home', compact('employee'));
    }

    // public function totalUsers()
    // {
    //     $totalUsers = User::count(); // นับจำนวน users ทั้งหมด
    //     return view('home', compact('employee', 'totalUsers'));
    // }

}
