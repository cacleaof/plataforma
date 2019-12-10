<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TaskExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Task::all();
    }
    public function headings(): array
    {
        return [
            //'id',
            'text',
            'detalhe',
            'start_date',
            'date_fim',
            'duration',
            'urg',
            'imp',
            'created_at',
            'updated_at',
            'proj_id',
        ];
    }
}