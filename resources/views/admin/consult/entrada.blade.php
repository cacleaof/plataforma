@extends('adminlte::page')

@section('content_header')
<div class="box">
    <p><strong>Usuário Logado: </strong>{{auth()->user()->name }}</p>
</div>
@stop
@section('content')
    @include('admin.includes.alerts')
    @if ( perfil()['solS'] )
    <div class="container">
        <div class="box">
        <div class="box-header">
            <a href="{{ route('consult.nova')}}" class="btn btn-primary"><i class="fa fa-fw fa-wechat"></i> TeleConsultoria</a>
            <a href="{{ route('consult.novaecg')}}" class="btn btn-danger"><i class="fa fa-fw fa-heartbeat"></i> Tele-ECG</a>
        </div>
        </div>
    </div>
    @endif
    @if($consults!=null)
        <table id="example" class="table display">
            <thead>
            <tr>
                <th>STATUS </th>
                <th>SERVIÇO </th>
                <th>DESCRIÇÃO </th>
                <th>ARQUIVO </th>
                <th>MUNICIPIO </th>
                <th>UF</th>
                <th>NOME SOLICITANTE </th>
                <th>TELECONSULTOR </th>
                <th>TEMPO </th>
                <th>PACIENTE </th>
                <th>VISUALIZAR </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @if ($consults!=null)
                    <p>PERFIL:SOLICITANTE</p>
                    @forelse($consults as $consult)

                        <td>{{ showstat($consult->status) }} </td>
                        <td>{{ $consult->servico}} </td>
                        <td>{{ substr($consult->consulta, 0, 200) }} </td>
                        <td>{{ $consult->image}} </td>
                        <td>{{ $consult->municipio}} </td>
                        <td>{{ $consult->uf}} </td>
                        <td>{{$consult->user->name}} </td>
                        <td>{{$consult->cons_name}} </td>
                        <td>{{ tempo($consult->created_at) }} </td>
                        <td>{{$consult->paciente}} </td>
                        <td><a href="{{ route('consult.showS', ['sid' => $consult->id]) }}"><i class="fa fa-fw fa-search"></i></a></td>
            </tr>
            @empty
                <p>Você não tem consultas na sua caixa de entrada</p>
                @endforelse
                {!! $consults->links() !!}
                @endif
                </tr>
            </tbody>
        </table>
        @endif


    <!-- table regulador-->
    @if($consreg!=null)
        <table id="example" class="table display">
            <thead>
            <tr>
                <th>STATUS </th>
                <th>SERVIÇO </th>
                <th>DESCRIÇÃO </th>
                <th>ARQUIVO </th>
                <th>MUNICIPIO </th>
                <th>UF</th>
                <th>NOME SOLICITANTE </th>
                <th>TELECONSULTOR </th>
                <th>TEMPO </th>
                <th>PACIENTE </th>
                <th>VISUALIZAR </th>
            </tr>
            </thead>
            <tbody>

                @forelse($consreg as $reg)
                    <tr>

                        <td>{{ showstat($reg->status) }} </td>
                        <td>{{ $reg->servico}} </td>
                        <td>{{ substr($reg->consulta, 0, 200) }} </td>
                        <td>{{ $reg->image}} </td>
                        <td>{{ $reg->municipio}} </td>
                        <td>{{ $reg->uf}} </td>
                        <td>{{$reg->user->name}} </td>
                        <td>{{$reg->cons_name}} </td>
                        <td>{{ tempo($reg->created_at) }} </td>
                        <td>{{$reg->paciente}} </td>
                        <td><a href="{{ route('consult.regular', ['sid' => $reg->id] ) }}"><i class="fa fa-fw fa-search"></i></a> </td>
                    </tr>

                @empty
                    <p>Você não tem regulações na sua caixa de entrada</p>
                @endforelse
                {!! $consreg->links() !!}

            </tbody>
        </table>
        @endif

    <!---->
    @if ($conscons!=null)
        <table id="example" class="table display">
            <thead>
            <tr>
                <th>STATUS </th>
                <th>SERVIÇO </th>
                <th>DESCRIÇÃO </th>
                <th>ARQUIVO </th>
                <th>MUNICIPIO </th>
                <th>UF</th>
                <th>NOME SOLICITANTE </th>
                <th>TELECONSULTOR </th>
                <th>TEMPO </th>
                <th>PACIENTE </th>
                <th>VISUALIZAR </th>
            </tr>
            </thead>
            <tbody>

            @forelse($conscons as $con)
                <tr>
                    <td>{{ showstat($con->status) }} </td>
                    <td>{{ $con->servico}} </td>
                    <td>{{ $con->consulta}} </td>
                    <td>{{ $con->image}} </td>
                    <td>{{ $con->municipio}} </td>
                    <td>{{ $con->uf}} </td>
                    <td>{{$con->user->name}} </td>
                    <td>{{$con->cons_name}} </td>
                    <td>{{ tempo($con->created_at) }} </td>
                    <td>{{$con->paciente}} </td>
                    <td><a href="{{ route('consult.selecresp', ['sid' => $con->id, 'cid' => $con->user_id]) }}"><i class="fa fa-fw fa-search"></i></a> </td>
                </tr>

            @empty
                <p>Você não tem regulações na sua caixa de entrada</p>
            @endforelse
            {!! $conscons->links() !!}

            </tbody>
        </table>
    @endif


@endsection