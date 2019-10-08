@extends('layouts.base')

@section('importar')
<script src="{{ asset('js/cadastros/turmas/index.js') }}"></script>
<script src="{{ asset('js/layout/select2.js') }}"></script>
@endsection

@section('titulo')
Minhas Turmas
@endsection

@section('subtitulo')
Listagem
@endsection

@section('conteudo')
<div class="row align-items-center">
    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
        <div class="kt-input-icon kt-input-icon--left">
            <input type="text" class="form-control" placeholder="Pesquisar..." id="generalSearch">
            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                <span><i class="la la-search"></i></span>
            </span>
        </div>
    </div>
    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
        <div class="kt-form__group kt-form__group--inline">
            <div class="kt-form__label">
                <label>Instituição:</label>
            </div>
            <div class="kt-form__control">
                <select class="form-control bootstrap-select select2" id="kt_form_instituicao">
                    <option value="">Todas</option>
                    @foreach ($instituicoes as $i)
                    <option value="{{ $i->nome }}">{{ $i->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
        <div class="kt-form__group kt-form__group--inline">
            <button type="button" class="btn btn-brand btn-icon-sm" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="flaticon2-plus"></i>
                Nova Turma
            </button>
        </div>
    </div>
</div>

<!--begin: Datatable -->
<div class="kt-datatable" id="json_data"></div>
@endsection