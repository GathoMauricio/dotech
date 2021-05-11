@extends('layouts.app')
@section('content')
<h4 class="title_page">Detalles del histórico</h4> 
<br/>
<table style="width:100%;">
    <tr>
        <th colspan="6" class="text-center font-weight-bold" style="background-color:#d30035;color:white;">Informació general</th>
    </tr>
    <tr>
        <th width="15%" style="background-color:#D5D8DC;">Vehiculo</th>
        <th width="15%" style="background-color:#D5D8DC;">Descripción</th>
        <th width="15%" style="background-color:#D5D8DC;">Observación</th>
        <th width="15%" style="background-color:#D5D8DC;">Kilometraje</th>
        <th width="15%" style="background-color:#D5D8DC;">Fecha</th>
         <th width="25%" style="background-color:#D5D8DC;">Autor</th>
     </tr>
     <tr>
        <td width="15%" style="background-color:#D5D8DC;">{{ $history->vehicle['brand'] }} {{ $history->vehicle['model'] }}</td>
        <td width="15%" style="background-color:#D5D8DC;">{{ $history->description }}</td>
        <td width="15%" style="background-color:#D5D8DC;">{{ $history->observation }}</td>
        <td width="15%" style="background-color:#D5D8DC;">{{ $history->kilometers }}</td>
        <td width="15%" style="background-color:#D5D8DC;">{{ formatDate($history->created_at) }}</td>
        <td width="25%" style="background-color:#D5D8DC;">{{ $history->author['name'] }} {{ $history->author['middle_name'] }} {{ $history->author['last_name'] }}</td>
    </tr>
</table>
<br/>
<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="4" class="text-center" style="background-color:#d30035;color:white;">
                <!--
                <a href="#" onclick="" title="Añadir" class="float-right" style="color:white;">[ <span class="icon-upload"></span> ]</a>
                -->
                Fotos
            </th>
        </tr>
        <tr>
            <th>Fecha</th>
            <th>Autor</th>
            <th>Imagen</th>
            <th>Descripción</th>
            <!--
            @if(Auth::user()->rol_user_id == 1)
            <th></th>
            @endif
            -->
        </tr>
    </thead>
    <tbody>
        @foreach($images as $image)
        <tr>
            <th>{{ formatDate($image->created_at) }}</th>
            <th>{{ $image->author['name'].' '.$image->author['middle_name'].' '.$image->author['last_name'] }}</th>
            <td><a href="{{asset('storage')}}/{{ $image->image }}" target="_blank"><img src="{{asset('storage')}}/{{ $image->image }}" width="120"/></a></td>
            <td>{{ $image->description }}</td>
            <!--
            @if(Auth::user()->rol_user_id == 1)
            <td>
                <a href="#" onclick="deleteMaintenanceImage({{ $image->id }})"><span class="icon-bin" title="Eliminar..." style="cursor:pointer;color:#E74C3C"> Eliminar</span></a>
            </td>
            @endif
            -->
        </tr>
        @endforeach
        @if(count($images) <= 0)
        <tr>
            <td class="text-center font-weight-bold" colspan="4">
                No hay regirtros para mostrar
            </td>
        </tr>
        @endif
    </tbody>
</table>
<input type="hidden" id="txt_delete_maintenance_image_route" value="{{ route('delete_maintenance_image') }}"/>
@include('maintenances.add_maintenance_image_modal')
@endsection