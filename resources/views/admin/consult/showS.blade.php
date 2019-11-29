@extends('adminlte::page')

@section('title', 'Pesquisa de Satisfação')

@section('content_header')
    <h1>Pesquisa de Satisfação</h1>
    <ol class='breadcrumb'>
    	<li><a ref="">Dashboard</a></li>
    	<li><a ref="">Consult</a></li>
    	<li><a ref="">Entrada</a></li>
    </ol>
@stop
@section('content')
    <div class="container">
        @include('admin.includes.alerts')
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Teleconsultoria</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                    <div class="box-body">

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
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Teleconsultoria</h3>
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
                        <div class="form-group">
                            <a href="{{ route('consult.nova')}}" class="btn btn-success"><i class="fas fa-pencil"></i>Replica da Consultoria</a>
                        </div>

                    </div>
                    <!-- /.box-body -->


                </form>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Avaliação da Satisfação</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('consult.show_store', ['sid' => $consult->id]) }}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="form-row">
                    @include('admin.includes.alerts')
                    <div class="form-group col-md-6">
                        <label>Sua dúvida foi esclarecida?</label>
                        <select type="text" class="form-control" name="av_duvida">
                            <option value="">Selecione</option>
                            <option value="Sim, totalmente">Sim, totalmente</option>
                            <option value="Sim, parcialmente">Sim, parcialmente</option>
                            <option value="Não foi esclarecida">Não foi esclarecida</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Gostaríamos de saber sua opinião sobre o serviço?</label>
                        <select type="text" class="form-control" name="avaliaçao">
                            <option value="">Selecione</option>
                            <option value="5">Muito Satisfeito</option>
                            <option value="4">Satisfeito</option>
                            <option value="3">Indiferente</option>
                            <option value="2">Insatisfeito</option>
                            <option value="1">Muito Insatisfeito</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <textarea type="text" name="av_comment" rows="5" cols="80" placeholder="Você gostaria de fazer algum comentário, crítica, elogio, sugestão ou reclamação? Caso negativo escreva não!" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </form>
    </div>

    @include('admin.includes.modelo')
@endsection
<script type="text/javascript">
    function modalshow($consult){
      $("#modalshow").modal();
    }
</script>