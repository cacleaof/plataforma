<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\task;
use App\Models\project;
use DB;

class ProjControl extends Controller
{
    public function task(task $task, project $project)
    {
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'tasks.task', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(4);  

        //dd($tarefas);
        $projects = DB::table('projects')->paginate(6);

        return view('admin.proj.entrada', compact('tarefas', 'projects'));
    }
    public function n_proj(task $task, project $project)
    {
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'tasks.task', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(4);  

        //dd($tarefas);

        return view('admin.proj.n_proj', compact('tarefas'));
    }
    public function n_task(task $task, project $project)
    {
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'tasks.task', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(4);  

        //dd($tarefas);

        return view('admin.proj.n_task', compact('tarefas'));
    }
    public function store_p(Request $request)
    {
    if(!empty($request->projeto)) {
        $dataForm = new Project;
        $dataForm->projeto = $request->projeto;
        $dataForm->proj_detalhe = $request->detalhe;
        $dataForm->save();

        return redirect()
                    ->route('admin.proj.task')
                    ->with('success', 'Projeto enviado com sucesso - Prazo Máximo de Retorno 72 horas');
    }
    else {
        return redirect()
                    ->back()
                    ->with('error', 'O campo descreva sua dúvida ou questionamento deve ser preenchido para envio da consultoria');
    }
    }
    public function store_t(Request $request)
    {
    if(!empty($request->consulta)) {
        $arquivos = $request->file('arquivo');
        $dataForm = new Consult;
        $dataForm->consulta = $request->consulta;
        $dataForm->serviço = $request->serviço;
        $dataForm->ativo = $request->ativo;
        $dataForm->paciente = $request->paciente;
        $dataForm->idade = $request->idade;
        $dataForm->queixa = $request->queixa;
        $dataForm->instituiçao = $request->instituiçao;
        $dataForm->municipio_sol = $request->municipio_sol;
        $dataForm->area = $request->area;
        $nome = $request->file;
        $dataForm->status = 'R';
        $dataForm->user_id = auth()->user()->id;
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
                $nome = $idc.'-'.$nome;
                $data->file = $nome;
                $data->user_id = auth()->user()->id;
                $data->save();
                Storage::putfileAs($dataForm->user_id.'/'.$idc, $arquivo, $nome);
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
}
