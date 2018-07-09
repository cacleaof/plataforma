<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Controllers\Excel;
use DB;

class Importar extends Controller
{
    public function getIndex(){

		\DB::connection()->getPdo()
            ->exec("
            LOAD DATA LOCAL INFILE '/Users/usuarios.csv'
            INTO TABLE imports
            FIELDS TERMINATED BY ';'
            IGNORE 1 ROWS
            (`cpf`, `name`); ");
    
            return redirect()
            				->back()
            				->with('success', 'Usuarios Adicionados com Sucesso.');
    }
}