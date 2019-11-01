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
                @if(Auth::user()->tipo == "Professor")
                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile add-button">
                    <div class="kt-form__group kt-form__group--inline">
                        <a href="{{ route('testes.create-by-turma', $turma->id) }}">
                            <button type="button" class="btn btn-outline-brand btn-elevate btn-pill"><i
                                    class="flaticon2-plus-1"></i>Novo Teste</button>&nbsp;
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!--begin: Datatable -->
<div class="kt-datatable" id="professor_testes_datatable"></div>

@if(Auth::user()->tipo == "Professor")
<div id="rel_delete_forms">
    @foreach($testes as $teste)
    {{ Form::open(['method' => 'DELETE', 'id' => "delete_form_".$teste->id, 'route' => ['testes.destroy', $teste->id]]) }}
    @csrf
    {{-- <button>delete {{ $teste->nome }}</button> --}}
    {{ Form::close() }}
    @endforeach
</div>
@endif