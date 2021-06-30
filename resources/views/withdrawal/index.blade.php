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
            <td colspan="12" width="100%">

                <!--
                <input id="txt_search_whitdrawal" class="form-control" placeholder="Buscar..." />
                <input type="hidden" id="txt_search_whitdrawal_route_ajax" value="{{ route('search_whitdrawal_ajax') }}">
                <input type="hidden" id="txt_show_whitdrawal_route_ajax" value="{{ route('show_whitdrawal_ajax') }}">
                -->
                <input onkeyup="searchWhitdrawals(this.value)" id="txt_search_whitdrawal2" class="form-control" placeholder="Buscar..." />
                <input type="hidden" id="txt_search_whitdrawal_route_ajax2" value="{{ route('search_whitdrawal_ajax2') }}">
                <span id="span_result"></span>
            </td>
        </tr>
        <tr>
            <th width="10%">Id</t)h>
            <!--<th width="10%">Proveedor</th>-->
            <!--<th width="10%">Compañía</th>-->
            <th width="10%">Proyecto</th>
            <th width="10%">Descripcion</th>
            <th width="10%">Empelado</th>
            <th width="10%">Cantidad</th>
            <th width="10%">Factura</th>
            <th width="10%">Fecha</th>
            <th width="10%">Folio Factura</th>
            <th width="10%">Pagado</th>
            <th width="20%"></th>
        </tr>
    </thead>
    <tbody id="tbl_whitdrawal_to_search">
        @foreach($whitdrawals as $whitdrawal)
        @if($whitdrawal->paid == 'SI')
        <tr class="bg-info" id="tr_whitdrawal_{{ $whitdrawal->id }}">
        @else
        <tr id="tr_whitdrawal_{{ $whitdrawal->id }}">
        @endif
            <td>{{ $whitdrawal->id }}</td>
            <!--<td>{{ $whitdrawal->provider['name'] }}</td>-->
            <!--<td>{{ $whitdrawal->sale->company['name'] }}</td>-->
            <td>
            {{ $whitdrawal->sale['id'] }} 
            <a href="{{ route('show_sale',$whitdrawal->sale->id) }}" target="_blank">{{ $whitdrawal->sale->company['name'] }} - {{ $whitdrawal->sale['description'] }}</a>
            <br/>
            <span class="text-info">Proveedor: </span>
            <br/>
            {{ $whitdrawal->provider['name'] }}
            </td>
            <!--
            <td><a href="{{ route('show_sale',$whitdrawal->sale_id) }}" target="_blank">
                {{ $whitdrawal->sale['id'] }} 
                - 
                {{ $whitdrawal->sale['description'] }}
            </a>
            </td>
            -->
            <td>{{ $whitdrawal->description }}</td>
            <td>
                @if(!empty($whitdrawal->author['name']))
                {{ $whitdrawal->author['name'] }} 
                {{ $whitdrawal->author['middle_name'] }} 
                {{ $whitdrawal->author['last_name'] }}
                @else
                No definido
                @endif
            </td>
            <td>${{ $whitdrawal->quantity }}</td>
            <td>{{ $whitdrawal->invoive }}</td>
            <td>{{ onlyDate($whitdrawal->created_at) }}</td>
            <td width="40%;">
                <input type="text" onkeyUp="updateWhitdrawalFolio({{ $whitdrawal->id }},this.value);" value="{{ $whitdrawal->folio }}"/>
                <input type="hidden" id="txt_update_whidrawal_folio" value="{{ route('update_whitdrawal_folio') }}">
            </td>
            <td width="40%;">
            <select onchange="updateWhitdrawalPaid({{ $whitdrawal->id }},this.value);" >
                @if($whitdrawal->paid == 'SI')
                    <option value="SI" selected>SI</option>
                    <option value="NO">NO</option>
                @else
                    <option value="SI">SI</option>
                    <option value="NO" selected>NO</option>
                @endif
            </select>
            <input type="hidden" id="txt_update_whidrawal_paid" value="{{ route('update_whitdrawal_paid') }}">
            </td>
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
@include('withdrawal.show_modal')
@include('withdrawal.aprove_withdrawal_modal')
@include('sale.add_whitdrawal_document_modal')
@endsection