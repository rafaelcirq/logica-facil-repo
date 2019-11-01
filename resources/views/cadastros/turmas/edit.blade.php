@extends('layouts.base')

@section('importar')
<script src="{{ asset('js/cadastros/turmas/form.js') }}"></script>
@endsection

@section('titulo')
Minhas Turmas
@endsection

@section('subtitulo')
Editar
@endsection

@section('conteudo')

{{ Form::open(['method' => 'PUT', 'class' => 'kt-form', 'id' => "turmas_form", 'route' => ['turmas.update', $turma->id]]) }}
{{-- <form method="POST" class="kt-form" id="user_info_form" action="{{ route('users.update', Auth::id()) }}"> --}}
@include('cadastros.turmas.form')
{{ Form::close() }}

@endsection