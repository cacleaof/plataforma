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
        <table>
            <tr>
            <hr>
            <th>ID </th>
            <th>STATUS </th>
            <th>DESCRIÇÃO </th>
            <th>NOME SOLICITANTE </th>
            <th>MUNICIPIO </th>
            </tr> 
            <tr>
         @forelse($consults as $consult)         
            <td>{{ $consult->id}} </td>
            <td>{{ $consult->status}} </td>
            <td>{{ $consult->consulta}} </td>
            <td>{{$consult->user->name}} </td>
            <td>{{$consult->municipio}} </td>
            </tr>    
        @empty
        <p>Você não tem consultas na sua caixa de entrada</p>
        @endforelse
         </table>
@endsection