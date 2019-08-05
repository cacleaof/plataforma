<?php

namespace App\Exports;

use App\Models\Dependencia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DepExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Dependencia::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'task_id',
            'antes',
        ];
    }
}
