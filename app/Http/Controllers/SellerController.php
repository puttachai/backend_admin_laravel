<?php
namespace App\Http\Controllers;

use App\Models\Seller; // ต้องการใช้ Model Seller
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function showSellers()
    {
        // ดึงข้อมูลผู้ขายทั้งหมดพร้อมข้อมูลผู้ใช้งานที่เกี่ยวข้อง
    $sellers = Seller::with('user')->get(); 

    return view('indextest', compact('sellers'));
    }
}




