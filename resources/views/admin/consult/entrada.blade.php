@extends('adminlte::page')

@section('content_header')
<div class="box">
    <p><strong>Usuário Logado: </strong>{{auth()->user()->name }}</p>
</div>
@stop
@section('content')
    @include('admin.includes.alerts')
    @if ( !$solS )
    <div class="container">
        <div class="box">
        <div class="box-header">
            <a href="{{ route('consult.nova')}}" class="btn btn-primary"><i class="fas fa-shopping-cart"></i>TeleConsultoria</a>
        </div>
        </div>
    </div>
    @endif
        <table class="table table-striped">
            <tr>
            <hr>
            <th>ID </th>
            <th>STATUS </th>
            <th>SERVIÇO </th>
            <th>DESCRIÇÃO </th>
            <th>ARQUIVO </th>
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
          <p>PERFIL:SOLICITANTE</p>     
         @forelse($consults as $consult)
            <td><a href="{{ route('consult.regular')}}"> {{ $consult->id}}</a></td>
            <td>{{ showstat($consult->status) }} </td>
            <td>{{ $consult->serviço}} </td>
            <td>{{ $consult->consulta}} </td>
            <td>{{ $consult->image}} </td>
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
        @if ($consreg!=null)
        <p>PERFIL:REGULADOR</p> 
        @forelse($consreg as $reg)  
        <form>      
            <td><a href="{{ route('consult.regular', ['sid' => $reg->id]) }}">{{ $reg->id}}</a> </td>
            <td>{{ showstat($reg->status) }} </td>
            <td>{{ $reg->serviço}} </td>
            <td>{{ $reg->consulta}} </td>
            <td>{{ $reg->image}} </td>
            <td>{{ $reg->municipio}} </td>
            <td>{{ $reg->uf}} </td>
            <td>{{$reg->user->name}} </td>
            <td>{{$reg->cons_id}} </td>
            <td>{{$reg->cons_name}} </td>
            <td>{{$reg->tempo}} </td>
            <td>{{$reg->paciente}} </td>
            </tr>   
        </form>    
        @empty
        <p>Você não tem regulações na sua caixa de entrada</p>
        @endforelse
        @endif
        @if ($conscons!=null)
        <p>PERFIL:CONSULTOR</p> 
        @forelse($conscons as $con)  
        <form>      
            <td><a href="{{ route('consult.selecresp', ['sid' => $con->id, 'cid' => $con->user_id]) }}">{{ $con->id }}</a> </td>
            <td>{{ showstat($con->status) }} </td>
            <td>{{ $con->serviço}} </td>
            <td>{{ $con->consulta}} </td>
            <td>{{ $con->image}} </td>
            <td>{{ $con->municipio}} </td>
            <td>{{ $con->uf}} </td>
            <td>{{$con->user->name}} </td>
            <td>{{$con->cons_id}} </td>
             <td>{{$con->cons_name}} </td>
            <td>{{$con->tempo}} </td>
            <td>{{$con->paciente}} </td>
            </tr>   
        </form>    
        @empty
        <p>Você não tem Consultorias na sua caixa de entrada</p>
        @endforelse
        @endif
         </table>
@endsection