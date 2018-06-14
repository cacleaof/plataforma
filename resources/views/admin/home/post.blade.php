@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="box">
        <div class="box-header">
            <a href="{{ route('balance.deposit')}}" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Solicitação</a>
        </div>
    	@forelse($posts as $post)
    	<h3>{{ $post->status}}</h3>
    	<p>{{ $post->descriçao}}</p><br>
    	<b>Author: {{$post->user->name}}</b>
    	<hr>
    	@empty
    	<p>Nenhum post cadastrado</p>
    	@endforelse
    </div>
@endsection