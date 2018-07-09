<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Controllers\Excel;
use DB;
//use PDO;

class Importar extends Controller
{
    public function getIndex(){

		//\DB::connection()->getPdo()
        //$pdo = new PDO('mysql:host=localhost;dbname=Telessaude-sespe','root','',[ PDO::MYSQL_ATTR_LOCAL_INFILE => true ]);
        $pdo = DB::connection()->getPdo();
        $pdo->exec("
            LOAD DATA LOCAL INFILE 'E:/xampp/htdocs/plataforma/storage/app/public/Import/usuarios.csv'
            INTO TABLE imports
            FIELDS TERMINATED BY ';'
            IGNORE 1 ROWS
            (`cpf`, `name`); 
            SET created_at = now(), 
                updated_at = now()");
            return redirect()
            				->back()
            				->with('success', 'Usuarios Adicionados com Sucesso.');
    }
}