<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use DB;

class ProjControl extends Controller
{
    public function diario(task $task, project $project)
    {
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'projects.date_ini', 'projects.date_fim', 'projects.duracao', 'tasks.task', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(4);  

    $projects = $project->all();

     $users = DB::table('users')->paginate(4);
    //dd($projects);

        return view('admin.proj.diario', compact('tarefas', 'projects', 'users'));
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
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'tasks.task', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(4);  

        //dd($tarefas);
        $projects = DB::table('projects')->paginate(4);

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
