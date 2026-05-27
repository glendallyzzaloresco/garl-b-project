<?php

namespace App\Exports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TeachersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Teacher::with('userAccount')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'First Name',
            'Middle Name',
            'Last Name',
            'Email',
            'Phone',
            'Is Active',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->f_name,
            $row->m_name,
            $row->l_name,
            $row->userAccount->email ?? 'N/A',
            $row->phone ?? 'N/A',
            $row->is_active ? 'Active' : 'Inactive',
        ];
    }
}
