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
			<h3>Digite os dados da sua consultoria</h3>
		</div>
		<div class="box-body">
			<form method="POST" action="{{ route('consult.store')}}">
					{!! csrf_field() !!}
				<div class="form-row">
						<div class="form-group">
						<textarea type="text" name="consulta" rows="5" cols="80" placeholder="Descreva sua dúvida ou questionamento" class="form-control"></textarea>
						</div>
						<div class="form-group col-xs-9" >
							<input type="text" class="form-control" name="paciente" placeholder="Nome do Paciente">
						</div>
						<div class="form-group col-xs-3">
							<input type="text" name="idade" placeholder="Idade do Paciente" class="form-control">
						</div>
				<div class="form-row">		
						<div class="form-group">
							<textarea type="text" name="queixa" rows="2" placeholder="Queixa principal/Observação" class="form-control">Queixa principal
							</textarea>
						</div>
						<div class="form-group col-xs-5">
							<input type="text" name="instituiçao" placeholder="instituiçao do paciente" class="form-control">
						</div>
						<div class="form-group col-xs-5">
							<input type="text" name="municipio_sol" placeholder="Municipio do paciente" class="form-control">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group">
							<select class="form-control" name="serviço">
      						<option>Teleconsultoria - Texto</option>
      						<option>Teleconsultoria - Video</option>
    						</select>
    					</div>
    					<div class="form-group">
							<input type="text" name="area" placeholder="Área da Teleconsultoria" class="form-control">
						</div>
						<div class="form-group">
						<button type="submit" class="btn btn-success">Enviar</button> 
						</div>
				</div>
			</form>
		</div>
	</div>
@stop