@extends('adminlte::page')

@section('title', 'Projetos')

@section('content_header')
    <h1>Projetos</h1>

    <ol class='breadcrumb'>
      <li><a ref="">Dashboard</a></li>
      <li><a ref="">Proj</a></li>
      <li><a ref="">Editar</a></li>
    </ol>
@stop

@section('content')
<div class="box box-solid box-info">
 <div class="box-header" with-border>
  <h3>Altere os dados do seu Projeto</h3>
 </div>
 <div class="box-body">
 <form method="POST" action="{{ route('proj.upd_p', ['prj' => $project->id]) }}" enctype="multipart/form-data">
 {!! csrf_field() !!}
  @include('admin.includes.alerts')
  <div class="form-group row">
    <label for="idp" class="col-sm-2 col-form-label">ID</label>
    <div class="col-sm-2">
      <input type="text" id="idp" class="form-control" maxlength="5" value="{{ $project->id }}" readonly> 
    </div>
  </div>
    <div class="form-group">
      <label for="idprojeto">Projeto</label>
      <div class="form-group">
        <input type="text" id="idprojeto" class="form-control col-xs-4" name="projeto" maxlength="50" value="{{ $project->projeto }}">
      </div>
    </div>
  <div class="form-group">
    <div class="form-row">
      <label for="dproj">Detalhe do Projeto</label>
      <input type="text" id="dproj" name="detalhe" maxlength="80" value="{{ $project->proj_detalhe }}" class="form-control">
    </div>
  </div>
    <div class="form-row">
      <label class="form-control">Duração</label>
        <div class="form-row">
          <input type="text" name="duracao" maxlength="10" value="{{ $project->duracao }}" class="form-control"> 
        </div> 
    </div>
<br>
  <div class="form-group row">
    <div class="col-xs-2">
      <label>Gerente</label>
      <input type="text" name="gerente" maxlength="10" value="{{ $project->gerente }}" class="form-control">
    </div>
    <div class="form-row">
      <div class="col-xs-2">
        <label>Urgencia</label>
        <input type="text" name="urg" maxlength="5" value="{{ $project->urg }}" class="form-control">
      </div>
      <div class="col-xs-2">
       <label>Importancia</label>
       <input type="text" name="imp" maxlength="5" value="{{ $project->imp }}" class="form-control">
      </div>
      <div class="col-xs-3">
        <label>Inicio</label>
        <input type="date" name="date_ini" maxlength="5" value="{{ $project->date_ini }}" class="form-control">
      </div>
      <div class="col-xs-3">
        <label>Termino</label>
        <input type="date" name="date_fim" maxlength="5" value="{{ $project->date_fim }}" class="form-control">
      </div>
      <div class="col-xs-1">
        <label>Status %</label>
        <input type="text" name="status" maxlength="5" value="{{ $project->status }}" class="form-control">
      </div>
    </div>
  </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success">Enviar</button> 
    </div>
 </form>
 </div>
</div>
@stop