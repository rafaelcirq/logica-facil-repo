{{ Form::open(['method' => 'POST', 'class' => 'kt-form', 'id' => "user_senha_form", 'route' => ['users.password', Auth::id()]]) }}
{{-- <form method="POST" class="kt-form" id="user_info_form" action="{{ route('users.update', Auth::id()) }}"> --}}
@csrf
<input id="tipo-user" value="{{ Auth::user()->tipo }}" hidden>
<div class="form-group row">
    <div class="col-lg-4 form-group-sub">
        <label class="form-control-label">
            Senha Atual:
        </label>
        <input class="form-control" type="password" placeholder="Senha atual" name="password">
    </div>
    <div class="col-lg-4 form-group-sub">
        <label class="form-control-label">
            Nova Senha:
        </label>
        <input class="form-control" type="password" placeholder="Nova Senha" name="new_password">
    </div>
    <div class="col-lg-4 form-group-sub">
        <label class="form-control-label">
            Confirmar Nova Senha:
        </label>
        <input class="form-control" type="password" placeholder="Confirmar Nova Senha" name="check_new_password">
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button class="btn btn-secondary">Cancelar</button>
    </div>
</div>
{{ Form::close() }}