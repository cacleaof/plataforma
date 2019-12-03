@extends('adminlte::page')

@section('title', 'Teleconsultoria')

@section('content_header')
	<h1>Teleconsultoria</h1>

	<ol class='breadcrumb'>
		<li><a ref="">Dashboard</a></li>
		<li><a ref="">Consult</a></li>
		<li><a ref="">Entrada</a></li>
	</ol>
@stop

@section('content')

	<div class="box box-solid box-info">
		<div class="box-header" with-border>
			<h3 class="text-center"><i class="fa fa-fw fa-comment-o"></i> Digite as informações da sua consultoria</h3>
		</div>
		<div class="box-body">
			<form method="POST" action="{{ route('consult.store')}}" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<div class="form-row">
					@include('admin.includes.alerts')
					<div class="box-body">
						<textarea class="form-group col-md-6" type="text" name="consulta" rows="7" cols="80" placeholder="Descreva sua dúvida ou questionamento" class="form-control"></textarea>
						<div class="form-group col-md-6">
							<label for="file" >Arquivos Anexos:</label>
							<input type="file"  name="arquivo[]" id="file" multiple>
							<input type="hidden" value="{{ csrf_token() }}" name="_token">
						</div>
						<div class="form-group col-md-6">
							<select class="form-control" name="tipo">
								<option>Escoha o tipo do arquivo</option>
								<option value="Exame Paciente"></option>
								<option value="Síncrona">Teleconsultoria - Tempo real (Síncrona)</option>
							</select>
						</div>	
						<div class="form-group col-md-6">
							<div class="callout callout-danger">
								<h5><i class="fa fa-fw fa-warning"></i> Caso seja relevante informe dados do paciente como nome, idade indicando unidade(Anos, Meses, dias), Queixa, Instituiçao e Município</h5>
							</div>

						</div>
						<div class="form-group col-md-9">
							<input type="text" class="form-control" name="paciente" maxlength="50" placeholder="Nome do Paciente">
						</div>
						<div class="form-group col-md-3">
							<input type="text" name="idade" maxlength="50" placeholder="Idade do Paciente" class="form-control">
						</div>
					</div>
					<hr>
					<div class="form-row">

						<div class="form-group col-md-6">
							<textarea class="form-group col-md-12" type="text"name="queixa" maxlength="200" rows="8" cols="80" placeholder="Queixa principal/Observação" class="form-control"></textarea>

						</div>


					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<select class="form-control" name="servico">
								<option>Escoha o tipo de Teleconsultoria</option>
								<option value="Assíncrona">Teleconsultoria - Com resposta em até 72h (Assíncrona)</option>
								<option value="Síncrona">Teleconsultoria - Tempo real (Síncrona)</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<input type="text" name="instituiçao" maxlength="191" placeholder="Instituiçao onde está o paciente" class="form-control">
						</div>
						<div class="form-group col-md-6">
							<input type="text" name="municipio_sol" maxlength="50" placeholder="Municipio do paciente" class="form-control">
						</div>
						<div class="form-group col-md-6">
							<input type="text" name="area" maxlength="50" placeholder="Área de Saúde da Teleconsultoria" class="form-control">
						</div>
						<div class="form-group col-md-6">
							<button type="submit" class="btn btn-primary">Enviar</button>
						</div>
					</div>
			</form>
		</div>
	</div>
@stop