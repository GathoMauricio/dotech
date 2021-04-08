@extends('layouts.app')
@section('content')
<h4 class="title_page">Detalles de {{ $vehicle->brand }} {{ $vehicle->model }}</h4> 
<br/>
<table style="width:100%;">
    <tr>
        <th colspan="5" class="text-center font-weight-bold" style="background-color:#d30035;color:white;">Informació general</th>
    </tr>
    <tr>
        <th width="20%" style="background-color:#D5D8DC;">Tipo</th>
        <th width="20%" style="background-color:#D5D8DC;">Marca</th>
        <th width="20%" style="background-color:#D5D8DC;">Modelo</th>
        <th width="20%" style="background-color:#D5D8DC;">Combustible</th>
         <th width="20%" style="background-color:#D5D8DC;">Kilometros</th>
     </tr>
     <tr>
        <td width="20%" style="background-color:#D5D8DC;">{{ $vehicle->type['type'] }}</td>
        <td width="20%" style="background-color:#D5D8DC;">{{ $vehicle->brand }}</td>
        <td width="20%" style="background-color:#D5D8DC;">{{ $vehicle->model }}</td>
        <td width="20%" style="background-color:#D5D8DC;">{{ $vehicle->fuel }}</td>
        <td width="20%" style="background-color:#D5D8DC;">{{ $vehicle->kilometers }}</td>
    </tr>
        <tr>
        <th width="20%" style="background-color:#D5D8DC;">Matrícula</th>
        <th width="20%" style="background-color:#D5D8DC;">Año</th>
        <th width="20%" style="background-color:#D5D8DC;">Cilindrada</th>
        <th width="20%" style="background-color:#D5D8DC;">Potencia</th>
         <th width="20%" style="background-color:#D5D8DC;">Color</th>
     </tr>
     <tr>
        <td width="20%" style="background-color:#D5D8DC;">{{ $vehicle->enrollment }}</td>
        <td width="20%" style="background-color:#D5D8DC;">{{ $vehicle->year }}</td>
        <td width="20%" style="background-color:#D5D8DC;">{{ $vehicle->displacement }}</td>
        <td width="20%" style="background-color:#D5D8DC;">{{ $vehicle->power }}</td>
        <td width="20%" style="background-color:#D5D8DC;">{{ $vehicle->color }}</td>
    </tr> 
</table>
<br/>
<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="3" class="text-center" style="background-color:#d30035;color:white;">
                <a href="#" onclick="addVehicleImage({{ $vehicle->id }})" title="Añadir" class="float-right" style="color:white;">[ <span class="icon-upload"></span> ]</a>
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
        @foreach($vehicleImages as $vehicleImage)
        <tr>
            <td><a href="{{asset('storage')}}/{{ $vehicleImage->image }}" target="_blank"><img src="{{asset('storage')}}/{{ $vehicleImage->image }}" width="120"/></a></td>
            <td>{{ $vehicleImage->description }}</td>
            @if(Auth::user()->rol_user_id == 1)
            <td>
                <a href="#" onclick="deleteVehicleImage({{ $vehicleImage->id }})"><span class="icon-bin" title="Eliminar..." style="cursor:pointer;color:#E74C3C"> Eliminar</span></a>
            </td>
            @endif
        </tr>
        @endforeach
        @if(count($vehicleImages) <= 0)
        <tr>
            <td class="text-center font-weight-bold" colspan="3">
                No hay regirtros para mostrar
            </td>
        </tr>
        @endif
    </tbody>
</table>
<br/>
<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="6" class="text-center" style="background-color:#d30035;color:white;">
            <a href="#" onclick="addMaintenanceVehicle({{ $vehicle->id }})" title="Añadir" class="float-right" style="color:white;">[ <span class="icon-upload"></span> ]</a>
            Manteniemientos
            </th>
        </tr>
        <tr>
            <th>Autor</th>
            <th>Tipo</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Descripción</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($maintenances as $maintenance)
        <tr>
            <td>{{ $maintenance->author['name'] }} {{ $maintenance->author['middle_name'] }} {{ $maintenance->author['last_name'] }}</td>
            <td>
            @if($maintenance->type['id'] != 22)
            {{ $maintenance->type['type'] }}
            @else
            {{ $maintenance->other }}
            @endif
            </td>
            <td>{{ explode(' ',$maintenance->date)[0] }}</td>
            <td>${{ $maintenance->amount }}</td>
            <td>{{ $maintenance->description }}</td>
            <td>
                <a href="{{ route('maintenance_show',$maintenance->id) }}" ><span class="icon-eye" title="Ver..." style="cursor:pointer;color:#2E86C1"> Ver</span></a>
                <br/>
                <a href="{{ route('maintenance_edit',$maintenance->id) }}" ><span class="icon-pencil" title="Editar..." style="cursor:pointer;color:#EB984E"> Editar</span></a>
                <br/>
                @if(Auth::user()->rol_user_id == 1)
                <a href="#" onclick="deleteMaintenance({{ $maintenance->id }})"><span class="icon-bin" title="Eliminar..." style="cursor:pointer;color:#E74C3C"> Eliminar</span></a>
                @endif
            </td>
        </tr>
        @endforeach
        @if(count($maintenances) <= 0)
        <tr>
            <td class="text-center font-weight-bold" colspan="6">
                No hay regirtros para mostrar
            </td>
        </tr>
        @endif
    </tbody>
</table>
<br/>
<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="6" class="text-center" style="background-color:#d30035;color:white;">
            <!--
            <a href="#" onclick="addMaintenanceVehicle({{ $vehicle->id }})" title="Añadir" class="float-right" style="color:white;">[ <span class="icon-upload"></span> ]</a>
            -->
            Salidas
            </th>
        </tr>
        <tr>
            <th>Fecha</th>
            <th>Autor</th>
            <th>Kilometraje</th>
            <th>Descripción</th>
            <th>Observaciones</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicleHistories as $vehicleHistory)
        <tr>
            <td>{{ formatDate($vehicleHistory->date) }}</td>
            <td>{{ $vehicleHistory->author['name'] }} {{ $vehicleHistory->author['middle_name'] }} {{ $vehicleHistory->author['last_name'] }}</td>
            <td>{{ $vehicleHistory->kilometers }}</td>
            <td>{{ $vehicleHistory->description }}</td>
            <td>
            @if(!empty($vehicleHistory->observation))
            {{ $vehicleHistory->observation }}
            @else
            Sin comentarios
            @endif
            </td>
            <td>
                <a href="{{ route('vehicle_history_show',$vehicleHistory->id) }}" ><span class="icon-eye" title="Ver..." style="cursor:pointer;color:#2E86C1"> Ver</span></a>
                <br/>
                <!--
                <a href="{{ route('maintenance_edit',$vehicleHistory->id) }}" ><span class="icon-pencil" title="Editar..." style="cursor:pointer;color:#EB984E"> Editar</span></a>
                <br/>
                
                @if(Auth::user()->rol_user_id == 1)
                <a href="#" onclick="deleteMaintenance({{ $vehicleHistory->id }})"><span class="icon-bin" title="Eliminar..." style="cursor:pointer;color:#E74C3C"> Eliminar</span></a>
                @endif
                -->
            </td>
        </tr>
        @endforeach
        @if(count($maintenances) <= 0)
        <tr>
            <td class="text-center font-weight-bold" colspan="6">
                No hay regirtros para mostrar
            </td>
        </tr>
        @endif
    </tbody>
</table>
<input type="hidden" id="txt_delete_vehicle_image_route" value="{{ route('vehicle_image_destroy') }}"/>
<input type="hidden" id="txt_delete_maitenance_route" value="{{ route('maintenance_destroy') }}"/>
@include('vehicles.add_vehicle_image_modal')
@include('maintenances.add_maintenance_modal')
@endsection