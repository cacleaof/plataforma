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
            <a href="{{ route('admin.nova')}}" class="btn btn-primary"><i class="fas fa-shopping-cart"></i>TeleConsultoria</a>
        </div>
        </div>
    </div>
    @forelse($sol as $array) 
        @if ( $array->perfil == 'S') 
        @forelse($consults as $consult) 
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
            <td>{{ $consult->id}} </td>
            <td>{{ $consult->status}} </td>
            <td>{{ $consult->descriçao}} </td>
            <td>{{$consult->user->name}} </td>
            <td>{{$consult->municipio}} </td>
            </tr>
        @empty
    	@endforelse     
        </table>
        @else
        <p>Não encontrado</p>
        @endif
        @empty
        @endforelse
@endsection