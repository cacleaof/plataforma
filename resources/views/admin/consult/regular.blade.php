@extends('adminlte::page')

@section('title', 'Regulação da Teleconsultoria')

@section('content_header')
    <h1>Regulação da Teleconsultoria ou Tele-ECG</h1>
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
            <td>{{ $consult->servico}} </td>
            <td>{{ $consult->consulta}} </td>
            <td>{{ $consult->municipio}} </td>
            <td>{{ $consult->uf}} </td>
            <td>{{$consult->user->name}} </td>
            <td>{{$consult->cons_id}} </td>
            <td>{{$consult->cons_name}} </td>
            <td>{{ tempo($consult->created_at) }} </td>
            <td>{{$consult->paciente}} </td>
            </tr>    
         @empty
         <p>Você não tem consultas na sua caixa de entrada</p>
         @endforelse
      @endif
    </table> 
    <div class="box-tools pull-right">
                    <a href="#" class="btn btn-success" onClick="modalshow({{$consult}})"><i class="fa fa-pencil" aria-hidden="true"></i>Detalhar a Teleconsultoria</a>
    </div>
    <h4>Arquivos Anexados a Teleconsultoria</h4>      
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
    <h5>Selecione o Teleconsultor que irá atender, teclando no seu nome, ou pesquise abaixo:</h5>      
    <table class="table table-striped">
    	<tr>
            <hr>
            <th>ID </th>
            <th>NOME </th>
            <th>EMAIL </th>
            <th>TELEFONE </th>
            <th>PROFISSÃO </th>
            <th>ESPECIALIDADE </th>
        </tr>
    <div class="box">
        <div class="box-header">
            <form action="" method="GET" class="form form-inline" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input type="text" name="nomeconsultor" value="" style="max-width:400px;float: left;" class="form-control" placeholder="Digite qualquer parte do nome ou sobrenome do consultor">
                <input type="hidden" name="sid" value={{ $sid }}>
                <button type="submit" class="btn btn-primary" value="refresh" style="float: left;">Pesquisar</button>
            </form>
        @forelse($solRs as $solR)          
        	<tr>
            <td>{{ $solR->user_id }}</a></td>
            <td><a href="{{ route('consult.consultor', ['cid' => $solR->user_id, 'sid' => $sid]) }}">{{ $solR->name}}</a></td>
            <td>{{ $solR->email}} </td>
            <td>{{ $solR->telefone_celular}} </td>
            <td>
                <a>{{ $solR->profissao}} </a>
            </td>
            <td>
                <a>{{ $solR->especialidade}} </a>
            </td>
        	</tr>
        @empty
        @endforelse
        </div>
    </div>
    </table>
@include('admin.includes.modelo')    
@endsection
<script type="text/javascript">
  function modalshow($consult){
      $("#modalshow").modal();
    }
</script>
