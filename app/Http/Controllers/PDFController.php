<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


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
}
