@csrf
<div class="form-group row">
    <input hidden id="users_id" name="users_id" value="{{ Auth::id() }}">
    <div class="col-lg-6 form-group-sub">
        <label class="form-control-label">
            Instituição:
        </label>
        <select class="form-control kt-select2" id="instituicoes_id" name="instituicoes_id">
            <option value="">Nenhuma</option>
            @foreach ($instituicoes as $instituicao)
            <option value="{{ $instituicao->id }}">@if(@isset($instituicao->sigla)){{ $instituicao->sigla }} -
                @endif{{ $instituicao->nome }}</option>
            @endforeach
        </select>
        <label for="instituicoes_id" class="invalid-feedback error" generated="true">Defina a instituicao a qual a turma pertencerá.</label>
    </div>
    <div class="col-lg-6 form-group-sub">
        <label class="form-control-label">
            Nome:
        </label>
        <input class="form-control" id="nome" name="nome">
    </div>
</div>
<div class="form-group rouw">
    <div class="col-lg-12 form-group-sub">
        <label class="form-control-label">
            Alunos:
        </label>
        <select class="form-control kt-select2" id="alunos" name="alunos[]" multiple>
        </select>
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="/turmas" class="btn btn-secondary">Cancelar</a>
    </div>
</div>