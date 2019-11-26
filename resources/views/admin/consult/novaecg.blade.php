@extends('adminlte::page')

@section('title', 'Tele-ECG')

@section('content_header')
    <h1>Tele-ECG</h1>

    <ol class='breadcrumb'>
    	<li><a ref="">Dashboard</a></li>
    	<li><a ref="">Consult</a></li>
    	<li><a ref="">Entrada</a></li>
    </ol>
@stop

@section('content')
	<div class="box box-solid box-info">
		<div class="box-header" with-border>
			<h3>Digite informações relevantes para seu tele-diagnóstico</h3>
		</div>
		<div class="box-body">
			<form method="POST" action="{{ route('consult.storeecg')}}" enctype="multipart/form-data">
					{!! csrf_field() !!}
				<div class="form-row">
					@include('admin.includes.alerts')
						<div class="form-group">
						<textarea type="text" name="consulta" rows="3" cols="70" placeholder="Informações do paciente para o Teleconsultor" class="form-control"></textarea>
						<div class="form-row">
							<label for="file">Arquivos Anexos:</label>
							<input type="file" name="arquivo[]" id="file" multiple>
							<input type="hidden" value="{{ csrf_token() }}" name="_token">
						</div>
						<div class="form-row" >
							<label>Informe dados do paciente como nome, idade indicando unidade(Anos, Meses, dias), Queixa, Instituiçao e Município</label>
						</div>
						<div class="form-group col-xs-9" >
							<input type="text" class="form-control" name="paciente" maxlength="50" placeholder="Nome do Paciente">
						</div>
						<div class="form-group col-xs-3">
							<input type="text" name="idade" maxlength="50" placeholder="Idade do Paciente" class="form-control">
						</div>
				<div class="form-row">		
						<div class="form-group">
							<label>Queixa principal/Observação</label>
							<textarea type="text" name="queixa" maxlength="50" rows="2" cols="80" placeholder="Queixa principal/Observação" class="form-control">
							</textarea>
						</div>
						<div class="form-group col-xs-5">
							<input type="text" name="instituiçao" maxlength="191" placeholder="Instituiçao onde está o paciente" class="form-control">
						</div>
						<div class="form-group col-xs-5">
							<input type="text" name="municipio_sol" maxlength="50" placeholder="Municipio do paciente" class="form-control">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group">
						<button type="submit" class="btn btn-success">Enviar</button> 
						</div>
				</div>
			</form>
		</div>
	</div>
@stop