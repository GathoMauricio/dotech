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
            <td>{{ $product->description }}</td>
            <td>${{ $product->unity_price_sell }}</td>
            <td>{{ $product->discount }}%</td>
            <td>${{ $product->total_sell }}</td>
            <td>
                <span onclick="editProductModal({{ $product->id }})" class="icon-pencil" style="cursor:pointer;color:#F39C12;"></span>
                <br>
                <span onclick="deleteProductModal({{ $product->id }})" class="icon-bin" style="cursor:pointer;color:#E74C3C ;"></span>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6" class="text-right">Total: ${{$total}}</td>
        </tr>
        <tr>
            <td colspan="6" class="text-right">Total + IVA: ${{$totalIva}}</td>
        </tr>
    </tbody>
</table>
@endif
<input type="hidden" id="txt_delete_product_route" value="{{ route('delete_product') }}">
@include('quotes.send_quote_modal')
@include('quotes.add_product_modal')
@include('quotes.edit_product_modal')
@endsection