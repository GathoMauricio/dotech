@extends('layouts.app')
@section('content')
<img src="{{ asset('img/withdrawal_header.png') }}" style="width:100%;" height="200" />
<br><br>
<h4 class="title_page ">Retiros</h4>
@if(Auth::user()->rol_user_id == 1)
<div class="float-right">
<a href="{{ route('whitdrawal_aproved') }}" ><span class="icon-point-up"></span> Ver solicitudes aprobados</a>
&nbsp;&nbsp;
<a href="{{ route('whitdrawal_disaproved') }}" ><span class="icon-point-down"></span> Ver solicitudes rechazadas</a>
</div>
@endif
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
            <th width="20%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($whitdrawals as $whitdrawal)
        <tr>
            <td>{{ $whitdrawal->id }}</td>
            <td>{{ $whitdrawal->provider['name'] }}</td>
            <td><a href="{{ route('show_sale',$whitdrawal->sale_id) }}" target="_blank">
                {{ $whitdrawal->sale['id'] }} 
                - 
                {{ $whitdrawal->sale['description'] }}
            </a></td>
            <td>{{ $whitdrawal->description }}</td>
            <td>{{ $whitdrawal->sale->author['name'] }}</td>
            <td>${{ $whitdrawal->quantity }}</td>
            <td>{{ $whitdrawal->invoive }}</td>
            <td>{{ onlyDate($whitdrawal->created_at) }}</td>
            @if(Auth::user()->rol_user_id == 1)
            <td>
                <a href="#" onclick="aproveWithdrawalModal({{ $whitdrawal->id }});"><span class="icon-point-up" title="Aprovar" style="cursor:pointer;color:#74DF00"> Aprobar</span></a>
                <br>
                <a href="#" onclick="disaproveWithdrawal({{ $whitdrawal->id }});"><span class="icon-point-down" title="Desaprobar" style="cursor:pointer;color:#FFBF00"> Rechazar</span></a>
                <br>
                <a href="#" onclick="deleteWithdrawal({{ $whitdrawal->id }});"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#DF0101"> Eliminar</span></a>
                <br>
                @if($whitdrawal->invoive == 'SI')
                    @if(!empty($whitdrawal->document))
                    <a href="{{ env('APP_URL').'/storage/'.$whitdrawal->document }}" target="_BLANK"><span class="icon-eye"></span> Ver</a>
                    @else 
                    <a href="#" onclick="addWhitdralDocumentModal({{ $whitdrawal->id }});"><span class="icon-upload"></span> Cargar</a>
                    @endif
                @else
                    N/A
                @endif
            </td>
            @else
                @if($whitdrawal->invoive == 'SI')
                    @if(!empty($whitdrawal->document))
                    <td class="text-center"><a href="{{ env('APP_URL').'/storage/'.$whitdrawal->document }}" target="_BLANK"><span class="icon-eye"></span></a></td>
                    @else 
                    <td class="text-center"><a href="#" onclick="addWhitdralDocumentModal({{ $whitdrawal->id }});"><span class="icon-upload"></span></a></td>
                    @endif
                @else
                <td class="text-center">N/A</td>
                @endif
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@endif
<input type="hidden" id="txt_disaprove_whitdrawal_route" value="{{ route('disaprove_whitdrawal') }}">
<input type="hidden" id="txt_delete_whitdrawal_route" value="{{ route('delete_whitdrawal') }}">
<input type="hidden" id="txt_show_whitdrawal_route" value="{{ route('show_whitdrawal') }}">
@include('withdrawal.aprove_withdrawal_modal')
@include('sale.add_whitdrawal_document_modal')
@endsection