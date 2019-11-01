@extends('layouts.base')

@section('importar')
<script src="{{ asset('js/cadastros/turmas/index-aluno-testes.js') }}"></script>
@endsection

@section('titulo')
{{ $turma->nome }}
@endsection

@section('subtitulo')
{{ $turma->instituicao->nome }}
@endsection

@section('conteudo')
<input id="turma_id" value="{{ $turma->id }}" hidden>
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
                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile add-button">
                    <div class="kt-form__group kt-form__group--inline">
                        <button type="button" class="btn btn-bold btn-label-brand btn-sm" data-toggle="modal"
                            data-target="#modal_resultado">Ver Resultados</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--begin: Datatable -->
<div class="kt-datatable" id="aluno_testes_datatable"></div>

@foreach ($testes as $teste)
@foreach ($teste->resultados as $resultado)
@if ($resultado->users_id == Auth::id())
<input id="teste_{{ $teste->id }}" value="{{ $resultado }}" hidden>
@endif
@endforeach
@endforeach

{{-- begin: Modal --}}
<div class="modal fade" id="modal_resultado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resultados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                @foreach ($testes as $teste)
                <div class="accordion accordion-light  accordion-svg-icon" id="accordionExample7">
                    <div class="card">
                        <div class="card-header" id="headingTwo7">
                            <div class="card-title collapsed" data-toggle="collapse"
                                data-target="#resultados_{{ $teste->id }}" aria-expanded="false"
                                aria-controls="resultados_{{ $teste->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                        <path
                                            d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                                            transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
                                    </g>
                                </svg> {{ $teste->nome }}
                            </div>
                            <div id="resultados_{{ $teste->id }}" class="collapse" aria-labelledby="headingOne7"
                                data-parent="#accordionExample7">
                                <div class="card-body">
                                    @foreach ($teste->resultados as $resultado)
                                    @if ($resultado->usuario->id == Auth::id())
                                    Nota: {{ $resultado->nota }}/{{ $teste->valor }}
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection