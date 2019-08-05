<!--
 export_excel.blade.php
!-->

<!DOCTYPE html>
<html>
 <head>
  <title>Dependencias</title>
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
   <h3 align="center">Dependencias</h3><br />
   <div align="center">
    <a href="{{ route('export_dep.excel') }}" class="btn btn-success">Exportar para Excel</a>
   </div>
   <br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <tr>
      <td>ID</td>
      <td>ID da Tarefa</td>
      <td>Antes</td>
     </tr>
     @foreach($dep_data as $dep)
     <tr>
      <td>{{ $dep->id }}</td>
      <td>{{ $dep->task_id }}</td>
      <td>{{ $dep->antes }}</td>
     </tr>
     @endforeach
    </table>
    {!! $dep_data->links() !!}
   </div>
   
  </div>
 </body>
</html>