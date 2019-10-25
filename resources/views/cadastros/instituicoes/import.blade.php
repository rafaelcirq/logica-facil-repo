@extends('layouts.base')

@section('importar')
<script src="{{ asset('js/cadastros/instituicoes/import.js') }}"></script>
@endsection

@section('titulo')
Minhas Instituições
@endsection

@section('subtitulo')
Importar
@endsection

@section('conteudo')

{{ Form::open(['method' => 'POST', 'class' => 'kt-form', 'id' => "import-form", 'route' => ['minhas-instituicoes.store' ]]) }}

@csrf
<div class="form-group row">
    <div class="col-lg-6 form-group-sub">
        <label class="form-control-label">
            Tipo:
        </label>
        <select class="form-control kt-select2" id="tipo" name="">
            <option value="1">Ensino Básico</option>
            <option value="2" selected>Ensino Superior</option>
        </select>
    </div>
    <div class="col-lg-6 form-group-sub">
        <label class="form-control-label">
            Estado:
        </label>
        <select class="form-control kt-select2" id="estado" name="">
            <option value="">Nenhum</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-lg-12 form-group-sub">
        <label class="form-control-label">
            Instituições:
        </label>
        <select class="form-control kt-select2" id="instituicoes" name="instituicoes[]" multiple>
        </select>
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button class="btn btn-secondary">Cancelar</button>
    </div>
</div>

{{ Form::close() }}

@endsection