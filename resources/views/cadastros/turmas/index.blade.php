@extends('layouts.base')

@section('importar')
<script src="{{ asset('js/cadastros/turmas/index.js') }}"></script>
@endsection

@section('titulo')
Minhas Turmas
@endsection

@section('subtitulo')
Listagem
@endsection

@section('conteudo')
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
                @if(Auth::user()->tipo == "Professor")
                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile add-button">
                    <div class="kt-form__group kt-form__group--inline">
                        <a href="{{ route('turmas.create') }}">
                            <button type="button" class="btn btn-outline-brand btn-elevate btn-pill"><i
                                    class="flaticon2-plus-1"></i>Nova Turma</button>&nbsp;
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!--begin: Datatable -->
<div class="kt-datatable" id="turmas_datatable"></div>
@endsection