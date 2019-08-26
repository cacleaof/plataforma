<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Project::all();
    }
    public function headings(): array
    {
        return [
            'id',
            'projeto',
            'proj_detalhe',
            'duracao',
            'gerente',
            'urg',
            'imp',
            'date_ini',
            'date_fim',
        ];
    }
}
