<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $table = 'user_activity';

    // protected $fillable = ['user_id', 'page_url', 'action', 'ip_address', 'user_agent'];
    protected $fillable = ['emp_id', 'empname', 'page_url', 'action', 'ip_address', 'user_agent']; //user_id

    // การสร้างการเชื่อมโยงกับ model `User` และ `UserEmployee`
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

}
