<?php

namespace App\Exports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarsDataExport implements FromCollection,ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Car::all();
    }
    public function headings(): array
    {
        return [
            'ID', 'Name', 'Email', 'Email Verified At','Created At', 'Updated At', 'Phone'
        ];
    }
}
