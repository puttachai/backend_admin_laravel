<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false; // ปิดการใช้งาน timestamps

    protected $table = 'products';
    //protected $primaryKey = 'id'; // หรือ 'barcode' ขึ้นอยู่กับการออกแบบของคุณ

    protected $fillable = [
        'barcode',
        'name',
        'price',
        'qty',
        'description',
        'image',
        'categories_id',
        'emp_id',
        // 'seller_id',
    ];

    // ความสัมพันธ์กับ Seller (ถ้ามี)
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class,'categories_id');
    }
 
}

?>