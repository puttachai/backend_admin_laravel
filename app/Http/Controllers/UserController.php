<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // แสดงรายชื่อผู้ใช้ทั้งหมด
    public function index()
    {
        $users = User::paginate(10);
        Log::info('Log users :', ['users' => $users]);
        return view('user.list-user', compact('users'));
    }

    // แสดงฟอร์มสร้างผู้ใช้ใหม่
    public function create()
    {
        return view('user.create-user');
    }

    // บันทึกผู้ใช้ใหม่
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phoneNumber' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'ผู้ใช้ถูกสร้างสำเร็จ');
    }

    // แสดงข้อมูลผู้ใช้
    public function show($id)
    {
        // $users = User::find($id);
        $users = User::findOrFail($id);
        if (!$users) {
            return redirect()->route('user.list-user')->with('status', 'user not found');
        }
        return view('user.show-user', compact('users'));
    }

    // แสดงฟอร์มแก้ไขข้อมูลผู้ใช้
    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('user.edit-user', compact('users'));
    }

    // อัพเดตข้อมูลผู้ใช้
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:8', // ทำให้รหัสผ่านเป็น optional
        ]);

        // $user = User::findOrFail($id);
        // $user->update([
        //     'name' => $request->name,
        //     'username' => $request->username,
        //     'phoneNumber' => $request->phoneNumber,
        //     'email' => $request->email,
        //     'password' => $request->password ? bcrypt($request->password) : $user->password,
        // ]);

        $user = User::findOrFail($id);

        // ตรวจสอบว่ามีการกรอกรหัสผ่านใหม่หรือไม่
        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->email,
        ];
    
        // ถ้ามีการกรอกรหัสผ่านใหม่ ให้ทำการเข้ารหัสและอัพเดต
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }
    
        // อัพเดตข้อมูลผู้ใช้
        $user->update($userData);

        return redirect()->route('users.index')->with('success', 'ข้อมูลผู้ใช้ถูกอัพเดต');
    }

    // ลบผู้ใช้
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'ผู้ใช้ถูกลบ');
    }
}
