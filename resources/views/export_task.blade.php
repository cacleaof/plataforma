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
   <h3 align="center">Tarefas</h3><br />
   <div align="center">
    <a href="{{ route('export_task.excel') }}" class="btn btn-success">Exportar para Excel</a>
   </div>
   <br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <tr>
      <td>Tarefa</td>
      <td>Detalhamento</td>
      <td>Data Inicio</td>
      <td>Data Fim</td>
      <td>Id Projeto</td>
     </tr>
     @foreach($task_data as $task)
     <tr>
      <td><a href="{{ route('proj.showtk', ['trf' => $task->id]) }}"
            > {{ $task->text }}</a></td>
      <td>{{ $task->detalhe }}</td>
      <td>{{ $task->date_ini }}</td>
      <td>{{ $task->date_fim }}</td>
      <td>{{ $task->proj_id }}</td>
     </tr>
     @endforeach
    </table>
    {!! $task_data->links() !!}
   </div>
   
  </div>
 </body>
</html>