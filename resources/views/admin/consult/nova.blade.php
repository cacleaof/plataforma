@extends('adminlte::page')

@section('title', 'Dúvida ou Questionamento')

@section('content_header')
    <h1>Dúvida ou Questionamento</h1>

    <ol class='breadcrumb'>
    	<li><a ref="">Dashboard</a></li>
    	<li><a ref="">Consult</a></li>
    	<li><a ref="">Entrada</a></li>
    </ol>
@stop

@section('content')
	<div class="box">
		<div class="box-header">
			<h3>Digite os dados da sua dúvida</h3>
		</div>
		<div class="box-body">

				<form method="POST" action="{{ route('consult.store')}}">
					{!! csrf_field() !!}

					<div class="form-group">
						<input type="text" name="consulta" placeholder="Descreva sua dúvida ou questionamento" class "form-control">
						<input type="text" name="serviço" placeholder="Tipo serviço/Inclua aqui seus anexos" class "form-control">
						<input type="checkbox" name="ativo" value="1"  class "form-control">
						<input type="text" name="paciente" placeholder="Nome do Paciente" class "form-control">
						<input type="text" name="idade" placeholder="Idade do Paciente" class "form-control">
						<input type="text" name="queixa" placeholder="Queixa principal/Observação" class "form-control">
						<input type="text" name="instituiçao" placeholder="instituiçao do paciente" class "form-control">
						<input type="text" name="municipio_sol" placeholder="Municipio do paciente" class "form-control">
						<input type="text" name="area" placeholder="Área da Teleconsultoria" class "form-control">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success">Enviar</button> 
					</div>
				</form>
		</div>
	</div>
@stop