@extends('layouts.app')
@section('content')
    <a href="javascript:void(0)" onclick="crearLista();" class="float-right font-weight-bold link-sys">[ <small
            class="  icon-plus"></small>
        Agregar lista ]</a>
    <br>
    <h4 class="title_page">Lista {{ $lista->nombre }}</h4>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('store_lista_mailing') }}" method="POST">
                    @csrf
                    <input type="hidden" name="lista_id" value="{{ $lista->id }}">
                    <select name=" clientes[]" class="select2 form-control" multiple>
                        <option>--Seleccione alguna opción--</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                        @endforeach
                    </select>
                    <div style="float:right">
                        <input type="submit" value=" guardar" class="btn btn-primary">
                    </div>
                </form>
                <br><br>

            </div>
        </div>
    </div>
@endsection
@section('custom_scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
