<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Seller;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $table = 'users';

     protected $primaryKey = 'id'; // ระบุ Primary Key ที่ถูกต้อง

    protected $fillable = [
        'id', 'name', 'email', 'password', 'statusUser', 'created_at', 'phoneNumber'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function seller()
    // {
    //     return $this->hasOne(Seller::class); // เชื่อมกับโมเดล Seller
    // }

    public function seller()
    {
        // เชื่อมโยงกับ seller_id ใน sellers
        return $this->hasOne(Seller::class, 'seller_id', 'id');
    }

    /**
     * ดึงค่า seller_id
     */
    public function getSellerIdAttribute()
    {
        // ถ้ามีข้อมูล seller, คืนค่า seller_id
        return $this->seller ? $this->seller->id : null;
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
    
}
