<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserActivityController extends Controller
{

    // public function showUserActivity(Request $request)
    //     {
    //         // ดึงข้อมูลกิจกรรมล่าสุด
    //         $activities = UserActivity::latest()->limit(10)->get();
    //         dd($activities);  // ตรวจสอบกิจกรรมล่าสุด

    //         // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบด้วย guard 'employee'
    //         $employee = Auth::guard('employee')->user();  // ใช้ guard ที่เหมาะสม

    //         // ตรวจสอบว่าผู้ใช้มีการเชื่อมโยงกับ users table หรือไม่
    //         $employeeData = Employee::find($employee->emp_id);
    //         Log::info('Log authenticated employee', ['employee' => $employeeData]);

    //         // ตรวจสอบว่าเป็น Employee หรือไม่
    //         dd($employeeData); // ตรวจสอบข้อมูลที่ได้จากการเชื่อมโยง

    //         // บันทึกกิจกรรมของผู้ใช้
    //         if ($employeeData) {
    //             UserActivity::create([
    //                 'user_id' => $employeeData->user_id,  // ใช้ user_id จาก Employee ที่เชื่อมโยงกับ users
    //                 'page_url' => $request->url(),
    //                 'action' => 'visit',
    //                 'ip_address' => $request->ip(),
    //                 'user_agent' => $request->userAgent(),
    //             ]);
    //         } else {
    //             Log::error('Employee data not found');
    //         }

    //         // ส่งข้อมูลกิจกรรมไปยังวิว home
    //         return view('home', compact('activities'));
    //     }


    public function showUserActivity(Request $request)  // เพิ่ม Request $request
    {
        // ดึงข้อมูลกิจกรรมล่าสุด
        $activities = UserActivity::latest()->limit(10)->get();
        dd($activities);  // ตรวจสอบกิจกรรมล่าสุด

        // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบด้วย guard 'employee'
        $employee = Auth::guard('employee')->user();  // ใช้ guard ที่เหมาะสม
           // ตรวจสอบว่าผู้ใช้มีการเชื่อมโยงกับ users table หรือไม่
        $employee = Employee::find($employee->emp_id);
        Log::info('Log authenticated employee', ['employee' => $employee]);

        dd($employee); // ตรวจสอบว่าเป็น "employee" หรือยังเป็น "web"

        // บันทึกกิจกรรมของผู้ใช้
        UserActivity::create([
            'emp_id' => $request->emp_id,  // ใช้ emp_id จาก Employee
            'page_url' => $request->url(),
            'action' => 'visit',  // ประเภทการกระทำ
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // ส่งข้อมูลกิจกรรมไปยังวิว home
        return view('home', compact('activities'));
    }
}
