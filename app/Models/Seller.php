<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    // กำหนดให้มีความสัมพันธ์กับ User
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // กำหนดความสัมพันธ์กับ User โดยใช้ seller_id
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'seller_id');  // ระบุชื่อคอลัมน์ที่ต้องการใช้
    // }

     // ความสัมพันธ์ 1-to-1 หรือ 1-to-many ขึ้นอยู่กับโครงสร้างของฐานข้อมูล
     public function user()
     {
         // เชื่อมโยง seller_id ใน sellers กับ id ใน users
         return $this->belongsTo(User::class, 'seller_id', 'id');
     }
     public function employee()
     {
         // เชื่อมโยง seller_id ใน sellers กับ id ใน users
         return $this->belongsTo(Employee::class, 'seller_id', 'emp_id'); //emp_id
     }

    protected $table = 'sellers';
    //protected $primaryKey = 'id'; // หรือ 'barcode' ขึ้นอยู่กับการออกแบบของคุณ

    protected $fillable = [
        'seller_id',
        'name',
        'email',
        'Pickup_address',
        'shop_name',
        'phone_number',
        'thai_national_id',
        'id_card_copy',
    ];


}
