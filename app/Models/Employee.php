<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Support\Facades\Log;

// class Employee extends Model implements Authenticatable
class Employee extends Model implements Authenticatable
{
    // use HasFactory;
    use HasFactory, AuthenticatableTrait; // ใช้ AuthenticatableTrait เพื่อรองรับการเข้าสู่ระบบของ Laravel

    // กำหนดชื่อของตารางในฐานข้อมูล (ถ้าชื่อตารางไม่ตรงกับชื่อ Model)
    protected $table = 'useremployee';

    protected $primaryKey = 'emp_id'; // ระบุ Primary Key ที่ถูกต้อง
    public $timestamps = true; // หรือ false ถ้าไม่มี created_at และ updated_at

    // กำหนดคอลัมน์ที่สามารถทำการกรอกข้อมูลได้ (เพื่อป้องกัน Mass Assignment)
    protected $fillable = [
          'empname',
          'email',
          'first_name',
          'last_name',
          'address',
          'phone_number',
          'position',
          'start_date',
          'salary',
          'password', // เพิ่ม password ใน fillable
          'education_level', // ✅ ตรวจสอบว่ามีค่านี้
          'image_profile'
    ];

    // // กำหนดคอลัมน์ที่ต้องการทำการเข้ารหัส (เช่น password)
    // protected $hidden = [
    //     'password',
    //     'remember_token'
    // ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        Log::info('Log getAuthPassword password: ', ['password' => $this->password]);
        return $this->password; // ดึงค่ารหัสผ่านที่เก็บในฐานข้อมูล
    }

    public function seller()
    {
        // เชื่อมโยงกับ seller_id ใน sellers
        return $this->hasOne(Seller::class, 'seller_id', 'emp_id'); //emp_id
    }
    
    public function setEducationLevelAttribute($value)
    {
        $this->attributes['education_level'] = $value ?? 'Not specified';
    }


}
