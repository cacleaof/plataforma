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
            LOAD DATA LOCAL INFILE '{$this->filePath}'
            INTO TABLE Users
            FIELDS TERMINATED BY ','
            IGNORE 1 ROWS
            (
              `cpf`, `name`
            ) 
            SET created_at = now(), 
                updated_at = now(),
                deliveryverified = if(@deliveryverified = 'yes', true, deliveryverified);");
    }
    //\Excel::load('public/Users/usuarios.csv', function($reader) {

        // Getting all results
        $results = $reader->get();
        // ->all() is a wrapper for ->get() and will work the same
        $results = $reader->all();

        foreach ($results as $key => $var) {
            echo $var."<br>";
        }
    });
    	dd($results);
		$fileCSV         = Request::file('arquivo');
        $destinationPath = 'Users/';
        $fileName        = $fileCSV->getClientOriginalName();
        $fileExtension   = $fileCSV->getClientOriginalExtension();

//Nome da Class original class ImporterController extends Controller {

        # Verificar Extensão do Arquivo - Apenas .CSV
        if($fileExtension == 'csv'){
            # Faz o Upload Antes da Importação
            $fileCSV->move($destinationPath, $fileName);

            # Excel CSV To Base de Dados
            \Excel::load($destinationPath.'/'.$fileName, function($reader){
                # Lê os Dados
                $result                 = $reader->get();

                # Coloca Cada Linha Dentro de um Array
                $arrData[]              = '';
                foreach ($result as $key => $value) {
                    $arrData[] = $value[0];
                }

                # Limpa Array de Linhas Vazias
                $arrData                = array_filter($arrData);

                # Não Repete Códigos Iguais com Descrição Igual no Array
                $arrData                = array_unique($arrData);

                foreach($arrData as $foo => $linha){
                    # Explode em Array
                    $var                = explode(";", $linha);
                    $varName          	= $var[0];
                    $varCpf       		= $var[1];

                    $NUser            	= new Users;
                    $NUser->name    	= $varName;
                    $NUser->cpf   		= $varCpf;
                    $NUser->save();
                }
            });
        }
            return redirect()
            				->back()
            				->with('success', 'Usuarios Adicionados com Sucesso.');
    }
}