<!--
 export_excel.blade.php
!-->

<!DOCTYPE html>
<html>
 <head>
  <title>Projetos</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
 </head>
 <body>
  <br />
    <div class="box-header" with-border>
      <h3 align="center">Altere os dados do seu Projeto</h3>
    </div>
    <div class="box-body">
      <form method="POST" action="{{ route('admin.proj.store_p')}}" enctype="multipart/form-data">
          {!! csrf_field() !!}
        <div class="form-row">
          @include('admin.includes.alerts')
            <div class="form-group">
              <div class="form-group col-xs-1" >
              <output class="form-control">ID:{{ $project->id }}</output>
              </div>
            </div>
            <div class="form-group col-xs-9" >
              <input type="text" class="form-control" name="projeto" maxlength="50" value="Projeto:{{ $project->projeto }}">
            </div>
            <div class="form-group col-xs-9">
              <input type="text" name="detalhe" maxlength="50" value="{{ $project->proj_detalhe }}" class="form-control">
            </div>
            <div class="form-group col-xs-3">
              <label class="form-group">Duração</label>
            <input type="text" name="duracao" maxlength="10" value="{{ $project->duracao }}" class="form-control">  
            </div>
            <div class="form-group col-xs-2">
              <input type="text" name="gerente" maxlength="10" value="{{ $project->gerente }}" class="form-control">
            </div>
            <div class="form-group col-xs-2">
              <input type="text" name="urg" maxlength="5" value="{{ $project->urg }}" class="form-control">
            </div>
             <div class="form-group col-xs-2">
              <input type="text" name="imp" maxlength="5" value="{{ $project->imp }}" class="form-control">
            </div>
            <div class="form-group col-xs-2">
              <input type="date" name="date_ini" maxlength="5" value="{{ $project->date_ini }}" class="form-control">
            </div>
            <div class="form-group col-xs-2">
              <input type="date" name="date_fim" maxlength="5" value="{{ $project->date_fim }}" class="form-control">
            </div>
            <div class="form-control">
            <button type="submit" class="btn btn-success">Enviar</button> 
            </div>
          </div>
        </form>
      </div>
 </body>
</html>