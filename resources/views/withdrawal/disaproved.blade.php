@extends('layouts.app')
@section('content')
<h4 class="title_page ">Retiros desaprobados</h4>
<a href="{{ route('whitdrawal_index') }}" class="float-right"><span class="icon-point-up"></span> Ver solicitudes pendientes</a>
@if(count($whitdrawals) <= 0)
@include('layouts.no_records')
@else
{{ $whitdrawals->links() }}
<table class="table table-bordered" id="index_table">
    <thead>
        <tr>
            <th width="10%">Id</t)h>
            <th width="10%">Proveedor</th>
            <th width="10%">Proyecto</th>
            <th width="10%">Descripcion</th>
            <th width="10%">Empelado</th>
            <th width="10%">Cantidad</th>
            <th width="10%">Factura</th>
            <th width="10%">Fecha</th>
            @if(Auth::user()->rol_user_id == 1)
            <th width="20%"></th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($whitdrawals as $whitdrawal)
        <tr>
            <td>{{ $whitdrawal->id }}</td>
            <td>{{ $whitdrawal->provider['name'] }}</td>
            <td>{{ $whitdrawal->sale['description'] }}</td>
            <td>{{ $whitdrawal->description }}</td>
            <td>{{ $whitdrawal->sale->author['name'] }}</td>
            <td>${{ $whitdrawal->quantity }}</td>
            <td>{{ $whitdrawal->invoive }}</td>
            <td>{{ onlyDate($whitdrawal->created_at) }}</td>
            @if(Auth::user()->rol_user_id == 1)
            <td>
                <a href="#" onclick="deleteWithdrawal({{ $whitdrawal->id }});"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#DF0101"> Eliminar</span></a>
                <br>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@endif
<input type="hidden" id="txt_disaprove_whitdrawal_route" value="{{ route('disaprove_whitdrawal') }}">
<input type="hidden" id="txt_delete_whitdrawal_route" value="{{ route('delete_whitdrawal') }}">
@include('withdrawal.aprove_withdrawal_modal')
@endsection