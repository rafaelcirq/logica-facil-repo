@extends('layouts.base')

@section('importar')
<script src="{{ asset('js/auth/user-informacoes.js') }}"></script>
{{-- <link href="{{ asset('css/var/var.css') }}" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('titulo')
Meu Perfil
@endsection

@section('subtitulo')
Editar
@endsection

@section('conteudo')
<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_5_1" role="tab">Informações</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#kt_tabs_5_2" role="tab">Alterar Senha</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="kt_tabs_5_1" role="tabpanel">
        @include('auth.user-informacoes')
    </div>
    <div class="tab-pane" id="kt_tabs_5_2" role="tabpanel">
        @include('auth.user-alterar-senha')
    </div>
</div>
@endsection