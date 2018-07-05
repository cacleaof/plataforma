@extends('adminlte::page')

@section('title', 'Regulação da Teleconsultoria')

@section('content_header')
    <h1>Regulação da Teleconsultoria</h1>
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
            <a href="{{ route('consult.devolver', ['sid' => $sid]) }}" class="btn btn-danger"><i class="fas fa-shopping-cart"></i>Devolver</a>
            <a href="{{ route('consult.encaminhar', ['sid' => $sid]) }}" class="btn btn-success"><i class="fas fa-shopping-cart"></i>Encaminhar</a>
        </div>
        @include('admin.includes.alerts')
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
      @if ($consults!=null)  
          <h4>Dados da TeleConsultoria Selecionada</h4>    
         @forelse($consults as $consult)
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
         @empty
         <p>Você não tem consultas na sua caixa de entrada</p>
         @endforelse
      @endif
    </table>  
    <h4>Regulador Selecione o Teleconsultor que irá atender a Solicitação</h4>      
    <table class="table table-striped">
    	<tr>
            <hr>
            <th>ID </th>
            <th>NOME </th>
            <th>EMAIL </th>
        </tr>
        @forelse($solRs as $solR)        
          @forelse($users as $user)
            @if ($user->id == $solR->user_id)	
        	<tr>
            <td>{{ $user->id}}</a></td>
            <td><a href="{{ route('consult.consultor', ['cid' => $user->id, 'sid' => $sid]) }}">{{ $user->name}}</a></td>
            <td>{{ $user->email}} </td>
        	</tr>
        	@endif
            @empty
          @endforelse
        @empty
        <p>A plataforma Não tem Teleconsultor cadastrado!</p>
        @endforelse
    </table>
@endsection