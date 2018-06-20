@extends('adminlte::page')

@section('title', 'Dúvida ou Questionamento')

@section('content_header')
    <h1>Dúvida ou Questionamento</h1>

    <ol class='breadcrumb'>
    	<li><a ref="">Dashboard</a></li>
    	<li><a ref="">Duvida</a></li>
    	<li><a ref="">Entrada</a></li>
    </ol>
@stop

@section('content')
	<div class="box">
		<div class="box-header">
			<h3>Digite os dados da sua dúvida</h3>
		</div>
		<div class="box-body">

				<form method="POST" action="{{ route('consult.nova')}}>
					{!! csrf_field() !!}

					<div class="form-group">
						<input type="text" name="descriçao" placeholder="Descreva sua dúvida ou questionamento" class "form-control">
						
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success">Enviar</button> 
					</div>
				</form>
		</div>
	</div>
@stop