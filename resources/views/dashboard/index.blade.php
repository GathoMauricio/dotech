@extends('layouts.app')
@section('content')
    {{--  <a href="{{ url('last_dashboard') }}" class="float-right">Último dashboard <span class="icon icon-share"></span></a>  --}}
    <h4 class="title_page ">
        Reportes...
    </h4>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-4 p-3 font-weight-bold">
                Mes : <span id="txt_mes_actual">{{ $anioActual . '-' . $mesActual }}</span>
                <input type="month" value="{{ $anioActual . '-' . $mesActual }}" id="mes_actual" style="display:none;">
            </div>
            <div class="col-lg-4 col-4 p-3 font-weight-bold">
                <form action="{{ route('export_proyectos_year') }}">
                    Año :
                    <select name="year">
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                    </select>
                    <button type="submit">Descargar</button>
                </form>
            </div>
            <div class="col-lg-4 col-4 p-3 font-weight-bold">
                <form action="{{ route('export_finalizados_year') }}">
                    Año :
                    <select name="year">
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                    </select>
                    <button type="submit">Descargar</button>
                </form>
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
                <a href="{{ url('wire_projects') }}" target="_BLANK"><b>Proyectos <span
                            class="icon icon-share"></span></b></a>
                <div id="grafica_cotizaciones_vs_proyectos"></div>
            </div>
            <div class="col-lg-8 col-8">
                <a href="{{ url('reporte_mensual_cotizaciones_proyectos/' . $anioActual . '/' . $mesActual) }}"
                    target="_BLANK"><b>Descargar
                        reporte mensual <span class="icon icon-download"></span></b></a>
                <div id="grafica_proyectos_mes"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-4">
                <a href="{{ url('prospecto_index') }}" target="_BLANK"><b>Prospectos <span
                            class="icon icon-share"></span></b></a>
                <div id="grafica_prospectos_vs_clientes"></div>
            </div>
            <div class="col-lg-8 col-8">
                <a href="{{ url('wire_tasks') }}" target="_BLANK"><b>Tareas <span class="icon icon-share"></span></b></a>
                <div style="width:100%;height: 300px;overflow: hidden;overflow-y: scroll;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tarea</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tareas as $tarea)
                                <tr>
                                    <td>{{ $tarea->title }}</td>
                                    <td>{{ $tarea->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    @include('dashboard.modal_preview_proyecto')
    @include('dashboard.grafica_cotizaciones')
    @include('dashboard.grafica_proyectos')
    @include('dashboard.grafica_prospectos_vs_clientes')

    <script>
        google.charts.load('current', {
            'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(pintarGraficas);

        function pintarGraficas() {
            pintarGraficaPieCotizaciones();
            pintarGraficaProyectosMes();
            pintarGraficaPieProspectosClientes();
        }
    </script>
@endsection
