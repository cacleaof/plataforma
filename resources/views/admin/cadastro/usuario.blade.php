@extends('adminlte::page')

@section('title', 'Usuário')

@section('content_header')
    <h1>Ediçao de Usuário</h1>

    <ol class='breadcrumb'>
    	<li><a ref="">Admin</a></li>
    	<li><a ref="">usuario</a></li>
    </ol>
@stop
@section('content')
	<div class="box box-solid box-info">
		<div class="box-header" with-border>
			<h3>Digite os dados</h3>
		</div>
		<div class="box-body">
			<form method="POST" action="{{ route('admin.cadastro.store', ['cid' => $cid])}}" enctype="multipart/form-data">
					{!! csrf_field() !!}
				<div class="form-row">
					@include('admin.includes.alerts')
						<div class="form-group">
							<input type="text" name="nome" class="form-control" value="{{$users->name}}"> 
						</div>
						<div class="form-group col-xs-9" >
							<input type="text" class="form-control" value="{{$users->cpf}}" name="cpf" >
						</div>
						<div class="form-group col-xs-3" >
							<input type="text" class="form-control" value="{{$users->email}}" name="email" >
						</div>
						 <div class="form-group">
                        <button type="submit" class="btn btn-success">Enviar</button> 
                        </div>
			</form>
		</div>
	</div>
@stop
