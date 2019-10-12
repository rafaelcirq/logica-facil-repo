@error('email')
<div class="alert alert-danger invalid-feedback" role="alert">
    <div class="alert-text">Existem problemas em alguns campos. Verifique-os e tente novamente..</div>
</div>
@enderror

<form method="POST" class="kt-form" id="user-form" action="{{ route('users.store') }}">
    @csrf
    {{-- <div class="input-group"> --}}
    {{-- <input class="form-control" type="text" placeholder="Fullname" name="fullname"> --}}
    {{-- </div> --}}
    <div class="col-lg-12">
        <input class="form-control" type="text" placeholder="Nome" name="name" autocomplete="off">
    </div>
    <div class="col-lg-12">
        <select class="form-control" aria-placeholder="Tipo" name="tipo">
            <option value="" disabled selected>Tipo</option>
            <option value="aluno">Aluno</option>
            <option value="professor">Professor</option>
        </select>
    </div>
    <div class="col-lg-12">
        <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
    </div>
    <div class="col-lg-12">
        <input class="form-control" type="password" placeholder="Senha" name="password">
    </div>
    <div class="col-lg-12">
        <input class="form-control" type="password" placeholder="Confirmar Senha" name="checkPassword">
    </div>
    {{-- <div class="row kt-login__extra">
                <div class="col kt-align-left">
                    <label class="kt-checkbox">
                        <input type="checkbox" name="agree">I Agree the <a href="#" class="kt-link kt-login__link kt-font-bold">terms and conditions</a>.
                        <span></span>
                    </label>
                    <span class="form-text text-muted"></span>
                </div>
            </div> --}}
    <div class="kt-login__actions">
        <button id="kt_login_signup_submit" type="submit"
            class="btn btn-brand btn-elevate kt-login__btn-primary">Cadastrar</button>&nbsp;&nbsp;
        <button id="kt_login_signup_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary">Cancelar</button>
    </div>
</form>