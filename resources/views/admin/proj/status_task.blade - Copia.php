<!--
 export_excel.blade.php
!-->

<!DOCTYPE html>
<html>
 <head>
  <title>Tarefas</title>
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
   <h3 align="center">Lista de Tarefas</h3><br />
   <div align="center">
    <a href="{{ route('admin.proj.task') }}" class="btn btn-success">Voltar</a>
   </div>
   <br />
   <form action="{{ route('admin.proj.status_task') }}" method="GET" class="form form-inline" enctype="multipart/form-data">
                {!! csrf_field() !!}
              <select name="projeto">
              @foreach ($projects as $project)
              <option value="{{ $project->id }}">{{ $project->projeto }}</option>
              @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Enviar</button> 
   </form>
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <tr>
      <td>Id</td>
      <td>Projeto</td>
      <td>Detalhe</td>
      <td>Início</td>
      <td>Conclusão</td>
      <td>Previsão</td>
      <td>Urg</td>
      <td>Imp</td>
      <td>Duração</td>
      <td>Gerente</td>
     </tr>
     @foreach($tarefas as $tarefa)
      <tr>
      <td>{{ $tarefa->id}} </td>
      <td bgcolor="red">{{ $tarefa->task}}</td>
      <td style="background-color: #FFF633">{{ $tarefa->detalhe}}</td>
      <td>{{ $tarefa->date_ini}}</td>
      <td>{{ $tarefa->date_fim}}</td>
      <td>{{ $tarefa->prevdias}}</td>
      <td>{{ $tarefa->urg}}</td>
      <td>{{ $tarefa->imp}}</td>
      <td>{{ $project->duracao }}</td>
      <td>{{ $project->gerente }}</td>
     </tr>
     @endforeach
    </table>
    {!! $projects->links() !!}
   </div>  
  </div>
 </body>
</html>