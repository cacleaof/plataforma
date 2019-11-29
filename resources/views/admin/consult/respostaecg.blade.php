@extends('adminlte::page')

@section('title', 'Teleconsultoria')

@section('content_header')
    <h1>Tele-ECG</h1>

    <ol class='breadcrumb'>
    	<li><a ref="">Dashboard</a></li>
    	<li><a ref="">Consult</a></li>
    	<li><a ref="">Entrada</a></li>
    </ol>
@stop
@include('admin.includes.modelo')
@section('content')
	<div class="container">
        <div class="box">
        <div class="box-header">
            <a href="{{ route('consult.dev_cons', ['sid' => $sid]) }}" class="btn btn-danger"><i class="fas fa-shopping-cart"></i>Devolver ao Regulador</a>
            <a href="{{ route('consult.respecg', ['sid' => $sid]) }}" class="btn btn-success"><i class="fas fa-shopping-cart"></i>Preparar a Resposta</a>
        </div>
        </div>
    </div>

    <table class="table table-striped">
            <tr>
            <hr>
            <th width="2%">ID </th>
            <th width="5%">STATUS </th>
            <th width="10%">SERVIÇO </th>
            <th width="48%">DESCRIÇÃO </th>
            <th width="10%">MUNICIPIO </th>
            <th width="10%">NOME SOLICITANTE </th>
            <th width="5%">TEMPO </th>
            <th width="10%">PACIENTE </th>
            </tr> 
            <tr>
          <h4>Dados da TeleConsultoria Selecionada</h4>    
            <td width="5%">{{ $consult->id}}</a></td>
            <td width="10%">{{ showstat($consult->status) }} </td>
            <td width="10%">{{ $consult->servico}} </td>
            <td width="40%">{{ $consult->consulta}} </td>
            <td width="10%">{{ $consult->municipio}} </td>
            <td width="10%">{{$consult->user->name}} </td>
            <td width="5%">{{ tempo($consult->created_at) }} </td>
            <td width="10%">{{$consult->paciente}} </td>
            </tr>    
    </table>  	
    <div class="box-tools pull-right">
                    <a href="#" class="btn btn-success" onClick="modalshow({{$consult}})"><i class="fa fa-pencil" aria-hidden="true"></i>Detalhar a Teleconsultoria</a>
    </div>
     <h4>Arquivos</h4>      
    <table class="table table-striped">
        <tr>
            <hr>
            <th>ID </th>
            <th>arquivo </th>
        </tr>       
          @forelse($files as $file)  
            <tr>
            <td>{{ $file->id}}</td>
            <td>{{ $file->file}}</td>
            <td>
            <div class="form-group">
                <img src="{{ url('storage/3/'.$file->file) }}" alt="{{ $file->file }}" style="max-width: 50px;">
            <a href="{{ route('consult.download', ['sid' => $file->id, 'cid' => $consult->user_id]) }}">
                <button type="button" class="btn btn-primary">
                    <i class="glyphicon glyphicon-download">
                        Download
                    </i></button>
            </a>  
            </div>
            </td>
            </tr>
        @empty
        <p>A plataforma Não tem Arquivo cadastrado!</p>
        @endforelse
    </table>
@stop
<script type="text/javascript">
  function modalshow($consult){
      $("#modalshow").modal();
    }
</script>

