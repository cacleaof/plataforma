@extends('adminlte::page')

@section('title', 'Home Dashboard')

@section('content_header')
<div class="box">
    <h4><strong>Usuário Logado: </strong>{{auth()->user()->name }}</h4>
    @include('admin.includes.alerts')
</div>
@stop

@section('content')
    <h4>Bem vindo a Plataforma de Telessaúde da Secretaria de Saúde de Pernambuco!</h4>

    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3></h3>
               <p>Caixa de Entrada</p>
            </div>
            <div class="icon">
                <i class="fa fa-fw fa-sign-in"></i>
            </div>
            <a href="admin/entrada" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3></h3>

                <p>Caixa de Saída</p>
            </div>
            <div class="icon">
                <i class="fa fa-fw fa-sign-out"></i>
            </div>
            <a href="admin/saida" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3></h3>

                <p>Caixa de Finalizadas</p>
            </div>
            <div class="icon">
                <i class="fa fa-fw fa-check"></i>
            </div>
            <a href="finalizadas" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
@stop