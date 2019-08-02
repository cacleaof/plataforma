<?php

namespace App\Exports;

use app\models\project;
use app\models\user;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use app\Project;

class ProjExport implements FromCollection, WithHeadings
{ 
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
