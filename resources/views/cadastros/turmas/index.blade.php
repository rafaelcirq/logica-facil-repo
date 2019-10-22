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
<!--begin: Search Form -->
<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
    <div class="row align-items-center">
        <div class="col-xl-8 order-2 order-xl-1">
            <div class="row align-items-center">
                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                    <div class="kt-input-icon kt-input-icon--left">
                        <input type="text" class="form-control" placeholder="Procurar..." id="busca_geral">
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
                            <select class="form-control bootstrap-select" id="filtro_instituicao">
                                <option value="">Todas</option>
                                @foreach ($instituicoes as $i)
                                {{-- <option value="{{ $i->nome }}">{{ $i->nome }}</option> --}}
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-- @if (Auth::user()->tipo == "Professor") --}}
                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile add-button">
                    <div class="kt-form__group kt-form__group--inline">
                        <button type="button" class="btn btn-outline-brand btn-elevate btn-pill"><i
                                class="flaticon2-plus-1"></i> Nova Turma</button>&nbsp;
                    </div>
                </div>
                {{-- @endif --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('datatable')
<div class="kt-portlet__body kt-portlet__body--fit">

    <!-- datatable -->
    <div class="kt-datatable" id="turmas_datatable"></div>

</div>
@endsection