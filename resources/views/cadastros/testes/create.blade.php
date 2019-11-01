@extends('layouts.base')

@section('importar')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{ asset('js/cadastros/testes/form.js') }}"></script>
@endsection

@section('titulo')
Testes
@endsection

@section('subtitulo')
Criar
@endsection

@section('conteudo')

{{ Form::open(['method' => 'POST', 'class' => 'kt-form', 'id' => "testes_form", 'route' => ['testes.store']]) }}
@include('cadastros.testes.form')
{{ Form::close() }}

@endsection