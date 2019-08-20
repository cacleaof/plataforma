<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\Diario;
use App\Models\file;
use DB;

class ProjControl extends Controller
{
    public function diario(task $task, project $project, Request $request, Diario $diario)
    {
    //$tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'projects.date_ini', 'projects.date_fim', 'projects.duracao', 'tasks.task', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id')->paginate(4);  


    if(!empty($request->projeto)) {
    $projects = Project::where('gerente', auth()->user()->id)
                ->where('id' , $request->projeto)->paginate(6);
    $tarefas = Task::where('user_id', auth()->user()->id)
                ->where('proj_id' , $request->projeto)->paginate(6);
    }
    else {
    $projects = $project->all();
    $tarefas = $task->all();
    }

    /*<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> */


    if(!empty($request->dia)) {
    $dia = $request->dia;
    $ini = $request->ini;
    $fim = $request->fim;
    $diarios = Diario::where('user_id', auth()->user()->id)
                ->where('date' ,$dia)->paginate(6);
    }
    else {
    $diarios = Diario::where('user_id', auth()->user()->id)->paginate(6);
    $dia = null;
    $ini = null;
    $fim = null;
    }
    //$diarios = diario::select('projects.projeto', 'diarios.date', 'diarios.task_id', 'diarios.detalhe', 'diarios.ini', 'diarios.fim', 'tasks.task')->join('projects', 'diarios.proj_id', 'projects.id')->join('tasks', 'diarios.task_id', 'tasks.id')->paginate(5);
    
    $users = DB::table('users')->paginate(4);

     //$diarios = auth()->user()->diarios()->get();


     //$pv = $diario->project()->get()->first();
     
     //dd($diarios);

     //$diarios = Diario::where('user_id', auth()->user()->id);
       //dd($diarios);
     //$horaini = '7:00';

     //if(!empty($request->h_ini)) {
     
    //$horaini = $request->h_ini;
    // } <input type="hidden" name="h_ini" value="8:00">

        return view('admin.proj.diario', compact('tarefas', 'projects', 'users', 'diarios', 'dia', 'ini', 'fim'));
    }
     public function store(Request $request)
    {
    if(!empty($request->tarefa)) {
        $arquivos = $request->file('arquivo');
        $dataForm = new Diario;
        $dataForm->proj_id = $request->projeto;
        $dataForm->task_id = $request->tarefa;
        $dataForm->ativo = $request->ativo;
        $dataForm->detalhe = $request->detalhe;
        $dataForm->date = $request->date;
        $dataForm->ini = $request->ini;
        $dataForm->fim = $request->fim;
        $nome = $request->file;
        $dataForm->user_id = auth()->user()->id;
        $dataForm->save();
        $idc = $dataForm->id;
        if(!empty($arquivos)):
                $dataForm->anexos = '1';
                $dataForm->update();
            foreach ($arquivos as $arquivo):

                $data = new file;
                $data->diario_id = $idc;
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
                    ->route('admin.proj.task')
                    ->with('success', 'TeleConsultoria enviada com sucesso - Prazo Máximo de Retorno 72 horas');
    }
    else {
        return redirect()
                    ->back()
                    ->with('error', 'O campo descreva sua dúvida ou questionamento deve ser preenchido para envio da consultoria');
    }
    }
    public function status_task(Task $task, Project $project, Request $request)
    {
    $tarefas = project::select('projects.projeto', 'projects.proj_detalhe' , 'tasks.task', 'tasks.detalhe', 'tasks.proj_id')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(4);  

        //dd($tarefas);
        //if(!empty($request->projeto)) {

       // $projeto = $request->projeto;
       // }
        
        $projects = DB::table('projects')->paginate(4);

        return view('admin.proj.status_task', compact('tarefas', 'projects'));
    }

    public function status_proj(Task $task, Project $project)
    {
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'tasks.task', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(4);  

        //dd($tarefas);
        $projects = DB::table('projects')->paginate(4);

        return view('admin.proj.status_proj', compact('tarefas', 'projects'));
    }

    public function task(Task $task, Project $project)
    {
        $taref = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'tasks.task', 'tasks.detalhe', 'tasks.urg')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(4);  

        
        $projects = DB::table('projects')->paginate(4);

        $tarefas = $taref->sortByDesc('urg');

        //dd($tarefas);

        return view('admin.proj.entrada', compact('tarefas', 'projects'));
    }

    public function n_proj(Task $task, Project $project)
    {
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'tasks.task', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(4);  

         $users = DB::table('users')->paginate(4);

        //dd($users);

        return view('admin.proj.n_proj', compact('tarefas', 'users'));
    }
    public function n_task(task $task, project $project)
    {
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'projects.date_ini', 'projects.date_fim', 'projects.duracao', 'tasks.task', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(4);  

    $projects = $project->all();

     $users = DB::table('users')->paginate(4);
    //dd($projects);

        return view('admin.proj.n_task', compact('tarefas', 'projects', 'users'));
    }
    public function store_p(Request $request)
    {
    if(!empty($request->projeto)) {
        $dataForm = new Project;
        $dataForm->projeto = $request->projeto;
        $dataForm->gerente = $request->gerente;
        $dataForm->proj_detalhe = $request->detalhe;
        $dataForm->date_ini = $request->inicio;
        $dataForm->date_fim = $request->fim;
        $dataForm->duracao = $request->duracao;
        $dataForm->save();

        return redirect()
                    ->route('admin.proj.task')
                    ->with('success', 'Projeto enviado com sucesso');
    }
    else {
        return redirect()
                    ->back()
                    ->with('error', 'Os campos do Projeto devem ser preenchidos');
    }
    }
    public function store_t(Request $request)
    {
        if(!empty($request->tarefa)) {
            $dataForm = new Task;
            $dataForm->proj_id = $request->projeto;
            $dataForm->user_id = $request->gerente;
            $dataForm->detalhe = $request->detalhe;
            $dataForm->task = $request->tarefa;
            $dataForm->save();
       

        return redirect()
                    ->route('admin.proj.task')
                    ->with('success', 'Tarefa enviada com sucesso');
        }
        else {
            return redirect()
                    ->back()
                    ->with('error', 'Os campos devem ser preenchidos');
    }
    }
}
