@extends('adminlte::page')

@section('title', 'Projeto')

@section('content_header')
    <h1>PROJETOS</h1>

    <ol class='breadcrumb'>
    	<li><a ref="">Dashboard</a></li>
    	<li><a ref="">Consult</a></li>
    	<li><a ref="">Entrada</a></li>
    </ol>
@stop

@section('content')
	<div class="box box-solid box-info">
		<div class="box-header" with-border>
			<h3>Digite os dados do seu projeto</h3>
		</div>
		<div class="box-body">
			<form method="get" action="{{ route('admin.proj.store_p')}}" enctype="multipart/form-data">
					{!! csrf_field() !!}
				<div class="form-row">
					@include('admin.includes.alerts')
						<div class="form-group" >
							<input type="text" class="form-control" name="projeto" maxlength="50" placeholder="Nome do Projeto">
						</div>
						<div class="form-group">
						<textarea type="text" name="detalhe" rows="5" cols="80" placeholder="Descreva o detalhe do projeto" class="form-control"></textarea>
						<div class="form-row" >
							<label>Caso seja relevante</label>
						</div>
						<div class="form-group">
						<button type="submit" class="btn btn-success">Enviar</button> 
						</div>
				</div>
			</form>
		</div>
	</div>
@stop