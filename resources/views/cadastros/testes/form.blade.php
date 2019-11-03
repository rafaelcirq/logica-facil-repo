@csrf
<input value="{{ $turmaId }}" name="turmas_id" id="turmas_id" hidden>
@if(isset($teste))
<input value="{{ $teste->id }}" name="teste_id" id="teste_id">
@endif
<div class="form-group row">
    <div class="col-lg-4 form-group-sub">
        <label class="form-control-label">
            Nome:
        </label>
        <input class="form-control" id="nome" name="nome" value="{{ isset($teste) ? $teste->nome : '' }}">
    </div>
    <div class="col-lg-2 form-group-sub">
        <label class="form-control-label">
            Valor:
        </label>
        <input class="form-control" id="valor" name="valor" value="{{ isset($teste) ? $teste->valor : '' }}">
    </div>
    <div class="col-lg-3 form-group-sub">
        <label class="form-control-label">
            Data Início:
        </label>
        <div class="input-group date">
            <input type="text" class="form-control" placeholder="" id="data_inicio" name="data_inicio"
                value="{{ isset($teste) ? $teste->data_inicio : '' }}" readonly />
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="la la-check-circle-o glyphicon-th"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 form-group-sub">
        <label class="form-control-label">
            Data Limite:
        </label>
        <div class="input-group date">
            <input type="text" class="form-control" placeholder="" id="data_limite" name="data_limite"
                value="{{ isset($teste) ? $teste->data_limite : '' }}" readonly />
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="la la-check-circle-o glyphicon-th"></i>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>
<div class="form-group row">
    <div class="col-lg-12 form-group-sub">
        <div id="kt_repeater_3">
            {{-- <div class="form-group  row"> --}}
            <div data-repeater-list="questoes" class="col-lg-12">
                <div data-repeater-item class="">

                    <div class="form-group row">
                        <div class="col-lg-6 form-group-sub">
                            <div class="form-group row">
                                <label class="form-control-label">
                                    Pergunta:
                                </label>
                                <textarea class="form-control" rows="10" name="pergunta" required></textarea>
                                <label for="pergunta" class="invalid-feedback error" generated="true">Defina a pergunta
                                    da questão.</label>
                            </div>
                            <div class="form-group row">
                                <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon">
                                    <i class="la la-remove"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 form-group-sub">
                            {{-- <div class="form-group"> --}}
                            <div class="kt-radio-list">
                                <div class="form-group row">
                                    <div class="col-lg-12 form-group-sub">
                                        <label class="form-control-label">
                                            Alternativas (marque a correta):
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-1 form-group-sub" style="margin-top: 2%;">
                                        <label class="kt-radio">
                                            <input type="radio" value="1" name="alternativaCorreta">
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="col-lg-11 form-group-sub">
                                        <input class="form-control" required name="alternativas[0]" value="">
                                        <label for="pergunta" class="invalid-feedback error" generated="true">Defina
                                            todas as alternativas da questão.</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-1 form-group-sub" style="margin-top: 2%;">
                                        <label class="kt-radio">
                                            <input type="radio" value="2" name="alternativaCorreta">
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="col-lg-11 form-group-sub">
                                        <input class="form-control" required name="alternativas[1]" value="">
                                        <label for="pergunta" class="invalid-feedback error" generated="true">Defina
                                            todas as alternativas da questão.</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-1 form-group-sub" style="margin-top: 2%;">
                                        <label class="kt-radio">
                                            <input type="radio" value="3" name="alternativaCorreta">
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="col-lg-11 form-group-sub">
                                        <input class="form-control" required name="alternativas[2]" value="">
                                        <label for="pergunta" class="invalid-feedback error" generated="true">Defina
                                            todas as alternativas da questão.</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-1 form-group-sub" style="margin-top: 2%;">
                                        <label class="kt-radio">
                                            <input type="radio" value="4" name="alternativaCorreta">
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="col-lg-11 form-group-sub">
                                        <input class="form-control" required name="alternativas[3]" value="">
                                        <label for="pergunta" class="invalid-feedback error" generated="true">Defina
                                            todas as alternativas da questão.</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-1 form-group-sub" style="margin-top: 2%;">
                                        <label class="kt-radio">
                                            <input type="radio" value="5" name="alternativaCorreta">
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="col-lg-11 form-group-sub">
                                        <input class="form-control" required name="alternativas[4]" value="">
                                        <label for="pergunta" class="invalid-feedback error" generated="true">Defina
                                            todas as alternativas da questão.</label>
                                    </div>
                                </div>
                            </div>
                            {{-- </div> --}}
                        </div>
                    </div>

                    <div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>

                </div>
            </div>
            {{-- </div> --}}
            <div class="row">
                <div class="col">
                    <div data-repeater-create="" class="btn btn-success btn-icon">
                        <span>
                            <i class="la la-plus"></i>
                            <span></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="/turmas/{{ $turmaId }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>