<div class="form-group row">

    @for ($i = 0; $i < 12; $i++) @if(($i%4)==0) <div class="form-group row">
        @endif

        <div class="col-lg-3" align="center">
            <img src="/imagens/closed-envelop.png" idNumber="{{ $i }}" id="envelope_{{ $i }}" width="35%"
                class="imagem">
            <div id="valor_{{ $i }}" class="valorEnvelope" style="margin-top: -28%;" nome_envelope=""
                idNumber="{{ $i }}"></div>
            <div id="nome_{{ $i }}" class=""></div>
            <label class="kt-radio" style="margin-left: 5%;">
                <input type="radio" name="selecaoEnvelope" id="{{ $i }}">
                <span></span>
            </label>
        </div>

        @if((($i+1)%4)==0)
</div>
@endif

@endfor

</div>

<div class="form-group row">

    <div class="col-lg-2">
        <label>Nome:</label>
        <input disabled type="text" id="campoNome" class="form-control">
        <span class="form-text text-muted">Verifique as regras de nomeação na aba "Instruções".</span>
    </div>
    <div class="col-lg-1">
        <button type="reset" id="setNome" style="margin-top: 40%;" class="btn btn-primary" disabled>Definir</button>
    </div>

    <div class="col-lg-2" style="
    margin-left: 42%;">
        <label>Valor:</label>
        <input disabled type="text" id="campoValor" class="form-control">
        <span class="form-text text-muted">Verifique as regras de atribuição de valor na aba "Instruções".</span>
    </div>
    <div class="col-lg-1">
        <button type="reset" id="setValor" style="margin-top: 40%;" class="btn btn-primary" disabled>Atribuir</button>
    </div>

</div>