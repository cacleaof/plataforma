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
            <a href="{{ route('admin.home.solitaçao')}}" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Solicitação</a>
        </div>
        </div>
    </div>
    @forelse($sol as $array) 
        @if ( $array->perfil == 'S') 
        @forelse($posts as $post) 
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
            <td>{{ $post->id}} </td>
            <td>{{ $post->status}} </td>
            <td>{{ $post->descriçao}} </td>
            <td>{{$post->user->name}} </td>
            <td>{{$post->municipio}} </td>
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