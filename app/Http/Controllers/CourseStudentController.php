<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Course_Student;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{
    // Display all courses with enrolled students count
    public function index()
    {
        $courses = Course::with(['teacher', 'degree'])
            ->withCount('students')
            ->orderBy('course_name')
            ->get()
            ->groupBy(function($course) {
                return $course->degree ? $course->degree->degree_title : 'Other';
            });
        
        return view('courseStudents.index', [
            'courses' => $courses,
        ]);
    }

    // Display all students with their enrolled courses
    public function studentsList()
    {
        $students = Student::with('courses', 'degree')->orderBy('fname')->get();
        $courses = Course::orderBy('course_name')->get();
        
        return view('courseStudents.studentsList', [
            'students' => $students,
            'courses' => $courses,
        ]);
    }

    // Show students enrolled in a specific course
    public function show(Course $course)
    {
        $enrolledStudents = $course->students()->get();
        $allStudents = Student::orderBy('fname')->get();
        $enrolledStudentIds = $enrolledStudents->pluck('id')->toArray();
        
        return view('courseStudents.show', [
            'course' => $course,
            'enrolledStudents' => $enrolledStudents,
            'allStudents' => $allStudents,
            'enrolledStudentIds' => $enrolledStudentIds,
        ]);
    }

    // Show form to assign courses to a student
    public function assignCourses(Student $student)
    {
        $enrolledCourses = $student->courses()->pluck('id')->toArray();
        $allCourses = Course::orderBy('course_name')->get();
        
        return view('courseStudents.assignCourses', [
            'student' => $student,
            'allCourses' => $allCourses,
            'enrolledCourses' => $enrolledCourses,
        ]);
    }

    // Assign a student to a course
    public function assign(Request $request, Course $course, Student $student)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Check if student is already enrolled
        $alreadyEnrolled = Course_Student::where('course_id', $course->id)
            ->where('student_id', $student->id)
            ->exists();

        if (!$alreadyEnrolled) {
            Course_Student::create([
                'course_id' => $course->id,
                'student_id' => $student->id,
            ]);
            
            return redirect()
                ->route('course-students.show', ['course' => $course->id])
                ->with('success', 'Student assigned to course successfully!');
        }

        return redirect()
            ->route('course-students.show', ['course' => $course->id])
            ->with('info', 'Student is already enrolled in this course.');
    }

    // Remove a student from a course
    public function unassign(Course $course, Student $student)
    {
        Course_Student::where('course_id', $course->id)
            ->where('student_id', $student->id)
            ->delete();

        return redirect()
            ->route('course-students.show', ['course' => $course->id])
            ->with('success', 'Student removed from course successfully!');
    }

    // Bulk assign students to a course
    public function bulkAssign(Request $request, Course $course)
    {
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:students,id',
        ]);

        $assigned = 0;
        $skipped = 0;

        foreach ($request->input('student_ids') as $studentId) {
            $alreadyEnrolled = Course_Student::where('course_id', $course->id)
                ->where('student_id', $studentId)
                ->exists();

            if (!$alreadyEnrolled) {
                Course_Student::create([
                    'course_id' => $course->id,
                    'student_id' => $studentId,
                ]);
                $assigned++;
            } else {
                $skipped++;
            }
        }

        $message = "Assigned $assigned student(s) to the course.";
        if ($skipped > 0) {
            $message .= " ($skipped already enrolled)";
        }

        return redirect()
            ->route('course-students.show', ['course' => $course->id])
            ->with('success', $message);
    }

    // Bulk assign courses to a student
    public function bulkAssignCourses(Request $request, Student $student)
    {
        $request->validate([
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        $assigned = 0;
        $skipped = 0;

        foreach ($request->input('course_ids') as $courseId) {
            $alreadyEnrolled = Course_Student::where('student_id', $student->id)
                ->where('course_id', $courseId)
                ->exists();

            if (!$alreadyEnrolled) {
                Course_Student::create([
                    'student_id' => $student->id,
                    'course_id' => $courseId,
                ]);
                $assigned++;
            } else {
                $skipped++;
            }
        }

        $message = "Assigned $assigned course(s) to the student.";
        if ($skipped > 0) {
            $message .= " ($skipped already enrolled)";
        }

        return redirect()
            ->route('course-students.studentsList')
            ->with('success', $message);
    }

    // Remove a course from a student
    public function removeCourse(Student $student, Course $course)
    {
        Course_Student::where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->delete();

        return redirect()
            ->route('course-students.studentsList')
            ->with('success', 'Course removed from student successfully!');
    }
}
