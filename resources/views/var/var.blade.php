@extends('layouts.base')

@section('importar')
<script src="{{ asset('js/var/var.js') }}"></script>
<link href="{{ asset('css/var/var.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('titulo')
VAR
@endsection

@section('subtitulo')
Conceito de Variável
@endsection

@section('conteudo')
<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_5_1" role="tab">Instruções</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#kt_tabs_5_2" role="tab">Var</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#kt_tabs_5_3" role="tab">Compilador</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="kt_tabs_5_1" role="tabpanel">
        @include('var.instrucoes')
    </div>
    <div class="tab-pane" id="kt_tabs_5_2" role="tabpanel">
        @include('var.dinamica')
    </div>
    <div class="tab-pane" id="kt_tabs_5_3" role="tabpanel">
        @include('var.compilador')
    </div>
</div>
@endsection