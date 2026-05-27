<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Teacher;
use App\Models\Student;


class PDFController extends Controller
{
    public function generatePDF() {
        $data = [
            'title' => 'Student Report',
            'date' => now()
        ];
        $pdf = Pdf::loadView('pdf.report', $data);

        return $pdf->download('report.pdf');
    }

    public function exportTeachersPDF() {
        $teachers = Teacher::with('userAccount')->get();
        
        $data = [
            'title' => 'Teachers Report',
            'teachers' => $teachers,
            'date' => now()
        ];
        
        $pdf = Pdf::loadView('pdf.teachers-report', $data);
        return $pdf->download('teachers-report.pdf');
    }

    public function exportStudentsPDF() {
        $students = Student::with('degree', 'userAccount')->get();
        
        $data = [
            'title' => 'Students Report',
            'students' => $students,
            'date' => now()
        ];
        
        $pdf = Pdf::loadView('pdf.students-report', $data);
        return $pdf->download('students-report.pdf');
    }
}
