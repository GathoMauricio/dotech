@extends('layouts.app')
@section('content')
    <h4 class="title_page ">Reportes</h4>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 p-3 font-weight-bold">
                Mes : <span id="txt_mes_actual">{{ date('Y-m') }}</span>
                <input type="month" value="{{ date('Y-m') }}" id="mes_actual" style="display:none;">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="numero_cotizaciones">
                            {{ count($cotizaciones) }}
                        </h3>
                        <p style="color:white;">Cotizaciones</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <a href="javascript:void(0)" onclick="exportCotizaciones()" class="small-box-footer">
                        <span style="color:white;">
                            Descargar <i class="fas fa-download"></i>
                        </span>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="numero_proyectos">
                            {{ count($proyectos) }}
                        </h3>
                        <p>Proyectos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <a href="javascript:void(0)" onclick="exportProyectos()" class="small-box-footer">
                        <span style="color:white;">
                            Descargar <i class="fas fa-download"></i>
                        </span>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="numero_finalizados">
                            {{ count($finalizados) }}
                        </h3>
                        <p>Finalizados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <a href="javascript:void(0)" onclick="exportFinalizados()" class="small-box-footer">
                        <span style="color:white;">
                            Descargar <i class="fas fa-download"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous"></script>
    <link href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('monthpiker/MonthPicker.css') }}" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="{{ asset('monthpiker/MonthPicker.js') }}"></script>
    <script>
        var anio = '{{ date('Y') }}';
        var mes = '{{ date('m') }}';
        $('#mes_actual').MonthPicker({
            OnAfterChooseMonth: function() {
                var mes_actual = $("#mes_actual").val();
                $("#txt_mes_actual").text(mes_actual);
                var data = mes_actual.split('-');
                anio = data[0];
                mes = data[1];
                cambiarMes();
            }
        });

        function cambiarMes() {
            $.ajax({
                type: 'GET',
                url: '{{ url('api/cambiar_mes_reportes') }}/' + anio + '/' + mes,
                data: {}
            }).done(function(response) {
                console.table(response.data);
                $("#numero_cotizaciones").text(response.data.numero_cotizaciones);
                $("#numero_proyectos").text(response.data.numero_proyectos);
                $("#numero_finalizados").text(response.data.numero_finalizados);

            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log("Error: " + textStatus + " " + errorThrown);
            });
        }

        function exportCotizaciones() {
            window.location = '{{ url('export_cotizaciones') }}/' + anio + '/' + mes;
        }

        function exportProyectos() {
            window.location = '{{ url('export_proyectos') }}/' + anio + '/' + mes;
        }

        function exportFinalizados() {
            window.location = '{{ url('export_finalizados') }}/' + anio + '/' + mes;
        }
    </script>
@endsection
