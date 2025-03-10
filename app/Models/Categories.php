<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    //public $timestamps = false; // ปิดการใช้งาน timestamps

    protected $table = 'categories';
    protected $primaryKey = 'categories_id'; // กำหนดคีย์หลักให้เป็น categories_id
    //protected $primaryKey = 'id'; // หรือ 'barcode' ขึ้นอยู่กับการออกแบบของคุณ

    protected $fillable = [
        'id' ,
        'image' ,
        'name' ,
        'description' ,
        'created_at ' ,
        'updated_at' 
    ];
}
?>