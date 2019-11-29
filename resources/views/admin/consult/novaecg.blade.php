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
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Digite informações relevantes para seu tele-diagnóstico</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
	  <form method="POST" action="{{ route('consult.storeecg')}}" enctype="multipart/form-data">
			{!! csrf_field() !!}
			<div class="box-body">
				@include('admin.includes.alerts')
				<div class="form-group col-md-6">
					<textarea type="text" name="consulta" rows="8" cols="90" placeholder="Informações do paciente para o Teleconsultor" class="form-control"></textarea>
				</div>
				<div class="form-group col-md-6">
					<label for="file">Arquivos Anexos:</label>
					<input type="file" name="arquivo[]" id="file" multiple>
					<input type="hidden" value="{{ csrf_token() }}" name="_token">
				</div>
				<div class="form-group col-md-6">

					<div class="callout callout-danger">
						<h5><i class="fa fa-fw fa-warning"></i>
							Informe dados do paciente como nome, idade indicando unidade(Anos, Meses, dias), Queixa, Instituiçao e Município
						</h5>

					</div>
				</div>
				<div class="form-group col-md-9" >
					<input type="text" class="form-control" name="paciente" maxlength="50" placeholder="Nome do Paciente">
				</div>
				<div class="form-group col-xs-3">
					<input type="text" name="idade" maxlength="50" placeholder="Idade do Paciente" class="form-control">

				</div>
				<div class="col-md-12">
					<hr>
				</div>
				<div class="form-group col-md-6">
					<textarea type="text" name="queixa" maxlength="150" rows="8" cols="90" placeholder="Queixa principal/Observação" class="form-control"></textarea>
				</div>


				<div class="form-group col-md-6">
					<input type="text" name="instituiçao" maxlength="191" placeholder="Instituiçao onde está o paciente" class="form-control">
				</div>
				<div class="form-group col-md-6">
					<input type="text" name="municipio_sol" maxlength="50" placeholder="Municipio do paciente" class="form-control">
				</div>

			</div>
			<!-- /.box-body -->

			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Enviar</button>
			</div>
		</form>
	</div>

@stop