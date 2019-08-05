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
            'task',
            'detalhe',
            'date_ini',
            'date_fim',
            'prevdias',
            'created_at',
            'updated_at',
            'proj_id',
        ];
    }
}