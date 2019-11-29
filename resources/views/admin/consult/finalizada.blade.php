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
            <th>MUNICIPIO </th>
            <th>UF</th>
            <th>NOME SOLICITANTE </th>
            <th>TELECONSULTOR </th>
            <th>TEMPO </th>
            <th>PACIENTE </th>
            </tr>
            </thead>
            <tbody>
        @forelse($consults as $consult)
            <tr>
            <td>{{ $consult->id}} </td>
            <td>{{ showstat($consult->status) }} </td>
            <td>{{ $consult->servico }} </td>
            <td>{{ $consult->consulta }} </td>
            <td>{{ $consult->municipio}} </td>
            <td>{{ $consult->uf}} </td>
            <td>{{$consult->user->name}} </td>
            <td>{{$consult->cons_id}} </td>
            <td>{{$consult->tempo}} </td>
            <td>{{$consult->paciente}} </td>
            </tr>
    	@empty
    	<p>Nenhuma solicitação Finalizada</p>
    	@endforelse
            </tbody>
        </table>
    </div>
@endsection