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
  <div class="container">
   <h3 align="center">Projetos</h3><br />
   <div align="center">
    <a href="{{ route('export_proj.excel') }}" class="btn btn-success">Exportar para Excel</a>
   </div>
   <br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <tr>
      <td>Id</td>
      <td>Projeto</td>
      <td>Detalhe</td>
      <td>Duração</td>
      <td>Gerente</td>
     </tr>
     @foreach($proj_data as $projects)
     <tr>
      <td>{{ $projects->id }}</td>
      <td>{{ $projects->projeto }}</td>
      <td>{{ $projects->proj_detalhe }}</td>
      <td>{{ $projects->duracao }}</td>
      <td>{{ $projects->gerente }}</td>
     </tr>
     @endforeach
    </table>
    {!! $proj_data->links() !!}
   </div>
   
  </div>
 </body>
</html>