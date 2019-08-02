<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\User;
//use storage\app\public\Import\usuarios;
use DB;
//use PDO;

class Importar extends Controller
{
    public function tarefas()
    {
        //$consults = $consult->all();

        return view('admin.importar.tarefas');
    } 
    public function save_tarefas(Request $request)
    {
      $arquivo = $request->file('arquivo');
         
    if(!empty($arquivo)) {

        //$dataForm->save();
        
        Storage::putfileAs('Import', $arquivo, 'tarefas.csv');

        return redirect()
                    ->route('consult.entrada')
                    ->with('success', 'Arquivo de tarefas salvo! Você precisa agora importar os dados');
    }
    else {
        return redirect()
                    ->back()
                    ->with('error', 'Não anexou o arquivo');
    }
    }
    public function getIndex(){ 

        //DD("oi");
        try{   
    Excel::import(new UsersImport, 'Import\usuarios.csv', null, \Maatwebsite\Excel\Excel::CSV);

    return redirect('/admin')
            ->with('success', 'Arquivo de Usuários foi Importado');
            }
     catch(\Exception $e){
     $ec = $e->getCode();

     switch ($ec) {
    case "23000":
        return redirect('/admin')
            ->with('error', 'O Arquivo não foi importado, pois tem usuário que já está cadastrado ou com o mesmo CPF. Tipo de erro número: '.$ec);
        break;
    
    default:  
        return redirect('/admin')
            ->with('error', 'Arquivo não foi Importado, pois está fora do padrão aceito.  Erro número: '.$ec);
                    }    
                        }
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