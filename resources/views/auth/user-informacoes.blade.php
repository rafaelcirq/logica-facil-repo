{{ Form::open(['method' => 'PUT', 'class' => 'kt-form', 'id' => "user_info_form", 'route' => ['users.update', Auth::id()]]) }}
@csrf
<input id="tipo-user" value="{{ Auth::user()->tipo }}" hidden>
<div class="form-group m-form__group row">
    <div class="col-lg-4">
        <label>
            Email:
        </label>
        <input value="{{ Auth::user()->email }}" class="form-control" name="email" placeholder="Email" type="text">
    </div>
    <div class="col-lg-4">
        <label>
            Nome:
        </label>
        <input value="{{ Auth::user()->name }}" class="form-control" name="name" placeholder="Nome" type="text">
    </div>
    <div class="col-lg-4">
        <label>
            Tipo:
        </label>
        <select class="form-control" aria-placeholder="Tipo" name="tipo" id="tipo">
            <option value="Aluno">Aluno</option>
            <option value="Professor">Professor</option>
        </select>
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button class="btn btn-secondary">Cancelar</button>
    </div>
</div>

{{ Form::close() }}