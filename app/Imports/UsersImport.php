<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      //dd($row['cpf']);

        return new User([
           'cpf'     => $row['cpf'],
           'name'    => $row['nome'], 
           'email'   => $row['email'],
           'cns'     => $row['cns'], 
           'nacionalidade'   => $row['nacionalidade'],
           'data_nascimento'   => $row['data_nascimento'],
           'sexo'   => $row['sexo'],
           'telefone_residencial'   => $row['telefone_residencial'],
           'telefone_celular'   => $row['telefone_celular'],
           'conselho'   => $row['conselho'], 
           'num_conselho'   => $row['num_conselho'], 
           'razao_social'   => $row['razao_social'], 
           'nome_fantasia'   => $row['nome_fantasia'], 
           'cnes'   => $row['cnes'], 
           'cnpj'   => $row['cnpj'], 
           'cep'   => $row['cep'], 
           'logradouro'   => $row['logradouro'], 
           'uf'   => $row['uf'], 
           'cidade'   => $row['cidade'], 
           'cbo_codigo'   => $row['cbo_codigo'], 
           'especialidade'   => $row['especialidade'], 
           'ocupacao'   => $row['ocupacao'], 
           'nome_cargo'   => $row['cargo'], 
           'ine'   => $row['ine'],
           'password'   => bcrypt('123')
        ]);
    }
}
