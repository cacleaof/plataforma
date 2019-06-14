<?php

namespace App\Imports;

use App\Models\imports;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GecadImport implements ToModel, WithHeadingRow
{
    
    public function model(array $row)
    {
        dd(new import);
        return new imports([
           'cpf'     => $row[0],
           //'nome'    => $row['nome'], 
        ]);
    }
}
