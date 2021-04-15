@extends('layouts.app')
@section('content')
<a href="{{ route('create_vehicle') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar vehiculo ]</a>
<h4 class="title_page">Vehículos</h4> 
@if(count($vehicles) <= 0)
@include('layouts.no_records')
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="10%">Tipo</th>
            <th width="10%">Marca</th>
            <th width="10%">Modelo</th>
            <th width="10%">Matrícula</th>
            <th width="10%">kilometraje último mantenimiento</th>
            <th width="10%">Kilometraje última salida</th>
            <th width="20%">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicles as $vehicle)
        <tr>
            <td>{{ $vehicle->type['type'] }}</td>
            <td>{{ $vehicle->brand }}</td>
            <td>{{ $vehicle->model }}</td>
            <td>{{ $vehicle->enrollment }}</td>
            <td>
            @php $lastMaintenance = \App\Maintenance::where('vehicle_id',$vehicle->id)->get()->last() @endphp
            @if($lastMaintenance)
            {{ $lastMaintenance->kilometers }} km
            @else
            No definido
            @endif
            </td>
            <td>
            @php $lastService = \App\VehicleHistory::where('vehicle_id',$vehicle->id)->get()->last() @endphp
            @if($lastService)
            {{ $lastService->kilometers }} km
            @else
            No definido
            @endif
            </td>
            <td>
                <a href="{{ route('vehicle_show',$vehicle->id) }}" ><span class="icon-eye" title="Ver..." style="cursor:pointer;color:#2E86C1"> Ver</span></a>
                <br/>
                @if(Auth::user()->rol_user_id == 1)
                <a href="{{ route('vehicle_edit',$vehicle->id) }}" ><span class="icon-pencil" title="Editar..." style="cursor:pointer;color:#EB984E"> Editar</span></a>
                <br/>
                <a href="#" onclick="deleteVehicle({{ $vehicle->id }})"><span class="icon-bin" title="Eliminar..." style="cursor:pointer;color:#E74C3C"> Eliminar</span></a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<input type="hidden" id="txt_delete_vehicle_route" value="{{ route('vehicle_destroy') }}">
@include('companies.follow_modal')
@include('quotes.add_quote_by_company_modal')
@include('companies.add_department_company_modal')
@endif
@endsection