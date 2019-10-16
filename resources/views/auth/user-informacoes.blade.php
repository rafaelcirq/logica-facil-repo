{{ Form::open(['method' => 'PUT', 'class' => 'kt-form', 'id' => "user_info_form", 'route' => ['users.update', Auth::id()]]) }}
{{-- <form method="POST" class="kt-form" id="user_info_form" action="{{ route('users.update', Auth::id()) }}"> --}}
@csrf
<input id="tipo-user" value="{{ Auth::user()->tipo }}" hidden>
<div class="form-group row">
    <div class="col-lg-4 form-group-sub">
        <label class="form-control-label">
            Email:
        </label>
        <input class="form-control" type="text" placeholder="Email" name="email" value="{{ Auth::user()->email }}">
    </div>
    <div class="col-lg-4 form-group-sub">
        <label class="form-control-label">
            Nome:
        </label>
        <input class="form-control" type="text" placeholder="Nome" name="name" value="{{ Auth::user()->name }}">
    </div>
    <div class="col-lg-4 form-group-sub">
        <label class="form-control-label">
            Tipo:
        </label>
        <select class="form-control" name="tipo" id="tipo">
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