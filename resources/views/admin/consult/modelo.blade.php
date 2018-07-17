
{{-- calling layouts \ modelo.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <h1>Detalhamento</h1>
  </div>
</div>
<div class="row">
  <div class="table table-responsive">
    <table class="table table-bordered" id="table">
        <tr>
            <hr>
            <th width="150px">ID </th>
            <th>DATA </th>
            <th>STATUS </th>
            <th>SERVIÇO </th>
            <th>DESCRIÇÃO </th>
            <th>MUNICIPIO </th>
            <th>UF</th>
            <th>NOME SOLICITANTE </th>
            <th>REGULADOR</th>
        </tr> 
        <tr> 
            <td>{{ $consult->id}}</a></td>
            <td>{{ $consult->created_at}}</a></td>
            <td>{{ showstat($consult->status) }} </td>
            <td>{{ $consult->serviço}} </td>
            <td>{{ $consult->consulta}} </td>
            <td>{{ $consult->municipio}} </td>
            <td>{{ $consult->uf}} </td>
            <td>{{$consult->sol_name}} </td>
            <td>{{$consult->reg_name}} </td>
        </tr>  
        <tr>
            <hr>
            <th>TELECONSULTOR </th>
            <th>TEMPO </th>
            <th>PACIENTE </th>
            <th>QUEIXA </th>
            <th>INSTITUIÇÃO </th>
            <th>CIDADE </th>
            <th>AREA INFORMADA </th>
            <th>devolutiva </th>
            <th>dev_reg </th>
        </tr>
        <tr>
            <td>{{$consult->cons_name}} </td>
            <td>{{ tempo($consult->created_at) }} </td>
            <td>{{$consult->paciente}} </td>
            <td>{{$consult->queixa}} </td>
            <td>{{$consult->instituiçao}} </td>
            <td>{{$consult->municipio_sol}} </td>
            <td>{{$consult->area}} </td>
            <td>{{$consult->devolutiva}} </td>
            <td>{{$consult->dev_reg}} </td>
        </tr>
            <th>resposta </th>
            <th>l_recom </th>
            <th>ciap </th>
            <th>dec1 </th>
            <th>dec2 </th>
            <th>dec3 </th>
            <th>av_duvida </th>
            <th>avaliaçao </th>
            <th>av_commen </th>
        <tr>
            <td>{{$consult->resposta}} </td>
            <td>{{$consult->l_recom}} </td>
            <td>{{$consult->ciap}} </td>
            <td>{{$consult->dec1}} </td>
            <td>{{$consult->dec2}} </td>
            <td>{{$consult->dec3}} </td>
            <td>{{$consult->av_duvida}} </td>
            <td>{{$consult->avaliaçao}} </td>
            <td>{{$consult->av_commen}} </td>
        </tr>
    </table>
  </div>
<div id="create" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
          <div class="form-group row add">
            <label class="control-label col-sm-2" for="title">Title :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="title" name="title"
              placeholder="Your Title Here" required>
              <p class="error text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="body">Body :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="body" name="body"
              placeholder="Your Body Here" required>
              <p class="error text-center alert alert-danger hidden"></p>
            </div>
          </div>
        </form>
      </div>
          <div class="modal-footer">
            <button class="btn btn-warning" type="submit" id="add">
              <span class="glyphicon glyphicon-plus"></span>Save Post
            </button>
            <button class="btn btn-warning" type="button" data-dismiss="modal">
              <span class="glyphicon glyphicon-remobe"></span>Close
            </button>
          </div>
    </div>
  </div>
</div></div>
{{-- Modal Form Show POST --}}
<div id="show" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
                  </div>
                    <div class="modal-body">
                    <div class="form-group">
                      <label for="">ID :</label>
                      <b id="i"/>
                    </div>
                    <div class="form-group">
                      <label for="">Title :</label>
                      <b id="ti"/>
                    </div>
                    <div class="form-group">
                      <label for="">Body :</label>
                      <b id="by"/>
                    </div>
                    </div>
                    </div>
                  </div>
</div>
      </div>
      
    </div>
  </div>
</div>
@endsection
