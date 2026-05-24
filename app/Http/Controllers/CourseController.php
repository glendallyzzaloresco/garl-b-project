<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    private function logAllLevels(string $message): void
    {
        Log::info($message);
        Log::notice($message);
        Log::alert($message);
        Log::emergency($message);
        Log::critical($message);
        Log::error($message);
        Log::warning($message);
    }

    public function index()
    {
        $courses = Course::query()->orderBy('course_name')->get();
        return view('courses', compact('courses'));
    }

    public function create()
    {
        return view('addCourse');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255|unique:courses,course_name',
        ]);

        Course::create($validated);
        $this->logAllLevels('Course added successfully.');

        return redirect('/courses')->with('success', 'Course added successfully');
    }

    public function edit(Course $course)
    {
        $this->logAllLevels('Course edit form opened.');
        return view('editCourse', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255|unique:courses,course_name,' . $course->id,
        ]);

        $course->update($validated);
        $this->logAllLevels('Course updated successfully.');

        return redirect('/courses')->with('success', 'Course updated successfully');
    }

    public function destroy(Course $course)
    {
        // Remove enrollments first
        $course->students()->detach();
        $course->delete();

        $this->logAllLevels('Course deleted successfully.');
        return redirect('/courses')->with('success', 'Course deleted successfully');
    }
}
