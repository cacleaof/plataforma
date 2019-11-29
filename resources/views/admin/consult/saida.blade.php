@extends('adminlte::page')

@section('content_header')
<div class="box">
    <p><strong>Usuário Logado: </strong>{{auth()->user()->name }}</p>
</div>
@stop

@section('content')
        <table id="example" class="table table-striped">
            <thead>
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
            <th>TEMPO </th>
            <th>PACIENTE </th>
            </tr>
            </thead>
            <tbody>
        @forelse($consults as $consult)
            <tr>
            <td>{{ $consult->id}} </td>
            <td>{{ showstat($consult->status) }} </td>
            <td>{{ substr($consult->servico, 18, 40) }} </td>
            <td>{{ substr($consult->consulta, 0, 50) }} </td>
            <td>{{ $consult->image}} </td>
            <td>{{ $consult->municipio}} </td>
            <td>{{ $consult->uf}} </td>
            <td>{{ $consult->sol_name}} </td>
            <td>{{ tempo($consult->created_at) }} </td>
            <td>{{$consult->paciente}} </td>
            </tr>
    	@empty
    	<p>Nenhum solicitação realizada</p>
    	@endforelse
            </tbody>
        </table>
@endsection