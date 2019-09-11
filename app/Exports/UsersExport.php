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
            'id',
            'admin',
            'criado',
            'updated',
            'cpf',
            'nome',
            'email',
            'cns',
            'nacionalidade',
            'nascimento',
            'sexo',
            'telefone',
            'celular',
            'conselho',
            'numero',
            'razão social',
            'nome fantasia',
            'cnes',
            'cnpj',
            'cep',
        ];
    }
}
