@extends('layouts.app')
@section('content')
    <a href="javascript:void(0)" onclick="crearLista();" class="float-right font-weight-bold link-sys">[ <small
            class="  icon-plus"></small>
        Agregar lista ]</a>
    <br>
    <h4 class="title_page">Listas de envio</h4>
    <div class="container">
        <div class="row">
            @foreach ($listas as $lista)
                <div class="col-lg-4 col-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="numero_cotizaciones">
                                {{ $lista->clientes_pivot->count() }}
                            </h3>
                            <p style="color:white;">{{ $lista->nombre }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-list"></i>
                        </div>
                        <a href="#" target="_BLANK" class="small-box-footer">
                            <span style="color:white;">
                                Ver <i class="fas fa-eye"></i>
                            </span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('mailing.create_lista')
@endsection
@section('custom_scripts')
    <script>
        function crearLista() {
            $("#modal_create_lista").modal('show');
        }
    </script>
@endsection
