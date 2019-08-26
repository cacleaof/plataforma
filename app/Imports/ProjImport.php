<?php

namespace App\Imports;

use App\Models\Task;
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
           //'id'     => $row['id'],
           'task'      => $row['task'], 
           'detalhe'   => $row['detalhe'],
           'date_ini'     => $row['date_ini'], 
           'date_fim'   => $row['date_fim'],
           'prevdias'   => $row['prevdias'],
          // 'created_at'     => $row['created_at'],
          // 'updated_at'     => $row['updated_at'],
           'proj_id'   => $row['proj_id'],
        ]);
    }
}
