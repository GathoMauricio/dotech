@extends('layouts.app')
@section('content')
<h4 class="title_page ">Cotizaciones</h4>
<a href="{{ route('all_rejects') }}" class="float-right">Cotizaciones rechazadas</a>
<a href="#" onclick="addQuoteModal();"><span class="icon-plus"></span> Agregar cotización</a>
@if(count($sales) <= 0)
@include('layouts.no_records')
@else
{{ $sales->links() }}
<table class="table table-bordered">
    <thead>
        <tr>
            <td colspan="6" width="100%">
                <!--
                <input id="txt_search_quote" class="form-control" placeholder="Buscar..." />
                <input type="hidden" id="txt_search_quote_route_ajax" value="{{ route('search_quote_ajax') }}">
                <input type="hidden" id="txt_show_quote_route_ajax" value="{{ route('show_quote_modal_ajax') }}">
                -->
                <input onkeyup="searchQuotes(this.value)" id="txt_search_quote2" class="form-control" placeholder="Buscar..." />
                <input type="hidden" id="txt_search_quote_route_ajax2" value="{{ route('search_quote_ajax2') }}">
                <span id="span_result"></span>
            </td>
        </tr>
        <tr>
            <th width="15%">Folio</th>
            <th width="15%">Compañía</th>
            <th width="25%">Descriptción</th>
            <th width="15%">Precio</th>
            <th width="15%">Fecha</th>
            <th width="15%"></th>
        </tr>
    </thead>
    <tbody id="tbl_quotes_to_search">
        @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->id }}</td>
            <td>{{ $sale->company['name'] }}</td>
            <td>{{ $sale->description }}</td>
            <td>${{ number_format($sale->estimated + ($sale->estimated * 0.16),2) }}</td>
            <td>{{ onlyDate($sale->created_at) }}</td>
            <td>
                <a href="#" onclick="sendQuoteModal({{ $sale->id }},'{{ $sale->department['email'] }}');"><span class="icon-envelop" title="Enviar" style="cursor:pointer;color:#D7DF01"> Enviar</span></a>
                <br>
                <a href="{{ route('quote_products',$sale->id) }}" target="_blank"><span class="icon-eye" title="Productos" style="cursor:pointer;color:#3498DB"> Productos</span></a>
                <br>
                <a href="#" onclick="changeStatusModal({{ $sale->id }});"><span class="icon-checkmark" title="Cambiar estatus" style="cursor:pointer;color:#2ECC71"> Estatus</span></a>
                <br>
                <a href="#" onclick="editQuote({{ $sale->id }});"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>
                <br>
                <a onclick="saleFollowModal({{ $sale->id }});" href="#"><span class="icon-bubble" title="Seguimientos" style="cursor:pointer;color:#2980B9"> Seguimientos</span></a>
                @if(Auth::user()->rol_user_id == 1)
                <br>
                <a href="#" onclick="deleteSale({{ $sale->id }})"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endif
<input type="hidden" id="txt_delete_sale_route" value="{{ route('delete_sale') }}">
@include('quotes.show_modal')
@include('sale.sale_follow_modal')
@include('quotes.send_quote_modal')
@include('quotes.add_quote_modal')
@include('companies.add_department_company_modal')
@include('quotes.change_status_modal')
@include('quotes.edit_quote_modal')
@endsection
