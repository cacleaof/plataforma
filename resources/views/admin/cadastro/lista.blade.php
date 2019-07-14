@extends('adminlte::page')

@section('content_header')
<div class="box">
    <p><strong>Usuário Logado: </strong>{{auth()->user()->name }}</p>
</div>
@stop
@section('content')
    @include('admin.includes.alerts')
        <table class="table table-striped">
            <tr>
            <th>ID </th>
            <th>CPF </th>
            <th>NOME </th>
            <th>EMAIL </th>
            <th>CNS </th>
            <th>CELULAR  </th>
            <th>CIDADE</th>
            <th>VINCULO </th>
            <th>PROFISSÃO </th>
            <th>CONSELHO </th>
            <th>SEXO </th>
            </tr>   
         @forelse($users as $user)
            <td><a href="{{ route('admin.cadastro.usuario', ['cid' => $user->id] )}}"> {{ $user->id}}</a></td>
            <td>{{ $user->cpf }} </td>
            <td>{{ $user->name}} </td>
            <td>{{ $user->email}} </td>
            <td>{{ $user->cns}} </td>
            <td>{{ $user->telefone_celular}} </td>
            <td>{{ $user->cidade}} </td>
            <td>{{ $user->nome_fantasia}} </td>
            <td>{{ $user->nome_cargo}} </td>
            <td>{{ $user->conselho }} </td>
            <td>{{ $user->sexo}} </td>
            </tr>    
        @empty
        <p>Sistema sem usuários</p>
        @endforelse
                 </table>
                 {!! $users->links() !!}
@endsection