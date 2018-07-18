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
            <a href="{{ route('consult.dev_cons', ['sid' => $sid]) }}" class="btn btn-danger"><i class="fas fa-shopping-cart"></i>Devolver ao Regulador</a>
            <a href="{{ route('consult.respcons', ['sid' => $sid]) }}" class="btn btn-success"><i class="fas fa-shopping-cart"></i>Preparar a Resposta</a>
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
            <td width="10%">{{ $consult->serviço}} </td>
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
<div class="modal fade" id="modalshow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detalhamento da Teleconsultoria</h4>
        </div>
            <div class="table-responsive">
            <table class="table table-condensed table table-striped">
            <tr>
            <th>ID </th>
            <th>DATA </th>
            <th>STATUS </th>
            <th>SERVIÇO </th>
            <th>DESCRIÇÃO </th>
            </tr> 
            <tr> 
            <td>{{ $consult->id}}</a></td>
            <td>{{ $consult->created_at}}</a></td>
            <td>{{ showstat($consult->status) }} </td>
            <td>{{ $consult->serviço}} </td>
            <td>{{ $consult->consulta}} </td>
            </tr> 
            </table>
            </div>
            <div class="table-responsive">
            <table class="table table-condensed table table-striped">
            <tr>
            <th>MUNICIPIO </th>
            <th>UF</th>
            <th>NOME SOLICITANTE </th>
            </tr> 
            <tr> 
            <td>{{ $consult->municipio}} </td>
            <td>{{ $consult->uf}} </td>
            <td>{{$consult->sol_name}} </td>
            </tr> 
            </table>
            </div>
            <div class="table-responsive">
            <table class="table table-condensed table table-striped">
            <tr>
            <th>REGULADOR</th>
            <th>TELECONSULTOR </th>
            <th>TEMPO </th>
            <th>PACIENTE </th>
            </tr>
            <td>{{$consult->reg_name}} </td>
            <td>{{$consult->cons_name}} </td>
            <td>{{ tempo($consult->created_at) }} </td>
            <td>{{$consult->paciente}} </td>
            </table>
            </div>
            <div class="table-responsive">
            <table class="table table-condensed table table-striped">
            <tr>
            <th>QUEIXA </th>
            <th>INSTITUIÇÃO </th>
            <th>CIDADE </th>
            </tr>
            <td>{{$consult->queixa}} </td>
            <td>{{$consult->instituiçao}} </td>
            <td>{{$consult->municipio_sol}} </td>
            </table>
            </div>
            <div class="table-responsive">
            <table class="table table-condensed table table-striped">
            <tr>
            <th>AREA INFORMADA </th>
            <th>DEVOLUTIVA DO CONSULTOR </th>
            <th>DEVOLUTIVA DO REGULADOR </th>
            </tr>
            <td>{{$consult->area}} </td>
            <td>{{$consult->devolutiva}} </td>
            <td>{{$consult->dev_reg}} </td>
            </table>
            </div>
            <div class="table-responsive">
            <table class="table table-condensed table table-striped">
            <tr>
            <th>RESPOSTA </th>
            <th>LEITURA RECOMENDADA </th>
            <th>CIAP </th>
            </tr>
            <tr>
            <td>{{$consult->resposta}} </td>
            <td>{{$consult->l_recom}} </td>
            <td>{{$consult->ciap}} </td>
            </tr>
            </table>
            </div>
             <div class="table-responsive">
            <table class="table table-condensed table table-striped">
            <tr>
            <th>DEC 1o </th>
            <th>DEC 2o </th>
            <th>DEC 3o </th>
            <th>DÚVIDA </th>
            <th>AVALIAÇÃO </th>
            <th>COMENTÁRIO </th>
            </tr>
            <tr>
            <td>{{$consult->dec1}} </td>
            <td>{{$consult->dec2}} </td>
            <td>{{$consult->dec3}} </td>
            <td>{{$consult->av_duvida}} </td>
            <td>{{$consult->avaliaçao}} </td>
            <td>{{$consult->av_commen}} </td>
            </tr>
            </table>
            </div>
    </div>
  </div>
</div>
@stop
<script type="text/javascript">
  function modalshow($consult){
      $("#modalshow").modal();
    }
</script>


