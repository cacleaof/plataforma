@extends('adminlte::page')

@section('title', 'Projeto')

@section('content_header')
    <script type="text/javascript">
    function Func9(){
  	$('input[name="ini"]').val('09:00');
  	$('input[name="fim"]').val('17:00');
	}
	</script>
	<script type="text/javascript">
		$( document ).ready(function() {
		$('#func8').click(function(){ 
			$('input[name="ini"]').val('08:00');
  			$('input[name="fim"]').val('16:00');
		})
		})
	</script>
@stop

@section('content')
	<div class="box box-solid box-info">
		<div class="box-header" with-border>
			<h4>Atividades Diárias</h4>
		</div>
		<div class="box-body">
			<div class="form-group">
		<form method="POST" action="{{ route('admin.proj.diario') }}" enctype="multipart/form-data">
					{!! csrf_field() !!}
		<a id="func8" class="btn btn-primary">8-16</a> 
		<button class="btn btn-primary" onclick="Func9()">9-17</button> 
		<input type="date" class="form-group col-xs-4" value="{{ $dia !=null ? $dia : date('Y-m-d') }}" name="dia" maxlength="5">
		<input type="time" class="form-group col-xs-2" value="{{ $ini !=null ? $ini : '' }}" name="ini" maxlength="10">
		<input type="time" class="form-group col-xs-2" value="{{ $fim !=null ? $fim : '' }}" name="fim"  maxlength="10">
		<button type="submit" class="btn btn-primary">Enviar</button> 
		</form>
	</div>
	<table class="table table-striped">
		<tr>
			@forelse ($diarios as $diario)
				<td>{{ $diario->date }}</td>
				<td>
					{{ $diario->project->projeto }}
				</td>
				<td>{{ $diario->task->task }}</td>
				<td>{{ $diario->detalhe }}</td>
				<td>{{ $diario->ini }}</td>
				<td>{{ $diario->fim }}</td>
		</tr>
			@empty
				<p>Sem tarefas planejadas para a data</p>
			@endforelse
	</table>
			<form method="get" action="{{ route('admin.proj.store_t')}}" enctype="multipart/form-data">
					{!! csrf_field() !!}
				<div class="form-row">
					@include('admin.includes.alerts')
					<div class="form-group">
						<select name="projeto">
							@foreach ($tarefas as $tarefa)
							<option value="{{ $tarefa->id }}">{{ $tarefa->projeto }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
							<label>Responsavel da Tarefa:</label>
						<select name="gerente">
							@foreach ($users as $user)
							<option value="{{ $user->id }}">{{ $user->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
							<label>Tarefa:</label>
						<select name="tarefa">
							@foreach ($tarefas as $tarefa)
							<option value="{{ $tarefa->id }}">{{ $tarefa->task }}</option>
							@endforeach
						</select>
					</div>
						<div class="form-group col-xs-3" >
							<input type="date" class="form-control" name="tarefa" maxlength="10">
						</div>
						<div class="form-group col-xs-2" >
							<input type="time" class="form-control" value="09:00" name="hora" maxlength="10">
						</div>
						<div class="form-group col-xs-2" >
							<input type="time" class="form-control" name="fim" value="17:00" maxlength="10">
						</div>
						<div class="form-group">
						<textarea type="text" name="detalhe" rows="5" cols="80" placeholder="Descreva o que foi realizado" class="form-control"></textarea>
						<div class="form-group">
						<button type="submit" class="btn btn-success">Enviar</button> 
						</div>
				</div>
			</form>
		</div>
	</div>
@stop