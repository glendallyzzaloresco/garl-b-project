<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use App\Models\Teacher;

class TeachersController extends Controller
{
    /**
     * Display list of all teachers
     */
    public function index()
    {
        $teachers = Teacher::with('userAccount', 'degree')->paginate(10);
        $logged_role = \Illuminate\Support\Facades\Session::get("logged_role");
        return view('teachersList', compact('teachers', 'logged_role'));
    }

    /**
     * Display a specific teacher
     */
    public function show($id)
    {
        $teacher = Teacher::with('degree')->findOrFail($id);
        $userAccount = UserAccount::findOrFail($teacher->user_account_id);
        
        // Merge the teacher details with user account data
        $teacher->username = $userAccount->username;
        $teacher->email = $userAccount->email;
        $teacher->role = $userAccount->role;
        $teacher->is_active = $userAccount->is_active;
        $teacher->created_at = $userAccount->created_at;
        $teacher->updated_at = $userAccount->updated_at;
        
        return view('teacherDetails')->with('teacher', $teacher);
    }

    /**
     * Show the edit form for a specific teacher
     */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $degrees = \App\Models\Degree::orderBy('degree_title')->get();
        return view('editTeacher')->with(compact('teacher', 'degrees'));
    }

    /**
     * Update a specific teacher
     */
    public function update(Request $request, $id)
    {
        // $id is the Teacher ID from the AJAX call
        $teacher = Teacher::findOrFail($id);
        
        // Validate the request
        $validated = $request->validate([
            'f_name' => 'required|string|min:2',
            'm_name' => 'nullable|string|min:1',
            'l_name' => 'required|string|min:2',
            'e_mail' => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone' => 'nullable|string',
            'department' => 'nullable|string',
            'degree_id' => 'nullable|integer|exists:degrees,id',
        ]);
        
        // Update teacher fields
        $teacher->fname = $validated['f_name'];
        $teacher->mname = $validated['m_name'] ?? null;
        $teacher->lname = $validated['l_name'];
        $teacher->email = $validated['e_mail'];
        $teacher->phone = $validated['phone'] ?? null;
        $teacher->department = $validated['department'] ?? null;
        $teacher->degree_id = !empty($validated['degree_id']) ? $validated['degree_id'] : null;
        $teacher->save();
        
        // For AJAX requests, return JSON
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Updated teacher',
                'teacher' => $teacher
            ]);
        }
        
        // For browser requests, redirect with flash message
        return redirect()->route('dashboard')->with('success', 'Updated teacher');
    }

    /**
     * Delete a specific teacher
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        
        // Get the associated user account
        $userAccount = UserAccount::find($teacher->user_account_id);
        
        // Delete the teacher record
        $teacher->delete();
        
        // Delete the user account
        if ($userAccount) {
            $userAccount->delete();
        }
        
        // For AJAX requests, return JSON
        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Teacher deleted successfully'
            ]);
        }
        
        // For browser requests, redirect with flash message
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully');
    }

    /**
     * Get teacher list data for AJAX refresh
     */
    public function listData()
    {
        $teachers = Teacher::with('userAccount', 'degree')->paginate(10);
        return view('teacherListComponent', compact('teachers'))->render();
    }
}
