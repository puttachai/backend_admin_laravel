<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Employee;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'empname' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:useremployee'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'empname' => 'required|string|max:255',
            'email' => 'required|email|unique:useremployee',
            'password' => 'required|min:8|confirmed',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'salary' => 'required|numeric',
        ]);
    }

     // ฟังก์ชันที่แสดงฟอร์มสมัครสมาชิก
     public function showRegistrationForm()
     {
         return view('auth.register');
     }

     protected function create(array $data)
     {

        Log::info('Employee data Log: ', ['data' => $data]);
        // dd($data); // ตรวจสอบค่าที่ส่งมา

         try {
             // เข้ารหัสรหัสผ่านก่อนการสร้าง Employee
             $employee = Employee::create([
                 'empname' => $data['empname'],
                 'email' => $data['email'],
                 'first_name' => $data['first_name'],
                 'last_name' => $data['last_name'],
                 'address' => $data['address'],
                 'phone_number' => $data['phone_number'],
                 'position' => $data['position'],
                 'start_date' => $data['start_date'],
                 'salary' => $data['salary'],
                 'password' => Hash::make($data['password']), // เข้ารหัสรหัสผ่าน
                //  'education_level' => $data['education_level'] ?? 'Not specified', // เพิ่มค่า default
                 'education_level' => $data['education_level'] ?? null, // ✅ ไม่ต้องกำหนดค่าเริ่มต้นที่นี่
                 'date_of_birth' => $data['date_of_birth'] ?? '2000-01-01', // เพิ่มค่า default
             ]);
     
            if ($employee) {
                Log::info('Employee created successfully', $employee->toArray());
                Auth::login($employee); // ล็อกอินผู้ใช้หลังจากสร้าง
                // เพิ่มการแจ้งเตือนสำเร็จ
                // session()->flash('success', 'สมัครสมาชิกสำเร็จ!');

                return $employee;
            } else {
                Log::error('Failed to create employee');
                return null;
            }

         } catch (\Exception $e) {
             Log::error('Error creating employee: ', ['message' => $e->getMessage()]);
             return null;
         }
     }
     

    public function registerC(Request $request)
    {
        // ตรวจสอบข้อมูลที่กรอก
        $this->validator($request->all())->validate();

        // สร้างผู้ใช้ใหม่
        $employee = $this->create($request->all());

        // ถ้าสร้างผู้ใช้สำเร็จ
        if ($employee) {
        session()->flash('success', 'สมัครสมาชิกสำเร็จ!');
        return redirect($this->redirectTo);
    } else {
        return redirect()->back()->withErrors(['registration_failed' => 'ไม่สามารถสมัครสมาชิกได้ กรุณาลองใหม่']);
    }
    }
}
