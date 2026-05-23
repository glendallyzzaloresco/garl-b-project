<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DegreeController extends Controller
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

    /**
     * Display a listing of the degrees.
     */
    public function index()
    {
        $degrees = Degree::all();
        return view('degrees', compact('degrees'));
    }

    /**
     * Show the form for creating a new degree.
     */
    public function create()
    {
        return view('addDegree');
    }

    /**
     * Store a newly created degree in database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'degree_title' => 'required|string|max:255',
        ]);

        Degree::create([
            'degree_title' => $request->degree_title,
        ]);

        $this->logAllLevels('Degree added successfully.');

        return redirect('/degrees')->with('success', 'Degree added successfully');
    }

    /**
     * Display the specified degree.
     */
    public function show(Degree $degree)
    {
        return view('showDegree', compact('degree'));
    }

    /**
     * Show the form for editing the specified degree.
     */
    public function edit(Degree $degree)
    {
        $this->logAllLevels('Degree edit form opened.');
        return view('editDegree', compact('degree'));
        
    }

    /**
     * Update the specified degree in database.
     */
    public function update(Request $request, Degree $degree)
    {
        $request->validate([
            'degree_title' => 'required|string|max:255',
        ]);

        $degree->update([
            'degree_title' => $request->degree_title,
        ]);

        $this->logAllLevels('Degree updated successfully.');

        return redirect('/degrees')->with('success', 'Degree updated successfully');
    }

    /**
     * Remove the specified degree from database.
     */
    public function destroy(Degree $degree)
    {
        $degree->delete();
        $this->logAllLevels('Degree deleted successfully.');
        return redirect('/degrees')->with('success', 'Degree deleted successfully');
    }
}
