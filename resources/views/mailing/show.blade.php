@extends('layouts.app')
@section('content')
    <h4 class="title_page">Detalle template</h4>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Remitente</label>
                    {{ $mailing->from }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Por defecto</label>
                    {{ $mailing->selected }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Asunto</label>
                    {{ $mailing->subject }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Cuerpo del correo</label>
                    <br>
                    {!! $mailing->body !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <a href="javascript:void(0);" onclick="adjuntar();" class="text-primary float-right">Adjuntar</a>
                    <label>Adjuntos</label>
                    <br>
                    <table class="table table-striped table-bordered">
                        @forelse($mailing->adjuntos as $adjunto)
                            <tr>
                                <td width="90%" class="text-center">
                                    <a href="{{ asset('storage/public/mailing/' . $mailing->id . '/' . $adjunto->ruta) }}"
                                        target="_blank">{{ $adjunto->ruta }}</a>
                                </td>
                                <td width="10%">
                                    <a href="javascript:void(0)" onclick="eliminarAdjunto({{ $adjunto->id }})"
                                        class="text-danger">Eliminar</a>
                                    <form action="{{ route('eliminar_adjunto', $adjunto->id) }}"
                                        id="form_eliminar_adjunto_{{ $adjunto->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center">Sin adjumtos</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
        <form action="{{ route('update_listas_mailing', $mailing->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12 p-2">
                    <div class="form-group">
                        <label>Listas</label>
                        <select name="listas[]" class="form-control select2" multiple ="yes" required>
                            @foreach ($listas as $key => $lista)
                                @if (in_array($lista->id, $mailing->listas_pivot->pluck('lista_id')->toArray()))
                                    <option value="{{ $lista->id }}" selected>{{ $lista->nombre }}</option>
                                @else
                                    <option value="{{ $lista->id }}">{{ $lista->nombre }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 p-3">
                    <input type="submit" class="btn btn-primary float-right" value="Guardar cambios">
                </div>
            </div>
        </form>
    </div>
    <style>
        .select2-selection__choice__display {
            color: black;
        }
    </style>
    @include('mailing.adjuntar', ['mailing_id' => $mailing->id])
@endsection
@section('custom_scripts')
    <script>
        function adjuntar() {
            $("#modal_adjuntar").modal('show');
        }

        function eliminarAdjunto(adjunto_id) {
            if (confirm("¿Eliminar Adjunto?")) {
                $("#form_eliminar_adjunto_" + adjunto_id).submit();
            }
        }
    </script>
@endsection
