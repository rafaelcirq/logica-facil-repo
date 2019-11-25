<div class="form-group row">
    <div class="col-lg-6">
        {{-- <div class="col-lg-8">
            <label>Comandos:</label>
            <input type="text" id="comando" class="form-control">
        </div>
        <div class="col-lg-4">
            <button id="compilar" style="margin-top: 17%;" class="btn btn-primary">Compilar</button>
        </div> --}}
        <div class="form-group row">
            <label>Comandos</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="" id="comando">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button" id="compilar">Compilar</button>
                </div>
            </div>
            <span class="form-text text-muted">Verifique os comandos disponíveis na aba "Instruções".</span>
        </div>
        <div class="form-group row">
            
            @for ($i = 0; $i < 12; $i++) @if(($i%4)==0) <div class="form-group row">
                @endif
        
                <div class="col-lg-3" align="center" id="compilador_div_{{ $i }}" style="visibility: hidden;">
                    <img src="/imagens/closed-envelop.png" idNumber="{{ $i }}" id="envelope_{{ $i }}" width="80%"
                        class="imagemCompilador">
                    <div id="compilador_valor_{{ $i }}" class="valorEnvelope" style="margin-top: -59%;
                    font-size: 150%;"></div>
                    <div id="compilador_nome_{{ $i }}" style="text-align: center;
                    font-size: 110%;" class=""></div>
                </div>
        
            @if((($i+1)%4)==0)
            </div>
            @endif
        
            @endfor

        </div>
    </div>
    <div class="col-lg-6 form-group-sub" style="text-align: center;">
        <img src="/imagens/monitor.png" width="50%">
        <div id="resultado" style="position: relative;
        margin-top: -43%;
        font-size: 530%;
        width: 40%;
        margin-left: 30%;"></div>
    </div>
</div>