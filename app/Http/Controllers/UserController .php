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
        return view('users.create');
    }

    // บันทึกผู้ใช้ใหม่
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'ผู้ใช้ถูกสร้างสำเร็จ');
    }

    // แสดงข้อมูลผู้ใช้
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // แสดงฟอร์มแก้ไขข้อมูลผู้ใช้
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // อัพเดตข้อมูลผู้ใช้
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'ข้อมูลผู้ใช้ถูกอัพเดต');
    }

    // ลบผู้ใช้
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'ผู้ใช้ถูกลบ');
    }
}
