<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersDataExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            'ID', 'Name', 'Email', 'Email Verified At','Created At', 'Updated At', 'Phone'
        ];
    }
}

