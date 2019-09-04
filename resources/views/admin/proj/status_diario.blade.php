<!--
 export_excel.blade.php
!-->

<!DOCTYPE html>
<html>
 <head>
  <title>Diário</title>
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
  <div class="container">
   <h3 align="center">Lista de Tarefas Executadas e Programadas</h3><br />
   <div align="center">
    <a href="{{ route('admin.proj.task') }}" class="btn btn-success">Voltar</a>
   </div>
   <br />
   <input type="hidden" name="projeto" value='1'>
   <form action="" method="GET" class="form form-inline" enctype="multipart/form-data">
                {!! csrf_field() !!}
              <select name="projeto" class="form-control">
              <option value="">--Selecione o Projeto--  OU</option>
              @foreach ($projects as $project)
              <option value="{{ $project->id }}">{{ $project->projeto }}</option>
              @endforeach
            </select>
            <select name="usuario" class="form-control">
            <option value="">--Selecione o Usuario--</option>
              @foreach ($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
    <button type="submit" class="btn btn-primary">Enviar</button> 
   </form>
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <tr>
      <td>Id</td>
      <td>Tarefa</td>
      <td>Detalhe</td>
      <td>Dia</td>
      <td>Inicio</td>
      <td>Fim</td>
     </tr>
     @foreach($diarios as $diario)
      <tr>
      <td>{{ $diario->id}} </td>
      <td bgcolor="red">{{ $diario->task_id }}</td>
      <td style="background-color: #FFF633">{{ $diario->detalhe}}</td>
      <td>{{ $diario->ndia }}</td>
      <td>{{ $diario->ini }}</td>
      <td>{{ $diario->fim }}</td>
     </tr>
     @endforeach
    </table>
   </div> 
  </div>
 </body>
</html>