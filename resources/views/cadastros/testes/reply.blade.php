@extends('layouts.base')

@section('importar')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{ asset('js/cadastros/testes/reply.js') }}"></script>
@endsection

@section('titulo')
{{ $teste->nome }}
@endsection

@section('subtitulo')
Responder
@endsection

@section('conteudo')
{{ Form::open(['method' => 'POST', 'class' => 'kt-form', 'id' => "resultado_form", 'route' => ['resultados.store']]) }}

<input name="testes_id" value="{{ $teste->id }}" hidden>
<input id="turma_id" value="{{ $teste->turma->id }}" hidden>

@foreach ($teste->perguntas as $pergunta)
<div class="form-group row">
    <div class="col-lg-12 form-group-sub">
        <label class="form-control-label">
            {{ $loop->iteration }}. {{ $pergunta->texto }}
        </label>
        <div class="kt-radio-list">
            @foreach($pergunta->alternativas as $alternativa)
            <label class="kt-radio">
                <input type="radio" class="teste" name="respostas[{{ $pergunta->id }}]" value="{{ $alternativa->id }}"> {{ $alternativa->texto }}
                <span></span>
            </label>
            @endforeach
        </div>
        {{-- @error('email') --}}
        <label class="invalid-feedback error" generated="true">Escolha uma alternativa para esta pergunta.</label>
        {{-- @enderror --}}
    </div>
</div>
@endforeach
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">Enviar Respostas</button>
        <a href="/turmas/{{ $teste->turma->id }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>
{{ Form::close() }}
@endsection