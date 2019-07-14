<?php

namespace App\Exports;

use app\models\user;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
    public function headings(): array
    {
        return [
            'cpf',
            'name',
            'email',
            'cns',
            'telefone_residencial',
            'telefone_celular',
            'conselho',
            'num_conselho',
            'razao_social',
            'nome_fantasia',
        ];
    }
}
