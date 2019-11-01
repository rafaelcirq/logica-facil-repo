@extends('layouts.base')

@section('importar')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{ asset('js/cadastros/testes/reply.js') }}"></script>
@endsection

@section('titulo')
{{ $teste->nome }}
@endsection

@section('subtitulo')
Visualização
@endsection

@section('conteudo')
@foreach ($teste->perguntas as $pergunta)
<div class="form-group row">
    <div class="col-lg-12 form-group-sub">
        <label class="form-control-label">
            {{ $pergunta->texto }}
        </label>
        <div class="kt-radio-list">
            @foreach($pergunta->alternativas as $alternativa)
            <label class="kt-radio">
                <input type="radio" disabled
                @if($alternativa->is_correta)
                checked
                @endif
                > {{ $alternativa->texto }}
                <span></span>
            </label>
            @endforeach
        </div>
    </div>
</div>
@endforeach
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <a href="/turmas/{{ $teste->turma->id }}" class="btn btn-secondary">Voltar</a>
    </div>
</div>
@endsection