<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Degree;
use Illuminate\Http\Request;
use validator;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('degree')->paginate(5);
        return view('students', compact('students'));
    }

    public function create()
    {
        $degrees = Degree::all();
        return view('addStudent', compact('degrees'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'f_name' => 'required|min:2',
            'm_name' => 'required|min:2',
            'l_name' => 'required|min:2',
            'e_mail' => 'required|email',
            'contac_no' => 'required',
            'username' => 'required|unique:user_accounts,username',
            'password' => 'required|min:6',
            'degree_id' => 'required|exists:degrees,id',
        ]);

        try {
            $user = UserAccount::create([
                'username' => $request->input('username'),
                'email' => $request->input('e_mail'),
                'password' => Hash::make($request->input('password')),
                'role' => 'student',
                'is_active' => 1,
            ]);

            Student::create([
                'fname' => $request->f_name,
                'mname' => $request->m_name,
                'lname' => $request->l_name,
                'email' => $request->e_mail,
                'contactInfo' => $request->contac_no,
                'degree_id' => $request->degree_id,
                'user_account_id' => $user->id,
            ]);

            return redirect()->route('students.index')->with('success', 'Student added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function show(Student $student)
    {
        return view('studentDetails', compact('student'));
    }

    public function edit(Student $student)
    {
        $degrees = Degree::all();
        return view('editStudent', compact('student', 'degrees'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'f_name' => 'required|min:2',
            'm_name' => 'required|min:2',
            'l_name' => 'required|min:2',
            'e_mail' => 'required|email',
            'contac_no' => 'required',
            'degree_id' => 'required|exists:degrees,id',
        ]);

        $student->update([
            'fname' => $request->f_name,
            'mname' => $request->m_name,
            'lname' => $request->l_name,
            'email' => $request->e_mail,
            'contactInfo' => $request->contac_no,
            'degree_id' => $request->degree_id,
        ]);

        // Update the associated user account email
        if ($student->userAccount) {
            $student->userAccount->update([
                'email' => $request->e_mail,
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}