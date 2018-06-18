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
        @forelse($posts as $post)
            <tr>
            <td>{{ $post->id}} </td>
            <td>{{ $post->status}} </td>
            <td>{{ $post->descriçao}} </td>
            <td>{{$post->user->name}} </td>
            <td>{{$post->municipio}} </td>
            </tr>
    	@empty
    	<p>Nenhum solicitação realizada</p>
    	@endforelse
        </table>
    </div>
@endsection