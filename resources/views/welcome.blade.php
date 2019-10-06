@extends('layouts.master')

@section('body-content')

<div class="flex-center position-ref full-height">
    <div class="content" style="text-align: center; margin-top: 13%;">
        <div class="title m-b-md">
            <img src="/imagens/logo-var.png" alt="Smiley face" width="25%">
        </div>
        @if (Route::has('login'))
        <div class="links" style="margin-top: 1%;">
            @auth
                {{-- <a href="{{ url('/home') }}">Página Inicial</a> --}}
                <a href="{{ url('/home') }}">
                    <button type="button" class="btn btn-clean btn-bold btn-upper">Página Inicial</button>
                </a>
            @else
                <a href="{{ route('login') }}">
                    <button type="button" class="btn btn-secondary btn-hover-brand">Fazer Login</button>
                </a>
                
                @if (Route::has('register'))
                <a  href="{{ route('register') }}">
                    <button href="{{ route('register') }}" type="button" class="btn btn-clean btn-bold btn-upper">Criar Conta</button>
                </a>
                @endif
            @endauth
        </div>
    @endif
    </div>
</div>

@endsection