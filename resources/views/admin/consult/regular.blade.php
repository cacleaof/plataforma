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
            <a href="{{ route('consult.devolver', ['sid' => $sid]) }}" class="btn btn-danger"><i class="fa fa-fw fa-exchange"></i> Devolver</a>
            <a href="{{ route('consult.encaminhar', ['sid' => $sid]) }}" class="btn btn-success"><i class="fa fa-fw fa-paper-plane-o"></i> Encaminhar</a>
        </div>
        @include('admin.includes.alerts')
        </div>
</div>
    <div class="col-md-3">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Dados da TeleConsultoria Selecionada</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form">
            <div class="box-body">
                <div class="form-group">
                    <p><strong>Identificação:</strong> {{ $consult->id }}</p>
                </div>
                <div class="form-group">
                    <p><strong>Status:</strong> {{ showstat($consult->status) }}</p>
                </div>
                <div class="form-group">
                    <p><strong>Tempo:</strong> {{ tempo($consult->created_at) }}</p>
                </div>


            </div>
            <!-- /.box-body -->

        </form>
    </div>
    </div>
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Dados da TeleConsultoria Selecionada</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
                <div class="box-body">

                    <div class="form-group ">
                    <p><strong>Serviço:</strong> {{ $consult->servico}} </p>
                    </div>
                    <td> </td>
                    <td>{{ $consult->consulta}} </td>
                    <td>{{ $consult->municipio}} </td>
                    <td>{{ $consult->uf}} </td>
                    <td>{{$consult->user->name}} </td>
                    <td>{{$consult->cons_id}} </td>
                    <td>{{$consult->cons_name}} </td>



                    <div class="form-group">
                        <p><strong>Teleconsultor:</strong> {{$consult->cons_name}}</p>
                    </div>

                    <div class="form-group">
                        <p><strong>Paciente: </strong> {{$consult->paciente}}</p>
                    </div>
                    <div class="form-group">
                        <p><strong>Descrição: </strong> {{ $consult->consulta}}</p>
                    </div>
                    <div class="form-group">
                        <p><strong>Devolução: </strong> {{$consult->devolutiva}} </p>
                    </div>

                    <div class="form-group">
                        @if($consult->anexos!=null)
                            @forelse($files as $file)

                                <p><strong>Arquivo anexos da teleconsultoria:</strong></p>  <a href="{{ route('consult.download', ['sid' => $file->id, 'cid' => $consult->user_id]) }}">
                                    <button type="button" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-download">
                                            Download
                                        </i></button>
                                </a>

                            @empty
                                <p>A Consultoria não tem Arquivo anexado!</p>
                                @endforelse

                                </table>
                            @endif
                    </div>
                    <div class="form-group">
                        <a href="#" class="btn btn-success" onClick="modalshow({{ $consult }})"><i class="fa fa-pencil" aria-hidden="true"></i> Detalhar a Teleconsultoria</a>
                    </div>


                </div>
                <!-- /.box-body -->

            </form>
        </div>
    </div>


    <h5>Selecione o Teleconsultor que irá atender, teclando no seu nome, ou pesquise abaixo:</h5>      
    <table id="example" class="table table-striped">
        <thead>
    	<tr>
            <hr>
            <th>ID </th>
            <th>NOME </th>
            <th>EMAIL </th>
            <th>TELEFONE </th>
            <th>PROFISSÃO </th>
            <th>ESPECIALIDADE </th>
        </tr>
        </thead>
        <tbody>
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
    </tbody>
    </table>
@include('admin.includes.modelo')    
@endsection
<script type="text/javascript">
  function modalshow($consult){
      $("#modalshow").modal();
    }
</script>
