<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   

    public function index()
    {
        //
       
    }

    public function login(Request $request){

        // If GET request, just show the login page
        if ($request->isMethod('get')) {
            return view('loginPage');
        }

        // Check if user is locked out
        $lockout_time = Session::get('login_lockout_until');
        if ($lockout_time && time() < $lockout_time) {
            $seconds_remaining = $lockout_time - time();
            $msg = "Too many failed attempts. Please wait " . $seconds_remaining . " seconds before trying again.";
            return view('loginPage')->with(['msg' => $msg, 'is_locked_out' => true]);
        }

        // Clear lockout if time has passed
        if ($lockout_time && time() >= $lockout_time) {
            Session::forget('login_lockout_until');
            Session::forget('login_attempts');
        }

        $user_name = $request->input('username');
        $pass_word = $request->input('password');
        //$user structure yong id userm email value ng user account na nagparehas sa query ng 
//select all form where username = $user_name username - attribute of user_accounts table //$user_name laman ng input field
        $user = UserAccount::where('username', $user_name)->first();

        if ($user && Hash::check($pass_word, $user->password)) {
                // Store user information in session
                Session::put("user_id", $user->id);
                Session::put("logged_user", $user->username);
                Session::put("logged_role", $user->role);

                // Redirect based on user role
                $role = $user->role;
                
                if ($role === 'student') {
                    // Get student record and store student_id in session
                    $student = Student::where('user_account_id', $user->id)->first();
                    if ($student) {
                        Session::put("student_id", $student->id);
                        Session::save(); // Ensure session is saved before redirect
                        
                        // Check if password has been changed (for first-time login)
                        if (!$user->password_changed) {
                            return redirect()->route('user.show-change-password')->with('first_login', true);
                        }
                        
                        return redirect()->route('student.dashboard', $student->id)->with('success', 'Successfully logged in!');
                    }
                    return redirect("/dashboard");
                } elseif ($role === 'teacher') {
                    // Redirect to teacher dashboard
                    return redirect("/teacher")->with('success', 'Successfully logged in!');
                } elseif ($role === 'admin') {
                    // Redirect to admin dashboard
                    return redirect()->route('dashboard')->with('success', 'Successfully logged in!');
                }
                
                // Fallback to dashboard
                return redirect("/dashboard");
            // Clear login attempts on successful login
            // Session::forget('login_attempts');
            // Session::forget('login_lockout_until');
            
            // // Store user in session
            // Session::put('user_id', $user->id);
            // Session::put('username', $user->username);
            // Session::put('role', $user->role);
            
            // Check if password has been changed
            // if (!$user->password_changed) {
            //     // Show success message then redirect to change password
            //     return view('loginPage')->with([
            //         'login_success' => true,
            //         'redirect_url' => route('user.show-change-password'),
            //         'success_message' => 'Login successful! Redirecting to password change...'
            //     ]);
            // }
            
            // // Get the student record
            // $student = Student::where('user_account_id', $user->id)->first();
            // if ($student) {
            //     // Show success message then redirect to student profile
            //     return view('loginPage')->with([
            //         'login_success' => true,
            //         'redirect_url' => route('student.profile', $student->id),
            //         'success_message' => 'Login successful! Redirecting to your profile...'
            //     ]);
            // }
            
            // // Return login page with success flag
            // return view('loginPage')->with([
            //     'login_success' => true,
            //     'redirect_url' => '/dashboard',
            //     'success_message' => 'Login successful! Redirecting...'
            // ]);
        } else {
            $msg ="Invalid username or password.";
            Session::forget("logged_role");
            
            return view('loginPage')->with('msg', $msg);
        }


       
        // else {
        //     // Increment failed login attempts
        //     $attempts = Session::get('login_attempts', 0);
        //     $attempts++;
        //     Session::put('login_attempts', $attempts);

        //     // Check if 3 attempts reached
        //     if ($attempts >= 3) {
        //         // Set lockout time for 15 seconds
        //         Session::put('login_lockout_until', time() + 15);
        //         $msg = "Too many failed attempts. Please wait 15 seconds before trying again.";
        //         return view('loginPage')->with(['msg' => $msg, 'is_locked_out' => true]);
        //     }

        //     $attempts_left = 3 - $attempts;
        //     $msg = "Invalid username or password. (" . $attempts_left . " attempts remaining)";
        //     return view('loginPage')->with('msg', $msg);
        // }
    }
     public function SessionUserAccount(){
            Session::forget("logged_role");
            return view('manageStudents');
        }

    /**
     * Show the change password form
     */
    public function showChangePassword()
    {
        if (!Session::has('user_id')) {
            return redirect('/');
        }
        
        return view('changePassword');
    }

    /**
     * Update the user password
     */
    public function updatePassword(Request $request)
    {
        if (!Session::has('user_id')) {
            return redirect('/');
        }

        $user = UserAccount::find(Session::get('user_id'));
        $isFirstTimeLogin = !$user->password_changed;

        if ($isFirstTimeLogin) {
            // For first-time login, only validate new password
            $request->validate([
                'new_password' => [
                    'required',
                    'confirmed',
                    'min:6'
                ],
                'new_password_confirmation' => 'required'
            ]);
        } else {
            // For subsequent changes, validate all fields
            $request->validate([
                'current_password' => 'required',
                'new_password' => [
                    'required',
                    'confirmed',
                    'min:6'
                ],
                'new_password_confirmation' => 'required'
            ]);

            // Check if current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            // Check if new password is different from current
            if (Hash::check($request->new_password, $user->password)) {
                return back()->withErrors(['new_password' => 'New password must be different from current password']);
            }
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password),
            'password_changed' => true
        ]);

        // Get the student record
        $student = Student::where('user_account_id', $user->id)->first();
        
        if ($student) {
            // Clear the session to refresh user data
            Session::forget('password_changed');
            Session::save();
            
            $message = $isFirstTimeLogin ? 'Welcome! Your password has been set successfully.' : 'Password updated successfully!';
            return redirect()->route('student.dashboard', $student->id)->with('success', $message);
        }

        return redirect('/dashboard')->with('success', 'Password updated successfully!');
    }

    /**
     * Create a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Show student profile
     */
    public function showStudentProfile(Student $student)
    {
        if (Session::get('user_id') !== $student->user_account_id) {
            return redirect('/');
        }
        
        return view('studentProfile', compact('student'));
    }

    /**
     * Logout the user
     */
    public function logout(Request $request)
    {
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')
            ->with('success', 'You have been logged out successfully.')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }
}
