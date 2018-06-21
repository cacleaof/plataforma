@extends('adminlte::page')

@section('content_header')
<div class="box">
    <p><strong>Usuário Logado: </strong>{{auth()->user()->name }}</p>
</div>
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
            <th>TELECONSULTOR </th>
            <th>TEMPO </th>
            <th>PACIENTE </th>
            </tr>
        @forelse($consults as $consult)
            <tr>
            <td>{{ $consult->id}} </td>
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
    	<p>Nenhum solicitação realizada</p>
    	@endforelse
        </table>
@endsection