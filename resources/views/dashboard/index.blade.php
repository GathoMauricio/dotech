@extends('layouts.app')
@section('content')
    <h4 class="title_page ">Reportes</h4>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 p-3 font-weight-bold">
                Mes : <span id="txt_mes_actual">{{ $anioActual . '-' . $mesActual }}</span>
                <input type="month" value="{{ $anioActual . '-' . $mesActual }}" id="mes_actual" style="display:none;">
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
                    <a href="{{ url('export_cotizaciones') }}/{{ $anioActual }}/{{ $mesActual }}" target="_BLANK"
                        class="small-box-footer">
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
                    <a href="{{ url('export_proyectos') }}/{{ $anioActual }}/{{ $mesActual }}" target="_BLANK"
                        class="small-box-footer">
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
                    <a href="{{ url('export_finalizados') }}/{{ $anioActual }}/{{ $mesActual }}" target="_BLANK"
                        class="small-box-footer">
                        <span style="color:white;">
                            Descargar <i class="fas fa-download"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-4">
                {{--  <canvas id='cotizaciones_vs_proyectos'></canvas>  --}}
                <div id="chart_div"></div>
            </div>
            <div class="col-lg-8 col-8">
                <div id="grafica_proyectos_mes" style="width: 100%; height: 500px;"></div>
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
        $('#mes_actual').MonthPicker({
            OnAfterChooseMonth: function() {
                var mes_actual = $("#mes_actual").val();
                var data = mes_actual.split('-');
                var anio = data[0];
                var mes = data[1];
                var url = '{{ env('APP_URL') }}/dashboard/' + anio + '/' + mes;
                console.log(url);
                window.location = url;
            }
        });
    </script>

    @include('dashboard.grafica_cotizaciones')
    @include('dashboard.grafica_proyectos')
    <script>
        google.charts.load('current', {
            'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(pintarGraficas);

        function pintarGraficas() {
            pintarGraficaPieCotizaciones();
            pintarGraficaProyectosMes();
        }
    </script>
@endsection
