

<a href="{{ route('all_rejects') }}" class="float-right">Cotizaciones rechazadas</a>
<a href="#" onclick="addQuoteModal();"><span class="icon-plus"></span> Agregar cotización</a>
<br/><br/>
@include('wire.partials.search')
@if(count($quotes) <= 0)
@include('layouts.no_records')
@else
{{ $quotes->links('pagination-links') }}
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="15%">Folio</th>
            <th width="15%">Compañía</th>
            <th width="25%">Descriptción</th>
            <th width="15%">Precio</th>
            <th width="15%">Fecha</th>
            <th width="15%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($quotes as $quote)
        @if(strlen($search) >0)
    <tr>
            <td>{{ $quote->ID }}</td>
            <td>{{ $quote->COMPANY }}</td>
            <td>{{ $quote->DESCRIPCION }}</td>
            <td>${{ number_format($quote->MONTO + ($quote->MONTO * 0.16),2) }}</td>
            <td>{{ onlyDate($quote->FECHA) }}</td>
            <td>
                <a href="#" onclick="sendQuoteModal({{ $quote->ID }},'{{ $quote->EMAIL }}');"><span class="icon-envelop" title="Enviar" style="cursor:pointer;color:#D7DF01"> Enviar</span></a>
                <br>
                <a href="{{ route('quote_products',$quote->ID) }}" target="_blank"><span class="icon-eye" title="Productos" style="cursor:pointer;color:#3498DB"> Productos</span></a>
                <br>
                <a href="#" onclick="changeStatusModal({{ $quote->ID }});"><span class="icon-checkmark" title="Cambiar estatus" style="cursor:pointer;color:#2ECC71"> Estatus</span></a>
                <br>
                <a href="#" onclick="editQuote({{ $quote->ID }});"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>
                <br>
                <a onclick="saleFollowModal({{ $quote->ID }});" href="#"><span class="icon-bubble" title="Seguimientos" style="cursor:pointer;color:#2980B9"> Seguimientos</span></a>
                @if(Auth::user()->rol_user_id == 1)
                <br>
                <a href="#" onclick="deleteSale({{ $quote->ID }})"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                @endif
            </td>
        </tr>
        @else
        <tr>
            <td>{{ $quote->id }}</td>
            <td>{{ $quote->company['name'] }}</td>
            <td>{{ $quote->description }}</td>
            <td>${{ number_format($quote->estimated + ($quote->estimated * 0.16),2) }}</td>
            <td>{{ onlyDate($quote->created_at) }}</td>
            <td>
                <a href="#" onclick="sendQuoteModal({{ $quote->id }},'{{ $quote->department['email'] }}');"><span class="icon-envelop" title="Enviar" style="cursor:pointer;color:#D7DF01"> Enviar</span></a>
                <br>
                <a href="{{ route('quote_products',$quote->id) }}" target="_blank"><span class="icon-eye" title="Productos" style="cursor:pointer;color:#3498DB"> Productos</span></a>
                <br>
                <a href="#" onclick="changeStatusModal({{ $quote->id }});"><span class="icon-checkmark" title="Cambiar estatus" style="cursor:pointer;color:#2ECC71"> Estatus</span></a>
                <br>
                <a href="#" onclick="editQuote({{ $quote->id }});"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>
                <br>
                <a onclick="saleFollowModal({{ $quote->id }});" href="#"><span class="icon-bubble" title="Seguimientos" style="cursor:pointer;color:#2980B9"> Seguimientos</span></a>
                @if(Auth::user()->rol_user_id == 1)
                <br>
                <a href="#" onclick="deleteSale({{ $quote->id }})"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                @endif
            </td>
        </tr>
        @endif
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