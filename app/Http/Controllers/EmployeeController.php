<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

// use App\Http\Controllers\Controller; // เพิ่มบรรทัดนี้

class EmployeeController extends Controller
{
    public function store(Request $request)
    {
        // Log ข้อมูลที่ได้รับจาก form
        Log::info('Store Employee Data:', $request->all());


        dd($request->all()); // หยุดโปรแกรมแล้วแสดงค่าทั้งหมด

        // ตรวจสอบข้อมูล
        $request->validate([
            'empname' => 'required|string|max:255',
            'email' => 'required|email|unique:useremployee',
            'password' => 'required|min:8',
        ]);

        // Log ข้อมูลก่อนการบันทึกลงฐานข้อมูล
        Log::info('Employee data validated, proceeding to save.');

        // บันทึกข้อมูลลง Database
        Employee::create([
            'empname' => $request->empname,
            'email' => $request->email,
            'password' => bcrypt($request->password), // เข้ารหัสรหัสผ่าน
        ]);

        // Log ข้อมูลหลังจากบันทึกสำเร็จ
        Log::info('Employee created successfully: ' . $request->empname);

        // ส่งกลับไปหน้าแสดงข้อมูล พร้อมแจ้งเตือน
        return redirect()->route('login')->with('success', 'เพิ่มพนักงานเรียบร้อย');
    }


    public function index()
    {

        // ตรวจสอบว่ามีการล็อกอินหรือไม่
        if (Auth::guard('employee')->check()) {
            $employee = Auth::guard('employee')->user();
        } else {
            $employee = null; // กำหนดค่าเป็น null ถ้ายังไม่ได้ล็อกอิน
        }

        // ตรวจสอบว่ามีการล็อกอินหรือไม่
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
        } else {
            $user = null; // กำหนดค่าเป็น null ถ้ายังไม่ได้ล็อกอิน
        }

        return view('home', compact('employee','user'));
    }
    


}
