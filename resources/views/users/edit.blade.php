@extends('layouts.app')
@section('content')
<p class="text-right">
    <a href="{{ route('index_user') }}"><span class="icon-cross"></span></a>
</p>
<h4 class="title_page">Editar usuario</h4>
@include('config.menu')
<center>
    @if($user->image == 'perfil.png')
    <img src="{{asset('img')}}/{{ $user->image }}" width="150" height="120" />
    @else
    <img src="{{asset('storage')}}/{{ $user->image }}" width="150" height="120" />
    @endif
</center>
<hr>
<h5 class="title_page">Información personal</h5>
<form action="{{ route('update_user',$user->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status_user_id" class="font-weight-bold color-primary-sys">
                        Estatus
                    </label>
                    <select name="status_user_id" class="custom-select">
                        @foreach($statuses as $status)
                            @if($user->status_user_id == $status->id)
                            <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
                            @else
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="rol_user_id" class="font-weight-bold color-primary-sys">
                        Rol
                    </label>
                    <select name="rol_user_id" class="custom-select">
                        @foreach($rols as $rol)
                            @if($user->rol_user_id == $rol->id)
                            <option value="{{ $rol->id }}" selected>{{ $rol->name }}</option>
                            @else
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="location_user_id" class="font-weight-bold color-primary-sys">
                        Locación
                    </label>
                    <select name="location_user_id" class="custom-select">
                        @foreach($locations as $location)
                            @if($user->location_user_id == $location->id)
                            <option value="{{ $location->id }}" selected>{{ $location->name }}</option>
                            @else
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="font-weight-bold color-primary-sys">
                        Nombre
                    </label>
                    <input name="name" value="{{ old('name',$user->name) }}" type="text" class="form-control" required>
                    @if($errors->has('name'))
                    <small style="color:#d30035">{{ $errors->first('name') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="middle_name" class="font-weight-bold color-primary-sys">
                        A. paterno
                    </label>
                    <input name="middle_name" value="{{ old('middle_name',$user->middle_name) }}"  type="text" class="form-control" required>
                    @if($errors->has('middle_name'))
                    <small style="color:#d30035">{{ $errors->first('middle_name') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="last_name" class="font-weight-bold color-primary-sys">
                        A. Materno
                    </label>
                    <input name="last_name" value="{{ old('last_name',$user->last_name) }}"  type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone" class="font-weight-bold color-primary-sys">
                        Teléfono*
                    </label>
                    <input name="phone" value="{{ old('phone',$user->phone) }}"  type="text" class="form-control">
                    @if($errors->has('phone'))
                    <small style="color:#d30035">{{ $errors->first('phone') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="emergency_phone" class="font-weight-bold color-primary-sys">
                        Teléfono de emergencia
                    </label>
                    <input name="emergency_phone" value="{{ old('emergency_phone',$user->emergency_phone) }}"  type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="email" class="font-weight-bold color-primary-sys">
                        Email*
                    </label>
                    <input  value="{{ old('email',$user->email) }}"  type="email" class="form-control" readonly>
                    @if($errors->has('email'))
                    <small style="color:#d30035">{{ $errors->first('email') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address" class="font-weight-bold color-primary-sys">
                        Dirección
                    </label>
                    <textarea name="address" class="form-control">{{ old('address',$user->address) }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="image"   class="font-weight-bold color-primary-sys">
                        Foto
                    </label>
                    <input name="image" type="file" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <input type="submit" value="Actualizar" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>
<hr>
<h5 class="title_page">Cambiar contraseña</h5>
<form action="{{ route('update_password_admin') }}" id="form_edit_password" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="id"  value="{{ $user->id }}" />
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="currency" class="font-weight-bold color-primary-sys">
                        Nueva contraseña
                    </label>
                    <input type="password" name="password" id="txt_edit_password" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="currency" class="font-weight-bold color-primary-sys">
                        Repetir contraseña
                    </label>
                    <input type="password" name="password_confirm" id="txt_edit_password_confirm" class="form-control" required>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>
@endsection