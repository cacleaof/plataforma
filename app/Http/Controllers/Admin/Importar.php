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
            LOAD DATA LOCAL INFILE 'C:/xampp/htdocs/plataforma/storage/app/public/Import/usuarios.csv'
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
    public function usuarios(Consult $consult)
    {
        $consults = $consult->all();

        return view('admin.import.usuarios', compact('consults'));
    } 
    public function save_usuarios(Request $request)
    {
    if(!empty($request->consulta)) {
        $arquivos = $request->file('arquivo');
        
        $dataForm->save();
        $idc = $dataForm->id;
        if(!empty($arquivos)):
                $dataForm->anexos = '1';
                $dataForm->update();
            foreach ($arquivos as $arquivo):

                $data = new file;
                $data->consult_id = $idc;
                $data->size = $arquivo->getClientSize();
                $nome = $arquivo->getClientOriginalName();
                $nome = $idc.$nome;
                $data->file = $nome;
                $data->save();
                Storage::putfileAs($dataForm->user_id, $arquivo, $nome);
            endforeach;
        endif;

        return redirect()
                    ->route('consult.entrada')
                    ->with('success', 'TeleConsultoria enviada com sucesso - Prazo Máximo de Retorno 72 horas');
    }
    else {
        return redirect()
                    ->back()
                    ->with('error', 'O campo descreva sua dúvida ou questionamento deve ser preenchido para envio da consultoria');
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