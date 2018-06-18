@section('content')
    <div class="container">
    	@forelse($posts as $post)
    	<h1>{{ $post->status}}</h1>
    	<p>{{ $post->descriçao}}</p>
    	<p>{{ $post->municipio}}</p>
    	<hr>
    	@empty
    	<p>Nenhum post cadastrado</p>
    	@endforelse
    </div>
@endsection