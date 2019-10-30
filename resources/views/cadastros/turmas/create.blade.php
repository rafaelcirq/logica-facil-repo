@extends('layouts.base')

@section('importar')
<script src="{{ asset('js/cadastros/turmas/index.js') }}"></script>
@endsection

@section('titulo')
Minhas Turmas
@endsection

@section('subtitulo')
Criar
@endsection

@section('conteudo')

{{ Form::open(['method' => 'POST', 'class' => 'kt-form', 'id' => "turmas_form", 'route' => ['turmas.store']]) }}
{{-- <form method="POST" class="kt-form" id="user_info_form" action="{{ route('users.update', Auth::id()) }}"> --}}
@include('cadastros.turmas.form')
{{ Form::close() }}

@endsection