@extends('adminlte::page')

@section('title', 'Projeto')

@section('content_header')
    <h4>Atividades do dia: {{ $horaini or '10:00' }} </h4>
    <div class="form-control">
		<button class="btn btn-primary" onclick="Func9()">9-17</button> 
	</div>
	<div class="form-control">
		<button class="btn btn-primary" onclick="Func8()">8-16</button> 
	</div>
	<div class="form-group col-xs-2" >
		<input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="dia" maxlength="5" placeholder="Dia">
	</div>
	<div class="form-group col-xs-1" >
		<input type="time" class="form-control" value="09:00" name="hora" maxlength="10" placeholder="Dia">
	</div>
	<div class="form-group col-xs-1" >
		<input type="time" class="form-control" name="fim" value="17:00" maxlength="10" placeholder="Dia">
	</div>
    <ol class='breadcrumb'>
    	<li><a ref=""></a></li>
    	<li><a ref="">Calendario</a></li>
    	<li><a ref="date('d/m/y')">{{ date('F') }}</a></li>
    </ol>
    <script type="text/javascript">
    function Func9(){
  	var horaini = "9:00";
	}
	</script>
	<script type="text/javascript">
	function Func8(){
  	var horaini = "8:00";
	}
	</script>
@stop

@section('content')
	<div class="box box-solid box-info">
		<div class="box-header" with-border>
			<h3>Atividades Diárias</h3>
		</div>
		<div class="box-body">
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
							<input type="date" class="form-control" name="tarefa" maxlength="10" placeholder="Dia">
						</div>
						<div class="form-group col-xs-2" >
							<input type="time" class="form-control" value="09:00" name="hora" maxlength="10" placeholder="Dia">
						</div>
						<div class="form-group col-xs-2" >
							<input type="time" class="form-control" name="fim" value="17:00" maxlength="10" placeholder="Dia">
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