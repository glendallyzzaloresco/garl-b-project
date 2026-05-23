<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'contactInfo',
        'degree_id',
        'user_account_id'
    ];

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course__students', 'student_id', 'course_id');
    }
    public function degrees()
    {
        return $this->belongsToMany(Degree::class);
    }
    public function userAccount(){
        return $this->belongsTo(UserAccount::class);
    }
}