@extends('adminlte::page')

@section('content_header')
<div class="box">
    <p><strong>Usuário Logado: </strong>{{auth()->user()->name }}</p>
</div>
@stop
@section('content')
    <div class="container">
        <div class="box">
        <div class="box-header">
            <a href="{{ route('consult.nova')}}" class="btn btn-primary"><i class="fas fa-shopping-cart"></i>TeleConsultoria</a>
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
            <th>TELECONSULTOR </th>
            <th>TEMPO </th>
            <th>PACIENTE </th>
            </tr> 
            <tr>
         @if ($consults!=null)  
          <p>PERFIL:SOLICITANTE</p>     
         @forelse($consults as $consult)

            <td><a href=""> {{ $consult->id}}</a></td>
            <td>{{ $consult->status}} </td>
            <td>{{ $consult->serviço}} </td>
            <td>{{ $consult->consulta}} </td>
            <td>{{ $consult->municipio}} </td>
            <td>{{ $consult->uf}} </td>
            <td>{{$consult->user->name}} </td>
            <td>{{$consult->cons_id}} </td>
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
            <td><a href="">{{ $reg->id}}</a> </td>
            <td>{{ $reg->status}} </td>
            <td>{{ $reg->serviço}} </td>
            <td>{{ $reg->consulta}} </td>
            <td>{{ $reg->municipio}} </td>
            <td>{{ $reg->uf}} </td>
            <td>{{$reg->user->name}} </td>
            <td>{{$reg->cons_id}} </td>
            <td>{{$reg->tempo}} </td>
            <td>{{$reg->paciente}} </td>
            </tr>    
        @empty
        <p>Você não tem regulações na sua caixa de entrada</p>
        @endforelse
        @endif
         </table>
@endsection