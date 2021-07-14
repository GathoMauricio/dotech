@extends('layouts.app')
@section('content')
<h4 class="title_page">Detalles del mantenimiento</h4> 
<br/>
<table style="width:100%;">
    <tr>
        <th colspan="6" class="text-center font-weight-bold" style="background-color:#d30035;color:white;">Informació general</th>
    </tr>
    <tr>
        <th width="20%" style="background-color:#D5D8DC;">Author</th>
        <th width="20%" style="background-color:#D5D8DC;">Tipo</th>
        <th width="20%" style="background-color:#D5D8DC;">Kilometros</th>
        <th width="20%" style="background-color:#D5D8DC;">Fecha</th>
        <th width="20%" style="background-color:#D5D8DC;">Monto</th>
         <th width="20%" style="background-color:#D5D8DC;">Descripcion</th>
     </tr>
     <tr>
        <td width="20%" style="background-color:#D5D8DC;">{{ $maintenance->author['name'] }} {{ $maintenance->author['middle_name'] }} {{ $maintenance->author['last_name'] }}</td>
        <td width="20%" style="background-color:#D5D8DC;">{{ $maintenance->type['type'] }}</td>
        <td width="20%" style="background-color:#D5D8DC;">{{ $maintenance->kilometers }}</td>
        <td width="20%" style="background-color:#D5D8DC;">{{ $maintenance->date }}</td>
        <td width="20%" style="background-color:#D5D8DC;">${{ $maintenance->amount }}</td>
        <td width="20%" style="background-color:#D5D8DC;">{{ $maintenance->description }}</td>
    </tr>
</table>
<br/>
<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="3" class="text-center" style="background-color:#d30035;color:white;">
                <a href="#" onclick="addMaintenanceImage({{ $maintenance->id }})" title="Añadir" class="float-right" style="color:white;">[ <span class="icon-upload"></span> ]</a>
                Fotos
            </th>
        </tr>
        <tr>
            <th>Imagen</th>
            <th>Descripción</th>
            @if(Auth::user()->rol_user_id == 1)
           <th></th>
           @endif
        </tr>
    </thead>
    <tbody>
        @foreach($images as $image)
        <tr>
            <td><a href="{{asset('storage')}}/{{ $image->image }}" target="_blank"><img src="{{asset('storage')}}/{{ $image->image }}" width="120"/></a></td>
            <td>{{ $image->description }}</td>
            @if(Auth::user()->rol_user_id == 1)
            <td>
                <a href="#" onclick="deleteMaintenanceImage({{ $image->id }})"><span class="icon-bin" title="Eliminar..." style="cursor:pointer;color:#E74C3C"> Eliminar</span></a>
            </td>
            @endif
        </tr>
        @endforeach
        @if(count($images) <= 0)
        <tr>
            <td class="text-center font-weight-bold" colspan="3">
                No hay regirtros para mostrar
            </td>
        </tr>
        @endif
    </tbody>
</table>
<input type="hidden" id="txt_delete_maintenance_image_route" value="{{ route('delete_maintenance_image') }}"/>
@include('maintenances.add_maintenance_image_modal')
@endsection