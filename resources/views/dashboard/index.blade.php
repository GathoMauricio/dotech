@extends('layouts.app')
@section('content')
<h4 class="title_page ">Dashboard</h4>

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
                        <a href="mobile/dotech_mobile_1-1-0.apk">App</a>
                    </h6>
                </div>
                <div class="card-body item_dashboard">
                    <h1 class="font-weight-bold color-primary-sys text-center">
                        <a href="mobile/dotech_mobile_1-1-0.apk" style="color:white;">1-1-0</a>
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