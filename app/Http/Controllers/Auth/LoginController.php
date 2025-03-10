<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log; // นำเข้า Log facade

// class LoginController extends Controller
// {
//     /*
//     |--------------------------------------------------------------------------
//     | Login Controller
//     |--------------------------------------------------------------------------
//     |
//     | This controller handles authenticating users for the application and
//     | redirecting them to your home screen. The controller uses a trait
//     | to conveniently provide its functionality to your applications.
//     |
//     */

//     use AuthenticatesUsers;

//     /**
//      * Where to redirect users after login.
//      *
//      * @var string
//      */
//     protected $redirectTo = RouteServiceProvider::HOME;

//     /**
//      * Create a new controller instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         $this->middleware('guest')->except('logout');
//     }

//     /**
//      * Override the login method to use the employee guard.
//      */
//     public function login(Request $request)
//     {
//         $credentials = $request->only('email', 'password');

//         Log::info('Attempting login with credentials: ', $credentials);
        
//         // ใช้ guard สำหรับ employee
//         // if (Auth::guard('employee')->attempt($credentials)) {
//         if (Auth::guard('web')->attempt($credentials)) {
//             Log::info('Login successful');
//             authenticated();
//             // เข้าสู่ระบบสำเร็จ
//             return redirect()->route('home');
//         } else {
//             return back()->withErrors(['login' => 'Invalid credentials']);
//         }

//         Log::info('Login failed, invalid credentials');
//         return back()->withErrors(['email' => 'Invalid credentials']);
//     }

//     // ฟังก์ชันที่เรียกใช้เมื่อผู้ใช้ล็อกอินสำเร็จ
//     protected function authenticated(Request $request, $employee)
//     {
//         Log::info('Log: employee',$employee);
//         // สมมติว่า seller_id เก็บไว้ใน user หรือ profile ที่เชื่อมโยงกับผู้ใช้
//         // $seller_id = $user->seller_id;
//         $seller_id = $employee->emp_id;

//         // เก็บ seller_id ลงใน session
//         session(['seller_id' => $seller_id]);

//         // Log ข้อมูลการล็อกอิน
//         Log::info('Employee logged in successfully', [
//             'emp_id' => $employee->emp_id,
//             'seller_id' => $seller_id,
//             'email' => $employee->email
//         ]);

//         return redirect()->route('home');
//     }
//     }

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        Log::info('Attempting login with credentials: ', $credentials);

        // if (Auth::guard('web')->attempt($credentials)) {
        //     Log::info('Attempting login with credentials: ', $credentials);
        //     Log::info('Login successful as user');
        //     $user = Auth::user();
        //     Log::info('check user: ', ['user' => $user]);
            
        //     // เช็คว่า user มี status เป็น 1 หรือไม่
        //     if ($user->statusUser != 1) {
        //         Log::info('Your account is not authorized to log in.');
        //         Auth::logout(); // ออกจากระบบถ้าไม่ผ่าน
        //         return back()->withErrors(['login' => 'Your account is not authorized to log in.']);
        //     }
    
        //     return redirect()->route('home'); // เข้าสู่ระบบสำเร็จ
        // }
        
        /////////////////////////////////////////////////////
        // if (Auth::guard('web')->attempt($credentials)) {
        //     Log::info('Attempting login with credentials: ', $credentials);
        //     Log::info('Login successful as user');

        //     // ตรวจสอบว่าผู้ใช้ authenticated จริงหรือไม่
        //     if (Auth::guard('web')->check()) {
        //         Log::info('User still authenticated after login');
        //     } else {
        //         Log::info('User session lost after login');
        //     }

        //     // ตรวจสอบการเข้าสู่ระบบของ User (เฉพาะที่มี status = 1 เท่านั้น)
        //     // if (Auth::guard('web')->attempt(array_merge($credentials, ['statusUser' => 1]))) {
        //     //     Log::info('Login successful as user');

        //     //     return $this->authenticatedUser($request, Auth::guard('web')->user());
        //     // } 

        //     return $this->authenticatedUser($request, Auth::guard('web')->user());
        // } 

        // use Illuminate\Support\Facades\Hash;
        // use App\Models\Employee;

        // $employee = Employee::where('email', 'administrator2@gmail.com')->first(); 
        // $employee ->password = Hash::make('password'); 
        // $employee ->save();

         // ตรวจสอบการเข้าสู่ระบบสำหรับ 'employee' guard
         if (Auth::guard('employee')->attempt($credentials)) {
            Log::info('Attempting login with credentials: ', $credentials);
            Auth::shouldUse('employee'); // บังคับให้ Laravel ใช้ Guard employee
            Log::info('Login successful as employee');

            // dd(Auth::guard()->getName()); // ตรวจสอบว่าเป็น "employee" หรือยังเป็น "web"

            // Log::info('Log  Auth::guard: ', ['Auth::guard' => Auth::guard()]);
            
            // ตรวจสอบว่าผู้ใช้ authenticated จริงหรือไม่
            if (Auth::guard('employee')->check()) {
                Log::info('Employee  still authenticated after login');
                // return redirect()->route('home');
            } else {
                Log::info('Employee  session lost after login');
                // return back()->withErrors(['email' => 'Invalid credentials']);
            }

            // return redirect()->route('home');
            return $this->authenticated($request, Auth::guard('employee')->user());
        }
        
        Log::info('Login failed, invalid credentials');
        return back()->withErrors(['login' => 'Invalid credentials']);
    }

    protected function authenticated(Request $request, $employee)
    {
        Log::info('Log authenticated employee', ['employee' => $employee]);

        // dd(Auth::guard());

        if ($employee) {
            $seller_id = $employee->emp_id;
            session(['seller_id' => $seller_id]);

            Log::info('Employee logged in successfully', [
                'emp_id' => $employee->emp_id,
                'seller_id' => $seller_id,
                'email' => $employee->email,
            ]);
        }

        // return redirect()->route('home');
        return redirect()->route('employee.home');
    }

    // protected function authenticatedUser(Request $request, $user)
    // {
    //     Log::info('Log authenticated user', ['user' => $user]);

    //     if ($user) {
    //         $seller_id = $user->id;
    //         session(['seller_id' => $seller_id]);

    //         Log::info('User logged in successfully', [
    //             'emp_id' => $user->id,
    //             'seller_id' => $seller_id,
    //             'email' => $user->email
    //         ]);
    //     }

    //     return redirect()->route('home');
    // }
}



     // ฟังก์ชันที่เรียกใช้เมื่อผู้ใช้ล็อกอินสำเร็จ
    //  protected function authenticated(Request $request, $user)
    //  {
    //      // สมมติว่า seller_id เก็บไว้ใน user หรือ profile ที่เชื่อมโยงกับผู้ใช้
    //      $seller_id = $user->seller_id;
 
    //      // เก็บ seller_id ลงใน session
    //      session(['seller_id' => $seller_id]);
 
    //      // Log ข้อมูลการล็อกอิน
    //      Log::info('User logged in successfully', [
    //          'user_id' => $user->id,
    //          'seller_id' => $seller_id,
    //          'email' => $user->email
    //      ]);
 
    //      // แสดงข้อมูลบนหน้าเว็บ (สำหรับการพัฒนา)
    //      // dd('User logged in:', ['seller_id' => $seller_id]);
 
    //      // หลังจากนั้นให้ redirect ไปที่หน้าหลักหรือหน้าที่ต้องการ
    //      return redirect()->route('home');
    //  }

    // protected function authenticated(Request $request, $user)
    // {
    //     // สมมติว่า seller_id เก็บไว้ใน user หรือ profile ที่เชื่อมโยงกับผู้ใช้
    //     $seller_id = $user->seller_id;

    //     // เก็บ seller_id ลงใน session
    //     session(['seller_id' => $seller_id]);

    //     // หลังจากนั้นให้ redirect ไปที่หน้าหลักหรือหน้าที่ต้องการ
    //     return redirect()->route('home'); // หรือหน้าอื่นที่ต้องการ
    // }

// }
