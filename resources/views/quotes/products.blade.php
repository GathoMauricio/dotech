@extends('layouts.app')
@section('content')
<h4 class="title_page ">Productos de {{ $sale->description }} para {{ $sale->company['name'] }}</h4>
<a href="#" onclick="addProductModal();"><span class="icon-plus"></span> Agregar producto</a>
&nbsp;&nbsp;
<a href="{{ route('load_sale_pdf',$sale->id) }}" target="_BLANK"><span class="icon-file-pdf"></span> Ver cotizacion</a>
&nbsp;&nbsp;
<a href="#" onclick="sendQuoteModal({{ $sale->id }},'{{ $sale->department['email'] }}')" ><span class="icon-envelop"></span> Enviar cotización</a>
@if(count($products) <= 0)
@include('layouts.no_records')
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Cant</th>
            <th>U. Medida</th>
            <th>Producto</th>
            <th>P/U</th>
            <th>Descuento</th>
            <th>Venta</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->quantity }}</td>
            <td>
                @if(!empty($product->measure))
                {{ $product->measure }}
                @else
                N/A
                @endif
            </td>
            <td>{{ $product->description }}</td>
            <td>${{ number_format($product->unity_price_sell,2) }}</td>
            <td>{{ $product->discount }}%</td>
            <td>${{ number_format($product->total_sell - ($product->total_sell * $product->discount / 100),2) }}</td>
            <td>
                <span onclick="editProductModal({{ $product->id }})" class="icon-pencil" style="cursor:pointer;color:#F39C12;"></span>
                <br>
                <span onclick="deleteProductModal({{ $product->id }})" class="icon-bin" style="cursor:pointer;color:#E74C3C ;"></span>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="7" class="text-right">Subtotal: ${{ number_format($total,2) }}</td>
        </tr>
        <tr>
            <td colspan="7" class="text-right">Total: ${{ number_format($totalIva,2) }}</td>
        </tr>
    </tbody>
</table>
@endif
<input type="hidden" id="txt_delete_product_route" value="{{ route('delete_product') }}">
@include('quotes.send_quote_modal')
@include('quotes.add_product_modal')
@include('quotes.edit_product_modal')
@endsection