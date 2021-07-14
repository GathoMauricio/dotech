@extends('layouts.app')
@section('content')
<h4 class="title_page">Actualizar contraseña</h4>
<h5>
    Bienvenid@ <b>{{ $user->name }} {{ $user->middle_name }} {{ $user->last_name }}.</b> <br><br>
    Hemos detectado que aún cuenta con la contraseña por defecto, le invitamos a
    actualizar su información de acceso por seguridad y para dejar de recibir esta
    notificación.
</h5>
<br><br>
<form action="{{ route('update_user_password') }}" method="POST" class="form" >
    @csrf
    @method('PUT')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password" class="font-weight-bold">
                        Escriba su nueva contraseña.
                    </label>
                    <input type="password" name="password" class="form-control" placeholder="Cree una contraseña de almenos 6 dígitos alfanúmericos." />
                    @if($errors->has('password'))
                    <small style="color:#d30035">{{ $errors->first('password') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="repassword" class="font-weight-bold">
                        Confirme su nueva contraseña.
                    </label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repita la contraseña que acaba de crear."/>
                    @if($errors->has('password_confirmation'))
                    <small style="color:#d30035">{{ $errors->first('password_confirmation') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <input type="submit" value="Guardar nueva contraseña" class="btn btn-primary-sys float-right">
            </div>
        </div>
    </div>
</form>
@endsection