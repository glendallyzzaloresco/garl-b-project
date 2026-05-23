<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Nette\Utils\Image as UtilsImage;
use Intervention\Image\ImageManagerStatic as ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PagesController extends Controller
{

    // public function browseImage()
    // {
    //     return view('browseImage');
    // }
    // public function uploadImage(Request $request)
    // {
    //     $request->validate(['image' => 'required|image|']);
    //     $image =$request->file('image');
    //     $manager = new UtilsImage(new Driver());
    //     $img =$manager->read($image);
    //     $img->resize(300, 300);
    //     $filename = time().".jpg";
    //     $path = public_path('uploads');

    //     if (!file_exists($path)) {
    //         mkdir($path, 0755, true);
    //     }
    //     $img->save($path.'/'.$filename);
    //     return back()->with('success', 'Image uploaded successfully')->with('image', $filename);

        
        

      
    // }   
    /**
     * Student Dashboard
     */
    public function studentDashboard($studentId = null)
    {
        // Get the student from session or parameter
        if (!$studentId) {
            $user_id = Session::get('user_id');
            $student = Student::where('user_account_id', $user_id)->first();
        } else {
            $student = Student::find($studentId);
        }
        
        if (!$student) {
            return redirect('/')->with('error', 'Student not found');
        }
        
        return view('studentDashboard', compact('student'));
    }

    /**
     * Teacher Dashboard
     */
    public function teacherDashboard()
    {
        $user_id = Session::get('user_id');
        $teacher = UserAccount::find($user_id);
        
        if (!$teacher || $teacher->role !== 'teacher') {
            return redirect('/')->with('error', 'Unauthorized access');
        }
        
        return view('teacherDashboard', compact('teacher'));
    }

    /**
     * Admin Dashboard
     */
    public function adminDashboard()
    {
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $students = Student::with('degree')->paginate(10);
        $teachers = Teacher::with('userAccount')->paginate(10);
        return view('adminDashboard', compact('totalStudents', 'totalTeachers', 'students', 'teachers'));
    }

    /**
     * Show create teacher form
     */
    public function createTeacher()
    {
        return view('addTeacher');
    }

    /**
     * Store new teacher
     */
    public function storeTeacher(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|min:2',
            'mname' => 'nullable|min:1',
            'lname' => 'required|min:2',
            'email' => 'required|email|unique:user_accounts,email',
            'contact_no' => 'required|digits:11',
            'username' => 'required|string|min:3|unique:user_accounts,username',
            'password' => 'required|string|min:6',
        ]);

        try {
            // Create user account
            $user = UserAccount::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => 'teacher',
                'is_active' => 1,
                'password_changed' => false,
            ]);

            // Create teacher record
            $teacher = Teacher::create([
                'user_account_id' => $user->id,
                'fname' => $request->input('fname'),
                'mname' => $request->input('mname'),
                'lname' => $request->input('lname'),
                'email' => $request->input('email'),
                'phone' => $request->input('contact_no'),
            ]);

            // Return JSON for AJAX requests
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Teacher added successfully!',
                    'teacher' => $teacher
                ], 201);
            }

            return redirect('/dashboard')->with('success', 'Teacher added successfully!');
        } catch (\Exception $e) {
            // Return JSON error for AJAX requests
            if ($request->expectsJson() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error creating teacher: ' . $e->getMessage(),
                    'errors' => ['general' => $e->getMessage()]
                ], 422);
            }

            return redirect()->back()->with('error', 'Error creating teacher: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show create admin form
     */
    public function createAdmin()
    {
        return view('addAdmin');
    }

    /**
     * Store new admin
     */
    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|min:2',
            'lname' => 'required|min:2',
            'email' => 'required|email|unique:user_accounts,email',
            'contact_no' => 'required|digits:11',
            'username' => 'required|string|min:3|unique:user_accounts,username',
            'password' => 'required|string|min:6',
        ]);

        try {
            $user = UserAccount::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => 'admin',
                'is_active' => 1,
                'password_changed' => false,
            ]);

            return redirect('/dashboard')->with('success', 'Admin added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating admin: ' . $e->getMessage())->withInput();
        }
    }

    public function userProfile()
    {
        $user = User::find(1);
        return view('user_profile', compact('user'));
    }

    public function userPosts()
    {
        $user = User::find(1);
        return view('user_posts', compact('user'));
    }
    public function studentCourses()
    {
        $student = Student::find(2);
        foreach($student->courses as $course) {
            echo "$student->fname $student->lname is enrolled in: $course->course_name<br>";
        }
    }
    public function maintenance()
    {
        return view('maintenance');
    }
    //view next act
    public function demo()
    {
        return view('demo');
    }
}
