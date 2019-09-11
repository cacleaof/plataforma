<?php

namespace App\Imports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class TasksImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      
                        
        return new Task([
           'task'      => $row['task'], 
           'detalhe'   => $row['detalhe'],
           'date_ini'   => Carbon::now(),
           'date_fim'   => Carbon::now(),
          // 'date_ini'   => $row['date_ini'],
          // 'date_fim'   => $row['date_fim'],
           'prevdias'   => $row['prevdias'],
           'urg'        => $row['urg'],
           'imp'        => $row['imp'],
           'proj_id'   => $row['proj_id'],
           'user_id'   => $row['usuario']
        ]);
    }
}
