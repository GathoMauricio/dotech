@extends('layouts.app')
@section('content')
<h4 class="title_page ">Dashboard</h4>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4 class="text-center">
                Proyectos y Cotizaciones.
            </h4>
            <p class="font-weight-bold">
                En esta gráfica se muestra la cantidad de proyectos activos así como la cantidad de cotizaciones pendientes
                que no han sido aprobadas para convertirse en proyecto ni rechazadas para dejar de ser tomadas en cuenta.
            </p>
            <canvas id="projects_quotes" ></canvas>
        </div>
        <div class="col-md-6">
            <h4 class="text-center">
                Venta, Inversión y Utilidad
            </h4>
            <p class="font-weight-bold">
                En seguida se muestra el total de la utilidad esperada de todos los proyectos activos a partir de la inversión 
                realizada hasta el momento.
                <br/>
                El costo total de todos los proyectos activos es:  ${{ number_format($costoTotal,2) }}
            </p>
            <canvas id="sale_investment_utility" ></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">
                Proyectos activos por compañía
            </h4>
            @php $proyectos = \App\Sale::where('status','Proyecto')->orderBy('company_id')->get() @endphp
            <p class="font-weight-bold">
                A continuación se muestran {{ count($proyectos) }} proyectos activos así como el costo, la inverción y 
                la utilidad generada en cada uno.
                
            </p>
            
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Companía</th>
                        <th>Proyecto</th>
                        <th>Retiros aprobados</th>
                        <th>Retiros pendientes</th>
                        <th>Costo</th>
                        <th>Inversión</th>
                        <th>Utilidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proyectos as $proyecto)
                    @php 
                        $retiros_aux = \App\Whitdrawal::where('sale_id',$proyecto->id)->where('status','Aprobado')->get();
                        $retiros_p_aux = \App\Whitdrawal::where('sale_id',$proyecto->id)->where('status','Pendiente')->get();
                        $inversion_aux = 0;
                        foreach($retiros_aux as $retiro)
                        {
                            $inversion_aux += $retiro->quantity;
                        }
                        $utilidad_aux = ($proyecto->estimated + ($proyecto->estimated * 0.16)) - $inversion_aux;



                     @endphp
                    <tr>
                        <td>{{ $proyecto->company['name'] }}</td>
                        <td><a href="{{ route('show_sale',$proyecto->id) }}" target="_blank">{{ $proyecto->description }}</a></td>
                        <td>{{ count($retiros_aux) }}</td>
                        <td><a href="{{ route('show_whitdrawal_by_project',$proyecto->id) }}" target="_blank">{{ count($retiros_p_aux) }}</a></td>
                        <td>${{ number_format($proyecto->estimated + ($proyecto->estimated * 0.16),2) }}</td>
                        <td>${{ number_format($inversion_aux,2) }}</td>
                        <td>${{ number_format($utilidad_aux,2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <canvas id="proyect_by_company" ></canvas>
        </div>
    </div>


</div>
<br/>
<div class="container">
    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('whitdrawal_index') }}">Retiros pendientes</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="{{ route('whitdrawal_index') }}" style="color:white;">{{ $withdrawals }} </a>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('task_index') }}">Tareas pendientes</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="{{ route('task_index') }}" style="color:white;">{{ $tasks }}</a> 
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('index_quotes') }}">Cotizaciones pendientes</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="{{ route('index_quotes') }}" style="color:white;">{{ $quotes }}</a> 
                    </h1>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('index_proyects') }}">Proyectos activos</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="{{ route('index_proyects') }}" style="color:white;">{{ $projects }}</a> 
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('index_binnacle') }}">Bitácoras</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="{{ route('index_binnacle') }}" style="color:white;">{{ $binnacles }}</a>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('company_index') }}">Compañías</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="{{ route('company_index') }}" style="color:white;">{{ $companies }} </a>
                    </h1>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="mobile/dotech_mobile_1-1-2.apk">App</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="mobile/dotech_mobile_1-1-2.apk" style="color:white;">1-1-2</a>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('log_index') }}">Log</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        &nbsp; 
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">
                        <a href="{{ route('config_index') }}">Config</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        &nbsp; 
                    </h1>
                </div>
            </div>
        </div>

    </div>
</div>



<script>
var ctx = document.getElementById('projects_quotes').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    //type: 'pie',
    //type: 'bar',
    data: {
        labels: ['Proyectos activos: {{ $projects }}', 'Cotizaciones pendientes: {{ $quotes }}'],
        datasets: [{
            //label: '# of Votes',
            data: [{{ $projects }}, {{ $quotes }}],
            backgroundColor: [
                //'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                //'rgba(255, 206, 86, 0.2)',
                //'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                //'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                //'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                //'rgba(255, 206, 86, 1)',
                //'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                //'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<script>
var ctx = document.getElementById('sale_investment_utility').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    //type: 'pie',
    //type: 'bar',
    data: {
        labels: ['Inversión','Utilidad'],
        datasets: [{
            label: '',
            data: [{{ $inversionTotal }},{{ $utilidadTotal }}],
            backgroundColor: [
                //'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                //'rgba(255, 206, 86, 0.2)',
                //'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                //'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                //'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                //'rgba(255, 206, 86, 1)',
                //'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                //'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<script>

var ctx = document.getElementById('proyect_by_company').getContext('2d');
var myChart = new Chart(ctx, {
    //type: 'line',
    //type: 'pie',
    type: 'bar',
    data: {
        
        labels: [
            @foreach($proyectos as $proyecto)
            '{{ $proyecto->company['name'] }} - {{ $proyecto->description }}',
            @endforeach
            ],
        datasets: [{
            //label: 'Venta total: $1000',
            data: [
                 @foreach($proyectos as $proyecto)
                {{ $proyecto->estimated }},
                 @endforeach
                ],
            
            backgroundColor: [
                //'rgba(255, 99, 132, 0.2)',
                //'rgba(54, 162, 235, 0.2)',
                //'rgba(255, 206, 86, 0.2)',
                //'rgba(75, 192, 192, 0.2)',
                //'rgba(153, 102, 255, 0.2)',
                //'rgba(255, 159, 64, 0.2)'
                 @foreach($proyectos as $proyecto)
                'rgba(255, 99, 132, 0.2)',
                 @endforeach
            ],
            borderColor: [
                //'rgba(255, 99, 132, 0.2)',
                //'rgba(54, 162, 235, 0.2)',
                //'rgba(255, 206, 86, 0.2)',
                //'rgba(75, 192, 192, 0.2)',
                //'rgba(153, 102, 255, 0.2)',
                //'rgba(255, 159, 64, 0.2)'
                 @foreach($proyectos as $proyecto)
                'rgba(255, 99, 132, 0.2)',
                 @endforeach
            ],

            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

























@php
$cog = asset('img/background_black_red.jpg');
@endphp
<style type="text/css">

.item_dashboard{
    background: url({{$cog}}) no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    width: 100%;
    height: auto;
    overflow: hidden;
}
</style>
@endsection