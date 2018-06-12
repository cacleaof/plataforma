@extends('adminlte::page')

@section('content')
    <div class="container">
    	@forelse($posts as $post)
    	<h1>{{ $post->title}}</h1>
    	<p>{{ $post->description}}</p><br>
    	<b>Author: {{$post->user->name}}</b>
    	<hr>
    	@empty
    	<p>Nenhum post cadastrado</p>
    	@endforelse
    </div>
@endsection