<?php

namespace App\Imports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProjImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Project([
           'projeto'      => $row['projeto'], 
           'proj_detalhe'   => $row['proj_detalhe'],
           'duracao'      => $row['duracao'], 
           'gerente'      => $row['gerente'],
           'urg'        => $row['urg'],
           'imp'        => $row['imp'],
        ]);
    }
}
