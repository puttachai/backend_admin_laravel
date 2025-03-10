<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
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
        'emp_id',
        // 'seller_id',
    ];

    // ความสัมพันธ์กับ Seller (ถ้ามี)
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

}
?>