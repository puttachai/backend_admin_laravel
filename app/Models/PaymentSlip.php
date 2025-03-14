<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSlip extends Model
{
    use HasFactory;

    // protected $table = 'paymentslips'; // เปลี่ยนเป็นชื่อตารางที่คุณใช้
    protected $table = 'ordersexample'; // เปลี่ยนเป็นชื่อตารางที่คุณใช้
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id',
        'referenceNumber',
        'Transaction_id',
        'TotalAmount',
        'Discount',
        'Tax',
        'FinalAmount',
        'QRCodeUrl',
        'CreatedAt',
        'UpdatedAt',
        'Status',
        'slip_image',
        'Country',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
