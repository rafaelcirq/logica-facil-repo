@extends('layouts.base')

@section('importar')
<script src="{{ asset('js/cadastros/turmas/index-professor-alunos.js') }}"></script>
<script src="{{ asset('js/cadastros/turmas/index-professor-testes.js') }}"></script>
@endsection

@section('titulo')
{{ $turma->nome }}
@endsection

@section('subtitulo')
{{ $turma->instituicao->nome }}
@endsection

@section('conteudo')
<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_5_1" role="tab">Alunos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#kt_tabs_5_2" role="tab">Testes</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="kt_tabs_5_1" role="tabpanel">
        @include('cadastros.turmas.index-professor-alunos')
    </div>
    <div class="tab-pane" id="kt_tabs_5_2" role="tabpanel">
        @include('cadastros.turmas.index-professor-testes')
    </div>
</div>
@endsection