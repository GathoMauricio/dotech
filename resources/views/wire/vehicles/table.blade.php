<a href="{{ route('create_vehicle') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small>
    Agregar vehiculo ]</a>
<br /><br />
@include('wire.partials.search')
@if (count($vehicles) <= 0)
    @include('layouts.no_records')
@else
    {{ $vehicles->links('pagination-links') }}
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
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->type['type'] }}</td>
                    <td>{{ $vehicle->brand }}<br>{{ $vehicle->year }}<br>{{ $vehicle->color }}</td>
                    <td>{{ $vehicle->model }}</td>
                    <td>{{ $vehicle->enrollment }}</td>
                    <td>
                        @php
                            $lastMaintenance = \App\Maintenance::where('vehicle_id', $vehicle->id)
                                ->get()
                                ->last();
                        @endphp
                        @if ($lastMaintenance)
                            {{ $lastMaintenance->kilometers }} km
                            <br />
                            {{ onlyDate($lastMaintenance->date) }}
                        @else
                            No definido
                        @endif
                    </td>
                    <td>
                        @php
                            $lastService = \App\VehicleHistory::where('vehicle_id', $vehicle->id)
                                ->get()
                                ->last();
                        @endphp
                        @if ($lastService)
                            {{ $lastService->kilometers }} km
                            <br />
                            {{ onlyDate($lastService->created_at) }}
                        @else
                            No definido
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('vehicle_show', $vehicle->id) }}"><span class="icon-eye" title="Ver..."
                                style="cursor:pointer;color:#2E86C1"> Ver</span></a>
                        <br />
                        <a href="{{ route('pdf_mantenimientos', $vehicle->id) }}" target="_BLANK"><span
                                class="icon-file-pdf" title="Reporte de mantenimientos..."
                                style="cursor:pointer;color:blue">
                                Mantenimientos</span></a>
                        <br />
                        @if (Auth::user()->rol_user_id == 1)
                            <a href="{{ route('vehicle_edit', $vehicle->id) }}"><span class="icon-pencil"
                                    title="Editar..." style="cursor:pointer;color:#EB984E"> Editar</span></a>
                            <br />
                            <a href="#" onclick="deleteVehicle({{ $vehicle->id }})"><span class="icon-bin"
                                    title="Eliminar..." style="cursor:pointer;color:#E74C3C"> Eliminar</span></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
<input type="hidden" id="txt_delete_vehicle_route" value="{{ route('vehicle_destroy') }}">
