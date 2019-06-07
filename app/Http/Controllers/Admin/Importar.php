<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
//use App\Http\Controllers\Excel;
use DB;
//use PDO;

class Importar extends Controller
{
    public function getIndex(){

		//\DB::connection()->getPdo()
        //$pdo = new PDO('mysql:host=localhost;dbname=Telessaude-sespe','root','',[ PDO::MYSQL_ATTR_LOCAL_INFILE => true ]);
        //dd(storage_path()); "email","cns","nacionalidade","data_nascimento","sexo","telefone_residencial","telefone_celular","conselho","num_conselho","razao_social","nome_fantasia","cnes","cnpj","cep","logradouro","uf","cidade","cbo_codigo","especialidade","ocupacao","cargo","ine"
        $url_storage = str_replace("\\","/",storage_path());
        $pdo = DB::connection()->getPdo();
        $pdo->exec('
            LOAD DATA LOCAL INFILE "'.$url_storage.'/app/public/Import/usuarios.csv"
            INTO TABLE imports
            FIELDS TERMINATED BY ","
            ENCLOSED BY ""
            IGNORE 1 ROWS
            ("cpf", "nome"); 
            SET created_at = now(), 
                updated_at = now()');
            return redirect()
            				->back()
            				->with('success', 'Usuarios Adicionados com Sucesso.');
    }
    public function usuarios()
    {
        //$consults = $consult->all();

        return view('admin.importar.usuarios');
    } 
    public function save_usuarios(Request $request)
    {
      $arquivo = $request->file('arquivo');
         
    if(!empty($arquivo)) {

        //$dataForm->save();
        
        Storage::putfileAs('Import', $arquivo, 'usuarios.csv');

        return redirect()
                    ->route('consult.entrada')
                    ->with('success', 'Arquivo de usuários salvo! Você precisa agora importar os dados');
    }
    else {
        return redirect()
                    ->back()
                    ->with('error', 'Não anexou o arquivo');
    }
    }
    public function regular(consult $consult, Request $request, Perfil $perfil, User $user, file $file, Especialidade $especialidade, Profissoe $profissoe)
    {
        $sid = $request->sid;
        $files = $file->where('consult_id', $sid)->get();
        $consults = $consult->where('id', $request->sid)->get();
        
        $solRs = $perfil->where('perfil', 'C')->get($perfil->user_id);
        
        $users = $user->all();
        $especialidades = $especialidade->all();
        $profissoes = $profissoe->all();

        $downloads=DB::table('files')->get();
        
        return view('admin.consult.regular', compact('consults', 'solRs', 'users', 'sid', 'cid', 'files', 'downloads', 'especialidades', 'profissoes'));
    } 
}