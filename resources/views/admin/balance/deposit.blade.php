@extends('adminlte::page')

@section('title', 'Nova Recarga')

@section('content_header')
    <h1>Solicitação</h1>

    <ol class='breadcrumb'>
    	<li><a ref="">Dashboard</a></li>
    	<li><a ref="">Solicitação</a></li>
    	<li><a ref="">Resposta</a></li>
    </ol>
@stop

@section('content')
	<div class="box">
		<div class="box-header">
			<h3>Fazer Solicitação</h3>
		</div>
		<div class="box-body">
			@include('admin.includes.alerts')

				<form method="POST" action="{{ route('deposit.store') }}">
					{!! csrf_field() !!}

					<div class="form-group">
						<input type="texto" name="value" placeholder="valor recarga" class "form-control">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success">Solicitação</button>
				</form>
		</div>
	</div>
@stop