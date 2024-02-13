@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center">
            Roles y Permisos
        </h3>
        <div class="row">
            <div class="col-md-12 p-3" style="background-color: white;border: solid 5px #f4f6f9;">
                <div class="container">
                    <div class="row">
                        @foreach ($roles as $rol)
                            <div class="card col-md-12">
                                <form id="form_asignar_permisos_{{ $rol->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="rol" value="{{ $rol->id }}">
                                    <div class="card-header font-weight-bold">
                                        <div class="float-right">
                                            <button type="submit" class="btn btn-info">
                                                <span class="icon icon-floppy-disk"></span>
                                            </button>
                                        </div>
                                        {{ $rol->name }}
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row">
                                                @foreach ($permisos as $permiso)
                                                    <div class="col-md-4">
                                                        <input name="permisos[]" value="{{ $permiso->name }}"
                                                            type="checkbox"
                                                            @if ($rol->hasPermissionTo($permiso->name)) checked @endif>
                                                        {{ $permiso->name }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_scripts')
    <script>
        $(document).ready(function() {
            //iniciar formularios ajax
            @foreach ($roles as $rol)
                $("#form_asignar_permisos_{{ $rol->id }}").submit(function(e) {
                    e.preventDefault();
                    var data = $("#form_asignar_permisos_{{ $rol->id }}").serialize();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('actualizar_roles_permisos') }}",
                        data: data,
                        success: function(response) {
                            successNotification(response);
                        },
                        error: err => console.log(err)
                    });
                });
            @endforeach
        });
    </script>
@endsection
