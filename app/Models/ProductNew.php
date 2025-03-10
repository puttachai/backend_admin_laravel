<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductNew extends Model
{
    use HasFactory;

    protected $table = 'products';
    //protected $primaryKey = 'id'; // หรือ 'barcode' ขึ้นอยู่กับการออกแบบของคุณ

    protected $fillable = [
        'barcode',
        'name',
        'price',
        'qty',
        'description',
        'image',
        'seller_id'
    ];

    // ความสัมพันธ์กับ Seller (ถ้ามี)
    // public function seller()
    // {
    //     return $this->belongsTo(User::class, 'seller_id');
    // }

}
