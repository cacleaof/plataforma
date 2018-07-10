@extends('adminlte::page')

@section('content_header')
<div class="box">
    <p><strong>Usuário Logado: </strong>{{auth()->user()->name }}</p>
</div>
@stop

@section('content')
        <form method="POST" action="{{ route('consult.wordssearch')}}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
            <div class="form-row" >
                <input type="text" class="form-control" name="words" placeholder="Leitura Recomendada">{{$params}}
            </div>   
            <div class="form-row" >
                        <div class="form-group">
                        <button type="submit" class="btn btn-success">Enviar</button> 
            </div>
        </form>
@endsection