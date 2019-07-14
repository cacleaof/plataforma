<!--
 export_excel.blade.php
!-->

<!DOCTYPE html>
<html>
 <head>
  <title>Consultorias</title>
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
   <h3 align="center">Lista Consultorias e Exporta para Excel</h3><br />
   <div align="center">
    <a href="{{ route('export_excel.excel') }}" class="btn btn-success">Exportar para Excel</a>
   </div>
   <br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <tr>
      <td>Consulta</td>
      <td>Data</td>
      <td>Cidade</td>
      <td>Solicitante</td>
      <td>Paciente</td>
     </tr>
     @foreach($consults_data as $consults)
     <tr>
      <td>{{ $consults->consulta }}</td>
      <td>{{ $consults->created_at }}</td>
      <td>{{ $consults->municipio }}</td>
      <td>{{ $consults->sol_name }}</td>
      <td>{{ $consults->paciente }}</td>
     </tr>
     @endforeach
    </table>
    {!! $consults_data->links() !!}
   </div>
   
  </div>
 </body>
</html>