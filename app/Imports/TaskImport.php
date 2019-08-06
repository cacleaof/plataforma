<?php

namespace App\Imports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\ToModel;

class TaskImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Task([
            //'id'      => $nid,
            'task'      => $row[0],
            'detalhe'   => $row[1],
            'proj_id'   => $row[2],
        ]);
    }
}
