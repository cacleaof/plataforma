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
        </div>
        </div>
    </div>
        <table class="table table-striped">
            <tr>
            <hr>
            <th>ID </th>
            <th>PROJETO </th>
            <th>DESCRIÇÃO</th>
            <th>INICIO</th>
            </tr> 
            <tr>
         @if ($projects!=null)      
         @forelse($projects as $project)
            <td>{{ $project->id}} </td>
            <td>{{ $project->projeto}} </td>
            <td>{{ $project->proj_detalhe}} </td>
            <td>{{ $project->date_ini}} </td>
            </tr>    
        @empty
        <p>Você não tem projetos na sua caixa de entrada</p>
        @endforelse
        {!! $projects->links() !!}
        @endif
        </table>
        <table class="table table-striped">
            <tr>
            <hr>
            <th>ID </th>
            <th>PROJETO </th>
            <th>DESCRIÇÃO</th>
            <th>TAREFA </th>
            <th>DESCRIÇÃO </th>
            </tr> 
            <tr>
         @if ($tarefas!=null)      
         @forelse($tarefas as $tarefa)
            <td>{{ $tarefa->id}} </td>
            <td>{{ $tarefa->projeto}} </td>
            <td>{{ $tarefa->proj_detalhe}} </td>
            <td>{{ $tarefa->task}} </td>
            <td>{{ $tarefa->detalhe}} </td>
            </tr>    
        @empty
        <p>Você não tem tarefas na sua caixa de entrada</p>
        @endforelse
        {!! $tarefas->links() !!}
        @endif
        </table>
@endsection