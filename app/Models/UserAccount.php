<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $table = 'user_accounts';
    
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'is_active',
        'avatar',
        'password_changed'
    ];
    
    public $timestamps = true;

    public function student(){
        return $this->hasOne(Student::class);
    }

    public function teacher(){
        return $this->hasOne(Teacher::class);
    }
}
