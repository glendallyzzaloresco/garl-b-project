<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';

    protected $fillable = [
        'user_account_id',
        'fname',
        'mname',
        'lname',
        'email',
        'phone',
        'department',
        'qualifications',
        'degree_id',
    ];

    public $timestamps = true;

    /**
     * Get the user account associated with the teacher
     */
    public function userAccount()
    {
        return $this->belongsTo(UserAccount::class, 'user_account_id');
    }

    /**
     * Get the degree associated with the teacher
     */
    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }
}
