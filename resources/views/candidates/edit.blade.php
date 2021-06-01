@extends('layouts.app')
@section('content')
    <h4 class="title_page">Editar candidato</h4>
    <center>
        @if($user->image == 'perfil.png')
            <img src="{{asset('img')}}/{{ $user->image }}" width="150" height="120" />
        @else
            <img src="{{asset('storage')}}/{{ $user->image }}" width="150" height="120" />
        @endif
    </center>
    <hr>
    <h5 class="title_page">Información personal</h5>
    <form action="{{ route('candidates_update',$user->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
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
    <hr>
    <table class="table" border="5">
        <tr>
            <td colspan="9" style="background-color:#d30035;color:white;font-weight:bold;">
                <center>
                    <label>Documentación</label>
                    <label style="float:right;padding:5px;"><span
                            onclick="addUserDocument({{ $user->id }});" class="icon-plus"
                            style="cursor:pointer;color:white;" title="Agregar documento..."></span></label>
                        <a href="#" onclick="openUserTest({{ $user->id }});" style="color:white;"><h5><span class="icon-file-text"></span> Abrir Test de conocimiento</h5></a>
                </center>

            </td>
        </tr>
    </table>
    <table class="table" border="5">
        <thead>
        <tr>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Documento</th>
            @if(Auth::user()->rol_user_id == 1)
                <th> </th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($documents as $document)
            <tr>
                <td>{{ formatDate($document->created_at) }}</td>
                <td>{{ $document->description }}</td>
                <td><a href="{{ asset('storage') }}/{{ $document->document }}" target="_blank">{{ $document->document }}</a></td>
                @if(Auth::user()->rol_user_id == 1)
                    <td>
                        <a href="#" onclick="deleteUserDocument({{ $document->id }});"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                    </td>
                @endif
            </tr>
        @endforeach
        @if(count($documents)<=0)
            <tr><td colspan="4" class="text-center">Sin registros</td></tr>
        @endif
        </tbody>
    </table>
    <input type="hidden" id="txt_delete_user_document_route" value="{{ route('delete_user_document') }}">
    <input type="hidden" id="txt_check_user_test_route" value="{{ route('check_user_test') }}" />
    <input type="hidden" id="txt_generate_user_test_route" value="{{ route('generate_user_test') }}" />
    @include('users.add_user_document_modal')
@endsection
