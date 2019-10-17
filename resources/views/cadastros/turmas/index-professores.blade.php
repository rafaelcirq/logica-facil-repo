@extends('layouts.base')

@section('importar')
<script src="{{ asset('js/cadastros/turmas/index-professores.js') }}"></script>
@endsection

@section('titulo')
{{ $turma->nome }} - {{ $turma->instituicao->nome }}
@endsection

@section('subtitulo')
{{-- Listagem --}}
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

        <input id="turmaId" value="{{ $turma->id }}" hidden>

        <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
            <div class="row align-items-center">
                <div class="col-xl-8 order-2 order-xl-1">
                    <div class="row align-items-center">

                        <div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
                            <div class="col-md-6 kt-input-icon kt-input-icon--left">
                                <input type="text" class="form-control" placeholder="Procurar..." id="busca_geral">
                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                    <span><i class="la la-search"></i></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 kt-margin-b-20-tablet-and-mobile add-button">
                                <div class="kt-form__group kt-form__group--inline">
                                    <button type="button" class="btn btn-outline-brand btn-elevate btn-pill"><i
                                            class="flaticon2-plus-1"></i> Adicionar Aluno</button>&nbsp;
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>

        <!--begin: Datatable -->
        <div class="kt-datatable" id="alunos_turma_datatable"></div>

    </div>
    <div class="tab-pane" id="kt_tabs_5_2" role="tabpanel">
        Testes
    </div>
</div>
@endsection