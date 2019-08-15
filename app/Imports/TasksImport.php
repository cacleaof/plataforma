<?php

namespace App\Imports;

use App\Models\task;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class TasksImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      
      //$tarefa = Task::where('proj_id' , $row['proj_id'])->get();
        
      //$tarefa = DB::table('tasks')->all();  
      
      //dd($tarefa);
                        
        return new Task([
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
