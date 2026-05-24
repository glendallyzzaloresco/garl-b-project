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

    public function index(Request $request)
    {
        $query = Course::query()->with('degree');
        
        // Filter by degree if provided
        if ($request->has('degree_id') && $request->degree_id != '') {
            $query->where('degree_id', $request->degree_id);
        }
        
        $courses = $query->orderBy('course_name')->get();
        $degrees = \App\Models\Degree::orderBy('degree_title')->get();
        
        return view('courses', compact('courses', 'degrees'));
    }

    public function create()
    {
        $degrees = \App\Models\Degree::orderBy('degree_title')->get();
        return view('addCourse', compact('degrees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255|unique:courses,course_name',
            'degree_id' => 'nullable|exists:degrees,id',
        ]);

        Course::create($validated);
        $this->logAllLevels('Course added successfully.');

        return redirect('/courses')->with('success', 'Course added successfully');
    }

    public function edit(Course $course)
    {
        $this->logAllLevels('Course edit form opened.');
        $degrees = \App\Models\Degree::orderBy('degree_title')->get();
        return view('editCourse', compact('course', 'degrees'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255|unique:courses,course_name,' . $course->id,
            'degree_id' => 'nullable|exists:degrees,id',
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
