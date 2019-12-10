<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\Diario;
use App\Models\file;
use App\Models\arquivo;
use DB;

class ProjControl extends Controller
{
    public function diario(task $task, project $project, Request $request, Diario $diario)
    {

    if(!empty($request->projeto)) {
    $projects = Project::where('gerente', auth()->user()->id)
                ->where('id' , $request->projeto)->paginate(12);
    //$tarefas = Task::where('user_id', auth()->user()->id)
                //->where('proj_id' , $request->projeto)->paginate(6);
    $tarefas = Task::where('proj_id' , $request->projeto)->paginate(12);
    $projeto = $request->projeto;
    $dia = $request->dia;
    $ini = $request->ini;
    $fim = $request->fim;
    $ndia = $request->ndia;
    $nini = $request->nini;
    $nfim = $request->nfim;
    }
    else {
    $projects = $project->all();
    $tarefas = $task->all();
    $dia = null;
    $ini = null;
    $fim = null;
    $projeto = null;
    $ndia = null;
    $nini = null;
    $nfim = null;
    }

      if(!empty($request->dia) or !empty($request->ndia)) {
    $dia = $request->dia;
    $ini = $request->ini;
    $fim = $request->fim;
    $ndia = $request->ndia;
    $nini = $request->nini;
    $nfim = $request->nfim;
    $projeto = $request->projeto;
    $diarios = Diario::where('user_id', auth()->user()->id)
                ->where('ndia' , $dia)->paginate(6);
    }
    else {
    $diarios = Diario::where('user_id', auth()->user()->id)->paginate(6);
    }
    
    $users = DB::table('users')->paginate(4);

     
    return view('admin.proj.diario', compact('tarefas', 'projects', 'users', 'diarios', 'dia', 'ini', 'fim', 'projeto', 'ndia', 'nini', 'nfim'));
       
    }
    public function store_diario(Request $request)
    {
    if(!empty($request->tarefa)) {
        $arquivos = $request->file('arquivo');
        $dataForm = new Diario;
        $dataForm->proj_id = $request->projeto;
        $dataForm->task_id = $request->tarefa;
        $dataForm->ndia = $request->ndia;
        $dataForm->ini = $request->nini;
        $dataForm->fim = $request->nfim;
        $dataForm->detalhe = $request->detalhe;
        $nome = $request->arquivo;
        $dataForm->user_id = auth()->user()->id;
        $dataForm->save();
        $idc = $dataForm->id;
        if(!empty($arquivos)):
                $dataForm->anexos = '1';
                $dataForm->update();
            foreach ($arquivos as $arquivo):
                $data = new arquivo;
                $data->diario_id = $idc;
                $data->size = $arquivo->getClientSize();
                $nome = $arquivo->getClientOriginalName();
                $nome = $idc.'-'.$nome;
                $data->arquivo = $nome;
                $data->user_id = auth()->user()->id;
                $data->save();
                Storage::putfileAs($dataForm->user_id.'/'.$idc, $arquivo, $nome);
            endforeach;
        endif;

        return redirect()
                    ->route('admin.proj.diario')
                    ->with('success', 'Atividade Concluida');
    }
    else {
        return redirect()
                    ->back()
                    ->with('error', 'Erro na entrada de dados');
    }
    }

     public function status_task(Task $task, Project $project, Request $request, User $user)
    {

    //$tarefas = project::select('projects.projeto', 'projects.proj_detalhe' , 'tasks.text', 'tasks.detalhe', 'tasks.proj_id')->join('tasks', 'tasks.proj_id', 'projects.id' );  
     $taref = project::select('projects.projeto', 'projects.proj_detalhe' , 'tasks.id', 'tasks.text', 'tasks.detalhe', 'tasks.duration', 'tasks.start_date', 'tasks.date_fim', 'tasks.imp', 'tasks.urg', 'tasks.user_id', 'tasks.proj_id')->join('tasks', 'tasks.proj_id', 'projects.id')->paginate(20);     
     $tarefas = $taref->sortByDesc('urg');

     $users = $user->all();

     //$users = DB::table('users')->paginate(12);

     $projects = DB::table('projects')->paginate(12);

        if(!empty($request->projeto)) {

        $projeto = $request->projeto;
        $taref = DB::table('tasks')->where('proj_id', $projeto)->paginate(12);
        $tarefas = $taref->sortByDesc('urg');
        }
         if(!empty($request->usuario)) {

            $usu = $request->usuario;

            $tarus = $taref->where('user_id', $usu);

            $tarefas = $tarus->sortByDesc('urg');
            
        }

        return view('admin.proj.status_task', compact('tarefas', 'projects', 'users'));
    }

    public function dep_task(Task $task, Project $project, Request $request, User $user)
    {

    //$tarefas = project::select('projects.projeto', 'projects.proj_detalhe' , 'tasks.text', 'tasks.detalhe', 'tasks.proj_id')->join('tasks', 'tasks.proj_id', 'projects.id' );  
     $taref = project::select('projects.projeto', 'projects.proj_detalhe' , 'tasks.id', 'tasks.text', 'tasks.detalhe', 'tasks.duration', 'tasks.date_ini', 'tasks.date_fim', 'tasks.imp', 'tasks.urg', 'tasks.user_id', 'tasks.proj_id')->join('tasks', 'tasks.proj_id', 'projects.id')->join('dependencias', 'dependencias.task_id', 'dependencias.antes')->paginate(12);     
     $tarefas = $taref->sortByDesc('urg');

     $users = $user->all();

     //$users = DB::table('users')->paginate(12);

     $projects = DB::table('projects')->paginate(12);

        if(!empty($request->projeto)) {

        $projeto = $request->projeto;
        $taref = DB::table('tasks')->where('proj_id', $projeto)->paginate(12);
        $tarefas = $taref->sortByDesc('urg');
        }
         if(!empty($request->usuario)) {

            $usu = $request->usuario;

            $tarus = $taref->where('user_id', $usu);

            $tarefas = $tarus->sortByDesc('urg');
            
        }

        return view('admin.proj.status_task', compact('tarefas', 'projects', 'users'));
    }

    public function status_diario(Task $task, Project $project, Request $request)
    {
    $diaj = project::select('projects.projeto', 'projects.proj_detalhe' , 'diarios.task_id', 'diarios.detalhe', 'diarios.proj_id', 'diarios.ndia', 'diarios.ini', 'diarios.fim', 'diarios.user_id')->join('diarios', 'diarios.proj_id', 'projects.id' )->paginate(12);  
        
        $diarios = $diaj->sortByDesc('ndia');

        $users = DB::table('users')->paginate(4);
    
         if(!empty($request->projeto)) {

            $proj = $request->projeto;

            $diajp = $diaj->where('proj_id', $proj);

            $diarios = $diajp->sortByDesc('ndia');
        }

            if(!empty($request->usuario)) {

            $usu = $request->usuario;

            $diajp = $diaj->where('user_id', $usu);

            //dd($diajp);

            $diarios = $diajp->sortByDesc('ndia');
            
        }

        $projects = DB::table('projects')->paginate(12);

        return view('admin.proj.status_diario', compact('diarios', 'projects', 'users'));
    }

    public function status_proj(Task $task, Project $project)
    {
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'tasks.text', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(12);  

        //dd($tarefas);
        $projects = DB::table('projects')->paginate(12);

        return view('admin.proj.status_proj', compact('tarefas', 'projects'));
    }

     public function showpj(Task $task, Project $project, Request $request)
    {
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'tasks.text', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(12);  

        //dd($tarefas);
        $proj = $request->prj;

        $project = Project::where( 'id', $proj)->first();

        //dd($project);

        return view('admin.proj.showpj', compact('tarefas', 'project'));
    }
     public function showtk(Task $task, Project $project, Request $request)
    {
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'tasks.text', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(12);  

        //dd($tarefas);
        $taref = $request->trf;

        $task = Task::where( 'id', $taref)->first();

        //dd($project);

        return view('admin.proj.showtk', compact('tarefas', 'task'));
    }
    public function gantt(Task $task, Project $project, Request $request)
    {
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'tasks.text', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(12);  

        //dd($tarefas);
        $taref = $request->trf;

        $task = Task::where( 'id', $taref)->first();

        //dd($project);

        return view('admin.proj.gantt', compact('tarefas', 'task'));
    }
    public function showdp(Task $task, Project $project, Request $request)
    {
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'tasks.text', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(12);  

        //dd($tarefas);
        $taref = $request->trf;

        $task = Task::where( 'id', $taref)->first();

        //dd($project);

        return view('admin.proj.showdp', compact('tarefas', 'task'));
    }

    public function task(Task $task, Project $project)
    {
        $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'tasks.text', 'tasks.detalhe', 'tasks.urg')->join('tasks', 'tasks.proj_id', 'projects.id' )->orderBy('urg', 'DESC')->get(); 

        //$tarefas = $task->all(); 

        //$projects = DB::table('projects')->paginate(5);
        //$projects = DB::table('projects');
        $projects = $project->all();

        //$tarefas = $taref->sortByDesc('urg')->paginate(5);

        //dd($tarefas);

        return view('admin.proj.entrada', compact('tarefas', 'projects'));
    }

    public function n_proj(Task $task, Project $project)
    {
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'tasks.text', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(4);  

         $users = DB::table('users')->paginate(4);

        //dd($users);

        return view('admin.proj.n_proj', compact('tarefas', 'users'));
    }
    public function n_task(task $task, project $project)
    {
    $tarefas = project::select('projects.id', 'projects.projeto', 'projects.proj_detalhe' , 'projects.date_ini', 'projects.date_fim', 'projects.duracao', 'tasks.text', 'tasks.detalhe')->join('tasks', 'tasks.proj_id', 'projects.id' )->paginate(4);  

    $projects = $project->all();

     $users = DB::table('users')->paginate(4);
    //dd($projects);

        return view('admin.proj.n_task', compact('tarefas', 'projects', 'users'));
    }
    public function upd_p(Request $request)
    {
        //dd($request->prj);

    if(!empty($request->projeto)) {
        $dataForm = Project::find($request->prj);
        $dataForm->projeto = $request->projeto;
        $dataForm->gerente = $request->gerente;
        $dataForm->proj_detalhe = $request->detalhe;
        $dataForm->urg = $request->urg;
        $dataForm->imp = $request->imp;
        $dataForm->date_ini = $request->date_ini;
        $dataForm->date_fim = $request->date_fim;
        $dataForm->duracao = $request->duracao;
        $dataForm->status = $request->status;
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
    public function upd_t(Request $request)
    {
        //dd($request->prj);

    if(!empty($request->tarefa)) {
        $dataForm = Task::find($request->trf);
        $dataForm->task = $request->tarefa;
        $dataForm->user_id = $request->usuario;
        $dataForm->detalhe = $request->detalhe;
        $dataForm->urg = $request->urg;
        $dataForm->imp = $request->imp;
        $dataForm->date_ini = $request->inicio;
        $dataForm->date_fim = $request->termino;
        $dataForm->duration = $request->duration;
        $dataForm->status = $request->status;
        $dataForm->save();

        return redirect()
                    ->route('admin.proj.task')
                    ->with('success', 'Tarefa atualizada com sucesso');
    }
    else {
        return redirect()
                    ->back()
                    ->with('error', 'Os campos da tarefa devem ser preenchidos');
    }
    }
    public function store_p(Request $request)
    {
    if(!empty($request->projeto)) {
        $dataForm = new Project;
        $dataForm->projeto = $request->projeto;
        $dataForm->gerente = $request->gerente;
        $dataForm->proj_detalhe = $request->detalhe;
        $dataForm->urg = $request->urg;
        $dataForm->imp = $request->imp;
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
            $dataForm->date_ini = $request->date_ini;
            $dataForm->date_fim = $request->date_fim;
            $dataForm->duration = $request->duration;
            $dataForm->urg = $request->urg;
            $dataForm->imp = $request->imp;
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
