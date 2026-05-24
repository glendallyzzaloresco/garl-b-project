<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Degree;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Log;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Course;

class StudentsController extends Controller
{
    /**
     * Display student list
     */

    public function manageStudents()
    {
        $students = Student::paginate(5);
        $logged_role = Session::get("logged_role");
        return view('students', compact('students', 'logged_role'));
    }

    public function index()
    {

        if (Session::get('logged_role') === 'teacher') {
            return redirect()->route('teacher.dashboard');
        }

        $students = Student::with(['degree', 'userAccount'])->paginate(10);
        $logged_role = Session::get("logged_role");

        return view('students', compact('students', 'logged_role'));
    }

    /**
     * Sow add student form
     */
    public function create()
    {
        $degrees = Degree::all();
        $courses = Course::query()->orderBy('course_name')->get();
        return view('addstudent')->with('degrees', $degrees)->with('courses', $courses);
    }

    /**
     * Store new student
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|min:2',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|min:2',
            'email' => 'required|email',
            'contactInfo' => 'required|digits:11',
            'degree_id' => 'required|exists:degrees,id',
            'username' => 'required|string|min:3|unique:user_accounts,username',
            'password' => 'required|string|min:6',
            'course_ids' => 'nullable|array',
            'course_ids.*' => 'integer|exists:courses,id',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $result = DB::transaction(function () use ($request) {
                $user = UserAccount::create([
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'role' => 'student',
                    'is_active' => 1,
                    'password_changed' => false,
                ]);

                $student = Student::create([
                    'user_account_id' => $user->id,
                    'fname' => $request->fname,
                    'mname' => $request->input('mname') ?? '',
                    'lname' => $request->lname,
                    'email' => $request->input('email'),
                    'contactInfo' => $request->contactInfo,
                    'degree_id' => $request->input('degree_id'),
                ]);

                $courseIds = $request->input('course_ids', []);
                if (is_array($courseIds) && count($courseIds) > 0) {
                    $student->courses()->sync($courseIds);
                }

                return true;
            });

            Log::info('Student added successfully. Username: ' . $request->username);

            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Student added successfully!'
                ], 201);
            }

            return redirect("/students")->with('success', 'Student added successfully!');
        } catch (\Exception $e) {
            Log::error('Student creation error: ' . $e->getMessage());
            
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error creating student: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Error creating student: ' . $e->getMessage())->withInput();
        }
    
        // $student = new Student;

        // $student->fname = $request->f_name;
        // $student->mname = $request->m_name;
        // $student->lname = $request->l_name;
        // $student->email = $request->e_mail;
        // $student->contactInfo = $request->contac_no;
        // $student->degree_id = $request->degree_id;

        // $student->save();

        // return redirect('/students')->with('success', 'Student added successfully');
    }

    public function show(Student $student)
    {
        return view ('studentDetails')->with('student', $student);
    }

    public function edit(Student $student)
    {
        $degrees = Degree::all();
        Log::info('Student edit form opened.');
        return view ('editStudent')->with('student', $student)->with('degrees', $degrees);
        
    }

    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required|min:2',
            'm_name' => 'nullable|string|max:255',
            'l_name' => 'required|min:2',
            'e_mail' => [
                'required',
                'email',
            ],
            'contac_no' => 'required|numeric',
            'degree_id' => 'required|exists:degrees,id',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors() 
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student->fname = $request->f_name;
        $student->mname = $request->m_name;
        $student->lname = $request->l_name;
        $student->email = $request->e_mail;
        $student->contactInfo = $request->contac_no;
        $student->degree_id = $request->degree_id;
        $student->save();

        
        if ($student->userAccount) {
            $student->userAccount->email = $request->e_mail;
            $student->userAccount->save();
        }

        Log::info('Student updated successfully.');

        if ($request->expectsJson() || $request->wantsJson()) {
            $student->load('degree');
            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully',
                'student' => $student,
            ]);
        }

        return redirect('/dashboard');
    }

    public function destroy(Student $student)
    {
        try {
            // Delete related course enrollments first
            if ($student->courses) {
                $student->courses()->detach();
            }
            
            // Delete the student
            $student->delete();
            
            
            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully'
            ], 200);
            
        } catch (\Exception $e) {
            Log::error('Student deletion error: ' . $e->getMessage());
            
            
            return response()->json([
                'success' => false,
                'message' => 'Error deleting student: ' . $e->getMessage()
            ], 500);
        }
    }
    public function listData()
    {
        $students = Student::all();
        return view('studentList', compact('students'))->render();
    }
}
