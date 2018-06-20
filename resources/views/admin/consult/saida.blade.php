@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="box">
        <div class="box-header">
            <a href="{{ route('balance.deposit')}}" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Solicitação</a>
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
        @forelse($consults as $consult)
            <tr>
            <td>{{ $consult->id}} </td>
            <td>{{ $consult->status}} </td>
            <td>{{ $consult->descriçao}} </td>
            <td>{{$consult->user->name}} </td>
            <td>{{$consult->municipio}} </td>
            </tr>
    	@empty
    	<p>Nenhum solicitação realizada</p>
    	@endforelse
        </table>
@endsection