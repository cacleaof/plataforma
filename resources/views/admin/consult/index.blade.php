@extends('adminlte::page')

@section('title', 'Home Dashboard')

@section('content_header')
<div class="box">
    <h3><strong>Usuário Logado: </strong>{{auth()->user()->name }}</h3>
    @include('admin.includes.alerts')
</div>
@stop

@section('content')
    <h2>Bem vindo a Plataforma de Telessaúde da Secretaria de Saúde de Pernambuco!</h2>
@stop