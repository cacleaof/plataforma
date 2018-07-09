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
            <h3>Resposta da Teleconsultoria</h3>
        </div>
        <div class="box-body">
            <form method="POST" action="{{ route('consult.storecons', ['sid' => $consult->id])}}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                <div class="form-row">
                    @include('admin.includes.alerts')
                        <div class="form-group">
                        <textarea type="text" name="resposta" rows="5" cols="80" placeholder="Responda a Teleconsultoria" class="form-control"></textarea>
                        <div class="form-row">
                            <label for="file">Arquivos Anexos:</label>
                            <input type="file" name="arquivo[]" id="file" multiple>
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                        </div>
                        <div class="form-row" >
                            <label>Leitura Recomendada & DECs – descritores em ciências da saúde</label>
                        </div>
                        <div class="form-group col-xs-12" >
                            <input type="text" class="form-control" name="l_recom" placeholder="Leitura Recomendada">
                        </div>     
                        <div class="form-group col-xs-4">
                            <input type="text" name="p_chave1" placeholder="DECs – descritores em ciências da saúde" class="form-control">
                        </div>
                        <div class="form-group col-xs-4">
                            <input type="text" name="p_chave2" placeholder="DECs – descritores em ciências da saúde" class="form-control">
                        </div>
                        <div class="form-group col-xs-4">
                            <input type="text" name="p_chave3" placeholder="DECs – descritores em ciências da saúde" class="form-control">
                        </div>
                        <div class="form-row" >
                        <div class="form-group">
                        <button type="submit" class="btn btn-success">Enviar</button> 
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div> 	
@stop