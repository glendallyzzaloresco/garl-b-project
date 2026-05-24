<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentCoursesController extends Controller
{
    public function index(Student $student)
    {
        if (Session::get('user_id') !== $student->user_account_id) {
            return redirect('/');
        }

        $courses = Course::query()->orderBy('course_name')->get();
        $enrolledCourseIds = $student->courses()->pluck('id')->all();

        return view('studentCourses', [
            'student' => $student,
            'courses' => $courses,
            'enrolledCourseIds' => $enrolledCourseIds,
        ]);
    }

    public function enroll(Request $request, Student $student, Course $course)
    {
        if (Session::get('user_id') !== $student->user_account_id) {
            return redirect('/');
        }

        $alreadyEnrolled = $student->courses()
            ->where('course_id', $course->id)
            ->exists();

        if (!$alreadyEnrolled) {
            $student->courses()->attach($course->id);
        }

        return redirect()
            ->route('student.courses.index', ['student' => $student->id])
            ->with('success', 'Course enrollment updated.');
    }

    public function unenroll(Request $request, Student $student, Course $course)
    {
        if (Session::get('user_id') !== $student->user_account_id) {
            return redirect('/');
        }

        $student->courses()->detach($course->id);

        return redirect()
            ->route('student.courses.index', ['student' => $student->id])
            ->with('success', 'Course enrollment updated.');
    }
}
