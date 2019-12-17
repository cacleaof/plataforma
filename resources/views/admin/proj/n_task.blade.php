@extends('adminlte::page')

@section('title', 'Projeto')

@section('content_header')
    <h1>TAREFAS</h1>

    <ol class='breadcrumb'>
    	<li><a ref="">Projeto</a></li>
    	<li><a ref="">Tarefa</a></li>
    	<li><a ref=""></a></li>
    </ol>
@stop

@section('content')
	<div class="box box-solid box-info">
		<div class="box-header" with-border>
			<h3>Digite os dados da Tarefa</h3>
		</div>
		<div class="box-body">
			<form method="get" action="{{ route('admin.proj.store_t')}}" enctype="multipart/form-data">
					{!! csrf_field() !!}
				<div class="form-row">
					<label>Projeto:</label>
					@include('admin.includes.alerts')
					<div class="form-group">
						<select name="projeto">
							@foreach ($projects as $project)
							<option value="{{ $project->id }}">{{ $project->projeto }}</option>
							@endforeach
						</select>
						</div>
						<div class="form-group">
							<label>Responsavel da Tarefa:</label>
						<select name="gerente" class="form-control">
						<option value="">--Selecione o Responsável--</option>
							@foreach ($users as $user)
							<option value="{{ $user->id }}">{{ $user->name }}</option>
							@endforeach
						</select>
					</div>
						<div class="form-group" >
							<input type="text" class="form-control" name="tarefa" maxlength="50" placeholder="Nome da Tarefa">
						</div>
						<div class="form-group">
						<textarea type="text" name="detalhe" rows="3" cols="80" placeholder="Descreva o detalhe do projeto" class="form-control"></textarea>
						<div class="form-row" >
							<label>Urgência:</label>
							<input type="texto" class="form-control" name="urg" placeholder="Número de 1 a 5">
							<label>Importância:</label>
							<input type="texto" class="form-control" name="imp" placeholder="Número de 1 a 5">
						</div>
						<div class="form-row" >
							<label>Início:</label>
							<input type="date" class="form-control" name="start_date" placeholder="Data de Inicio">
							<label>Conclusão:</label>
							<input type="date" class="form-control" name="date_fim" placeholder="Data de Conclusão">
							<label>Previsão em Dias</label>
							<input type="text" class="form-control" name="duration" placeholder="Previsão em dias">
						</div>
						<div class="form-group">
						<button type="submit" class="btn btn-success">Enviar</button> 
						</div>
				</div>
			</form>
		</div>
	</div>
@stop