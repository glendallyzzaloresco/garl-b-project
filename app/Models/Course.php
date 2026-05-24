<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_name',
        'degree_id'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course__students', 'course_id', 'student_id');
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }
}
