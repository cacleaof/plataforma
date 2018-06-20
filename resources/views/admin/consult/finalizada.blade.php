@extends('adminlte::page')

@section('content')
            <div class="box">
            <h3><strong>Usuário Logado: </strong>{{auth()->user()->name }}</h3>
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
        @if($consult->status == 'F')
            <tr>
            <td>{{ $consult->id}} </td>
            <td>{{ $consult->status}} </td>
            <td>{{ $consult->descriçao}} </td>
            <td>{{$consult->user->name}} </td>
            <td>{{$consult->municipio}} </td>
            </tr>
        @endif
    	@empty
    	<p>Nenhum solicitação realizada</p>
    	@endforelse
        </table>
    </div>
@endsection