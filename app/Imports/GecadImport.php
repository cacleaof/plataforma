<?php

namespace App\Imports;

use App\import;
use Maatwebsite\Excel\Concerns\ToModel;

class GecadImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new import([
           'cpf'     => $row[0],
           'nome'    => $row[1], 
        ]);
    }
}
