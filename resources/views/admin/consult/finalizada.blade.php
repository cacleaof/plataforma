@extends('adminlte::page')

@section('content_header')
<div class="box">
    <p><strong>Usuário Logado: </strong>{{auth()->user()->name }}</p>
</div>
@stop

@section('content')
    <table id="example" class="table display">
        <thead>
        <tr>
            <th>ID </th>
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
        </tr>
        </thead>
        <tbody>
        <tr>
            @forelse($consults as $consult)
                <td>{{ $consult->id}}</td>
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
        </tr>
        @empty
            <p>Nenhum solicitação realizada</p>
        @endforelse

        </tbody>

    </table>


@endsection