<?php
namespace App\Http\Controllers;

use App\Models\Seller; // ต้องการใช้ Model Seller
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    public function showSellers()
    {
        // ดึงข้อมูลผู้ขายทั้งหมดพร้อมข้อมูลผู้ใช้งานที่เกี่ยวข้อง
    $sellers = Seller::with('user')->get(); 

    return view('indextest', compact('sellers'));
    }


    // แสดงรายชื่อผู้ใช้ทั้งหมด
    public function index()
    {
        $sellers = Seller::paginate(10);
        Log::info('Log sellers :', ['sellers' => $sellers]);
        return view('seller.list-seller', compact('sellers'));
    }

    // แสดงฟอร์มสร้างผู้ใช้ใหม่
    public function create()
    {
        return view('seller.create-seller');
    }

    // บันทึกผู้ใช้ใหม่
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'username' => 'required|string|max:255',
    //         'phoneNumber' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|min:6|confirmed',
    //     ]);

    //     Seller::create([
    //         'name' => $request->name,
    //         'username' => $request->username,
    //         'phoneNumber' => $request->phone,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //     ]);

    //     return redirect()->route('sellers.index')->with('success', 'ผู้ใช้ถูกสร้างสำเร็จ');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'id_card_copy' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // ข้อกำหนดสำหรับไฟล์
        ]);

        // อัปโหลดไฟล์ ID card
        $idCardCopyPath = null;
        if ($request->hasFile('id_card_copy')) {
            $idCardCopyPath = $request->file('id_card_copy')->store('id_cards', 'public'); // เก็บไฟล์ใน public/id_cards
        }

        Seller::create([
            'name' => $request->name,
            'username' => $request->username,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'id_card_copy' => $idCardCopyPath, // บันทึก path ของไฟล์
        ]);

        return redirect()->route('sellers.index')->with('success', 'ผู้ใช้ถูกสร้างสำเร็จ');
    }


    // แสดงข้อมูลผู้ใช้
    public function show($id)
    {
        // $users = User::find($id);
        $sellers = Seller::findOrFail($id);
        if (!$sellers) {
            return redirect()->route('seller.list-seller')->with('status', 'sellers not found');
        }
        return view('seller.show-seller', compact('sellers'));
    }

    // แสดงฟอร์มแก้ไขข้อมูลผู้ใช้
    public function edit($id)
    {
        $sellers = Seller::findOrFail($id);
        return view('seller.edit-seller', compact('sellers'));
    }

    // อัพเดตข้อมูลผู้ใช้
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'username' => 'required|string|max:255',
    //         'phoneNumber' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $id,
    //         'password' => 'nullable|confirmed|min:8', // ทำให้รหัสผ่านเป็น optional
    //     ]);

    //     $seller = Seller::findOrFail($id);

    //     // ตรวจสอบว่ามีการกรอกรหัสผ่านใหม่หรือไม่
    //     $sellerData = [
    //         'name' => $request->name,
    //         'username' => $request->username,
    //         'phoneNumber' => $request->phoneNumber,
    //         'email' => $request->email,
    //     ];
    
    //     // ถ้ามีการกรอกรหัสผ่านใหม่ ให้ทำการเข้ารหัสและอัพเดต
    //     if ($request->filled('password')) {
    //         $sellerData['password'] = bcrypt($request->password);
    //     }
    
    //     // อัพเดตข้อมูลผู้ใช้
    //     $seller->update($sellerData);

    //     return redirect()->route('sellers.index')->with('success', 'ข้อมูลผู้ใช้ถูกอัพเดต');
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:8',
            'id_card_copy' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // ข้อกำหนดสำหรับไฟล์
        ]);

        $seller = Seller::findOrFail($id);

        // เตรียมข้อมูลที่จะอัปเดต
        $sellerData = [
            'name' => $request->name,
            'username' => $request->username,
            'phoneNumber' => $request->phoneNumber,
            'email' => $request->email,
        ];

        // ถ้ามีการกรอกรหัสผ่านใหม่
        if ($request->filled('password')) {
            $sellerData['password'] = bcrypt($request->password);
        }

        // ถ้ามีการอัปโหลดไฟล์ ID card
        if ($request->hasFile('id_card_copy')) {
            // ลบไฟล์เดิมก่อน (ถ้ามี)
            if ($seller->id_card_copy) {
                Storage::disk('public')->delete($seller->id_card_copy);
            }

            // อัปโหลดไฟล์ใหม่
            $sellerData['id_card_copy'] = $request->file('id_card_copy')->store('id_cards', 'public');
        }

        // อัพเดตข้อมูลผู้ใช้
        $seller->update($sellerData);

        return redirect()->route('sellers.index')->with('success', 'ข้อมูลผู้ใช้ถูกอัพเดต');
    }


    // ลบผู้ใช้
    public function destroy($id)
    {
        Seller::destroy($id);
        return redirect()->route('sellers.index')->with('success', 'ผู้ใช้ถูกลบ');
    }

}




