@extends('adminlte::page')

@section('content_header')
<div class="box">
    <p><strong>Usuário Logado: </strong>{{auth()->user()->name }}</p>
</div>
@stop
@section('content')
    @include('admin.includes.alerts')
    <div class="container">
        <div class="box">
        <div class="box-header">
            <a href="{{ route('admin.proj.n_proj') }}" class="btn btn-primary"><i class="fas fa-shopping-cart"></i>Novo Projeto</a>
            <a href="{{ route('admin.proj.n_task')}}" class="btn btn-primary"><i class="fas fa-shopping-cart"></i>Nova Tarefa</a>
            <a href="{{ route('admin.proj.diario')}}" class="btn btn-primary"><i class="fas fa-shopping-cart"></i>Diário</a>
        </div>
        </div>
    </div>
          <table  class="display" style="width:100%">
        <thead>
            <tr>
            <th>ID </th>
            <th>PROJETO </th>
            <th>DESCRIÇÃO</th>
            <th>INICIO</th>
            <th>IMP</th>
            <th>URG</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @forelse($projects as $project)
                <td>{{ $project->id}} </td>
                <td><a href="{{ route('proj.showpj', ['prj' => $project->id]) }}"
            > {{ $project->projeto }}</a></td>
                <td>{{ $project->proj_detalhe}} </td>
                <td>{{ $project->date_ini}} </td>
                <td>{{ $project->imp}} </td>
                <td>{{ $project->urg}} </td> 
                </tr> 
                @empty
            <p>Você não tem projetos na sua caixa de entrada</p>  
                @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Projeto</th>
                <th>Detalhes</th>
                <th>Inicio</th>
                <th>Importancia</th>
                <th>Urgencia</th>
            </tr>
        </tfoot>
    </table>
            <table id="example" class="table table-striped">
        <thead>
            <tr>
            <hr>
            <th>ID </th>
            <th>PROJETO </th>
            <th>DESCRIÇÃO</th>
            <th>TAREFA </th>
            <th>DESCRIÇÃO </th>
            </tr> 
        </thead>
        <tbody>
            <tr>
         @if ($tarefas!=null)      
         @forelse($tarefas as $tarefa)
            <td>{{ $tarefa->id}} </td>
            <td>{{ $tarefa->projeto}} </td>
            <td>{{ $tarefa->proj_detalhe}} </td>
            <td><a href="{{ route('proj.showtk', ['trf' => $tarefa->id]) }}"
            > {{ $tarefa->text }}</a></td>
            <td>{{ $tarefa->detalhe}} </td>
            </tr>    
        @empty
        <p>Você não tem tarefas na sua caixa de entrada</p>
        @endforelse
        @endif
        </tbody>
        </table>
@endsection

