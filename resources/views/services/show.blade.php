@extends('layouts.app')
@section('content')
<img src="{{ asset('img/service_header.png') }}" style="width:100%;" height="200" />
<br><br>
<h4 class="title_page">
    Expediente {{ $service->id }} - {{ $service->company['name'] }} <i>{{ $service->department['name'] }}</i>
</h4>
<h5 class="font-weight-bold color-primary-sys">
    Asunto: <span style="color:black;">{{ $service->subject }}</span>
    <br><br>
    Autor: 
    <span style="color:black;">
        {{ $service->author['name'] }} 
        {{ $service->author['middle_name'] }} 
        {{ $service->author['last_name'] }}
    </span>
    <br>
    Técnico: 
    <span style="color:black;">
        {{ $service->technical['name'] }} 
        {{ $service->technical['middle_name'] }} 
        {{ $service->technical['last_name'] }}
    </span>
</h5>

<table class="table table-bordered">
    <tr>
        <th colspan="3" style="background-color:#d30035;color:white;">
            <center>Información del cliente</center>
        </th>
    </tr>
    <tr>
        <th class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Nombre
        </th>
        <th class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Teléfono
        </th>
        <th class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Email
        </th>
    </tr>
    <tr>
        <th class="text-center font-weight-bold">
            {{ $service->department['manager'] }}
        </th>
        <th class="text-center font-weight-bold">
            {{ $service->department['phone'] }}
        </th>
        <th class="text-center font-weight-bold">
            {{ $service->department['email'] }}
        </th>
    </tr>
    <tr>
        <th colspan="3" class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Dirección
        </th>
    </tr>
    <tr>
        <th class="text-left font-weight-bold">
            {{ $service->department['address'] }}
        </th>
    </tr>
</table>

<table class="table table-bordered">
    <tr>
        <th colspan="3" style="background-color:#d30035;color:white;">
            <center>Información del expediente</center>
        </th>
    </tr>
    <tr>
        <th class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Estatus
        </th>
        <th class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Tipo
        </th>
        <th class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Programado para
        </th>
    </tr>
    <tr>
        <th class="text-center font-weight-bold">
            {{ $service->status }}
        </th>
        <th class="text-center font-weight-bold">
            {{ $service->type }}
        </th>
        <th class="text-center font-weight-bold">
            {{ formatDate($service->programed_at) }}
        </th>
    </tr>
    <tr>
        <th colspan="3" class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Descripción
        </th>
    </tr>
    <tr>
        <th class="text-left font-weight-bold">
            {{ $service->description }}
        </th>
    </tr>
    <tr>
        <th class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Creado el
        </th>
        <th class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Contactado el
        </th>
        <th class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Cerrado el
        </th>
    </tr>
    <tr>
        <th class="text-center font-weight-bold">
            {{ formatDate($service->created_at) }}
        </th>
        <th class="text-center font-weight-bold">
            @if(!empty($service->contacted_at))
            {{ formatDate($service->contacted_at) }}
            @else
            Aún no disponible
            @endif
        </th>
        <th class="text-center font-weight-bold">
            @if(!empty($service->closed_at))
            {{ formatDate($service->closed_at) }}
            @else
            Aún no disponible
            @endif
        </th>
    </tr>
    <tr>
        <th colspan="3" class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Retroalimentación
        </th>
    </tr>
    <tr>
        <th class="text-left font-weight-bold">
            @if(!empty($service->feedback))
            {{ $service->feedback }}
            @else
            Aún no disponible
            @endif
        </th>
    </tr>
</table>

<table class="table table-bordered">
    <tr>
        <th colspan="4" style="background-color:#d30035;color:white;">
            <center>Evidencias</center>
        </th>
    </tr>
    <tr>
        <th class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Imagen
        </th>
        <th class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Autor
        </th>
        <th class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Descripción
        </th>
        <th class="text-center" style="background-color:#D5D8DC;color:#d30035;">
            Cerrado el
        </th>
    </tr>
    @foreach($images as $image)
    <tr>
        <th class="text-center font-weight-bold">
            <img 
            onclick="showServiceImage({{ $image->id }})" 
            style="cursor:pointer;"
            src="{{ env('APP_URL').'/storage/'.$image->image }}" 
            width="80">
        </th>
        <th class="text-center font-weight-bold">
            {{ $image->author['name'] }} 
            {{ $image->author['middle_name'] }} 
            {{ $image->author['last_name'] }}
        </th>
        <th class="text-center font-weight-bold">
            {{ $image->description }}
        </th>
        <th class="text-center font-weight-bold">
            {{ formatDate($image->created_at) }}
        </th>
    </tr>
    @endforeach
    @if(count($images) <= 0) 
    <th colspan="4" class="text-center font-weight-bold">
        No se encontraron registros
    </th>
    @endif
</table>
@include('layouts.show_image')
@endsection