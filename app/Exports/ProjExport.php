<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProjExport implements FromCollection
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
            'date_ini',
            'date_fim',
        ];
    }
}
