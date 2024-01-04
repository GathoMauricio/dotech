@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Mi perfil</h5>
                    </div>
                    @include('config.menu')
                    <br><br>
                    <center>
                        <div id="user_image">
                            <br><br><br><br><br><br>
                            <p style="background-color:black;opacity:0.8;padding:5px;">
                                <!--
                                                                                                                    <label for="user_image_label" class="label_file" style="color:white;">
                                                                                                                        <span class="icon-camera"></span>
                                                                                                                        Cambiar
                                                                                                                    </label>
                                                                                                                    <form action="{{ route('update_image_user') }}" method="POST" enctype="multipart/form-data">
                                                                                                                    @csrf
                                                                                                                    {{ method_field('PUT') }}
                                                                                                                    <input onchange="this.form.submit();" type="file" name="image" id="user_image_label" style="display:none;" accept="image/jpg, image/jpeg, image/bmp, image/png"/>
                                                                                                                    </form>
                                                                                                                    -->
                                <a href = "https://es.gravatar.com/" target="_bank">Cambiar Gravatar</a>
                            </p>
                        </div>
                    </center>
                    <br><br>
                    <table class="table">
                        <tr>
                            <th width="20%">
                                <h5 class="font-weight-bold color-primary-sys">Vacaciones</h5>
                            </th>
                            <td width="20%" class="text-center">
                                Dias obtenidos
                                <br>
                                {{ $user->dias_obtenidos }}
                            </td>
                            <td width="20%" class="text-center">
                                Dias tomados
                                <br>
                                {{ $user->dias_tomados }}
                            </td>
                            <td width="20%" class="text-center">
                                Dias restantes
                                <br>
                                {{ $user->dias_restantes }}
                            </td>
                            <td width="20%" class="text-center"><a href="javascript:void(0)"
                                    onclick="solicitarVacaciones();">
                                    <span class="icon-pencil"></span> Solicitar</a>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table class="table">
                        <tr>
                            <th width="45%">
                                <h5 class="font-weight-bold color-primary-sys">Nombre</h5>
                            </th>
                            <td width="45%">
                                <h5 class="font-weight-bold">
                                    {{ Auth::user()->name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}
                                </h5>
                            </td>
                            <td width="10%"><a href="javascript:void(0)" onclick="editNameModal();"><span
                                        class="icon-pencil"></span>
                                    Editar</a>
                            </td>
                        </tr>
                        <tr>
                            <th width="45%">
                                <h5 class="font-weight-bold color-primary-sys">Contacto</h5>
                            </th>
                            <td width="45%">
                                <h5 class="font-weight-bold">
                                    {{ Auth::user()->email }}
                                </h5>
                            </td>
                            <td width="10%"><a href="javascript:void(0)"><span class="icon-pencil"></span> Editar</a>
                            </td>
                        </tr>
                        <tr>
                            <th width="45%">
                                <h5 class="font-weight-bold color-primary-sys">Contraseña</h5>
                            </th>
                            <td width="45%">
                                <h5 class="font-weight-bold">
                                    **************
                                </h5>
                            </td>
                            <td width="10%"><a href="javascript:void(0)" onclick="editPasswordModal();"><span
                                        class="icon-pencil"></span>
                                    Editar</a>
                            </td>
                        </tr>

                    </table>


                    <div class="card card-success">
                        <div class="card-heading p-3">
                            <h3 class="card-title">Vacaciones</h3>

                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha Inicio</th>
                                        <th>Nro Dias</th>
                                        <th>Motivo</th>
                                        <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->vacaciones as $vacation)
                                        @if ($vacation->tipo == 'vacaciones')
                                            <tr>
                                                <th scope="row">{{ date('d/m/Y', strtotime($vacation->fecha_inicio)) }}
                                                </th>
                                                <td>{{ $vacation->dias }}</td>
                                                <td>{{ $vacation->motivo }}</td>
                                                <td>
                                                    {{ $vacation->estatus }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card card-warning">
                        <div class="card-heading p-3">
                            <h3 class="card-title">Permisos</h3>

                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha Inicio</th>
                                        <th>Nro Dias</th>
                                        <th>Motivo</th>
                                        <th>Estatus</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->vacaciones as $vacation)
                                        @if ($vacation->tipo == 'permiso')
                                            <tr>
                                                <th scope="row">{{ date('d/m/Y', strtotime($vacation->fecha_inicio)) }}
                                                </th>
                                                <td>{{ $vacation->dias }}</td>
                                                <td>{{ $vacation->motivo }}</td>
                                                <td>
                                                    {{ $vacation->estatus }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card card-danger">
                        <div class="card-heading p-3">
                            <h3 class="card-title">Faltas</h3>

                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha Inicio</th>
                                        <th>Nro Dias</th>
                                        <th>Motivo</th>
                                        <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->vacaciones as $vacation)
                                        @if ($vacation->tipo == 'falta')
                                            <tr>
                                                <th scope="row">{{ date('d/m/Y', strtotime($vacation->fecha_inicio)) }}
                                                </th>
                                                <td>{{ $vacation->dias }}</td>
                                                <td>{{ $vacation->motivo }}</td>
                                                <td>
                                                    {{ $vacation->estatus }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('config.solicitar_vacaciones_modal')
    @include('config.edit_name_modal')
    @include('config.edit_password_modal')
    <script>
        function solicitarVacaciones() {
            $("#solicitar_vacaciones_modal").modal('show');
        }
    </script>
    @php
        if (Auth::user()->image == 'perfil.png') {
            $userImage = asset('img') . '/' . Auth::user()->image;
        } else {
            $userImage = env('APP_URL') . '/storage/' . Auth::user()->image;
        }
    @endphp
    <style>
        #user_image {
            background: url({{ Avatar::create(Auth::user()->email)->toGravatar(['d' => 'identicon', 'r' => 'pg', 's' => 100]) }});
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding-top: 10px;
            width: 150px;
            height: 150px;
        }
    </style>
@endsection
