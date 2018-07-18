@extends('adminlte::page')

@section('title', 'Regulação da Teleconsultoria')

@section('content_header')
    <h1>Devolução da Teleconsultoria</h1>
    <ol class='breadcrumb'>
    	<li><a ref="">Dashboard</a></li>
    	<li><a ref="">Consult</a></li>
    	<li><a ref="">Entrada</a></li>
    </ol>
@stop
@section('content')
	<table class="table table-striped">
            <tr>
            <hr>
            <th>ID </th>
            <th>STATUS </th>
            <th>SERVIÇO </th>
            <th>DESCRIÇÃO </th>
            <th>MUNICIPIO </th>
            <th>UF</th>
            <th>NOME SOLICITANTE </th>
            <th>ID</th>
            <th>TELECONSULTOR </th>
            <th>TEMPO </th>
            <th>PACIENTE </th>
            </tr> 
            <tr> 
          <h4>Dados da TeleConsultoria Selecionada</h4>    
            <td>{{ $consult->id}}</a></td>
            <td>{{ showstat($consult->status) }} </td>
            <td>{{ $consult->serviço}} </td>
            <td>{{ $consult->consulta}} </td>
            <td>{{ $consult->municipio}} </td>
            <td>{{ $consult->uf}} </td>
            <td>{{$consult->user->name}} </td>
            <td>{{$consult->cons_id}} </td>
            <td>{{$consult->cons_name}} </td>
            <td>{{$consult->tempo}} </td>
            <td>{{$consult->paciente}} </td>
            </tr>    
    </table>  
    <div class="box box-solid box-info">
        <div class="box-header" with-border>
            <h3>Digite o Motivo da Devolução da Teleconsultoria</h3>
        </div>
        <div class="box-body">
            <form method="POST" action="{{ route('consult.dev_con_store', ['sid' => $sid]) }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                <div class="form-row">
                        <div class="form-group">
                        <textarea type="text" name="devolutiva" rows="5" cols="80" placeholder="Descreva o motivo da Devolução da Teleconsultoria" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-success">Enviar</button> 
                        </div>
                </div>
            </form>
        </div>
    </div>
@endsection