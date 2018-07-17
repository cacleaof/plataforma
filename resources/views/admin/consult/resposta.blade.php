@extends('adminlte::page')

@section('title', 'Teleconsultoria')

@section('content_header')
    <h1>Teleconsultoria</h1>

    <ol class='breadcrumb'>
    	<li><a ref="">Dashboard</a></li>
    	<li><a ref="">Consult</a></li>
    	<li><a ref="">Entrada</a></li>
    </ol>
@stop

@section('content')
	<div class="container">
        <div class="box">
        <div class="box-header">
            <a href="{{ route('consult.entrada')}}" class="btn btn-danger"><i class="fas fa-shopping-cart"></i>Devolver ao Regulador</a>
            <a href="{{ route('consult.respcons', ['sid' => $sid]) }}" class="btn btn-success"><i class="fas fa-shopping-cart"></i>Preparar a Resposta</a>
            <a href="{{ route('consult.modelo', ['sid' => $sid]) }}" class="btn btn-success"><i class="fas fa-shopping-cart"></i>Detalhar a Teleconsultoria</a>
        </div>
        </div>
    </div>
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