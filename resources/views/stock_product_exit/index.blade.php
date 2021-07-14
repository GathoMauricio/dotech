@extends('layouts.app')
@section('content')
<br><br>
<!--
<a href="{{ route('stock_product_create') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar producto ]</a>
-->
<h4 class="title_page">Salidas de {{ $product->product }}</h4>
@if(count($exits) <= 0)
@include('layouts.no_records')
@else
<table class="table table-striped" id="index_table">
    <thead>
        <tr>
            <th>Autor</th>
            <th>Proyecto</th>
            <th>Cantidad</th>
            <th>Descripción</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($exits as $exit)
        <tr>
            <td>{{ $exit->author['name'] }} {{ $exit->author['middle_name'] }} {{ $exit->author['last_name'] }}</td>
            <td>{{ $exit->sale['description'] }}</td>
            <td>{{ $exit->quantity }}</td>
            <td>{{ $exit->description }}</td>
            <td>
                @if(Auth::user()->rol_user_id == 1)
                <a onclick="deleteStockProductExit({{ $exit->id }})" href="#">
                    <span class="icon-bin" title="Eliminar..." style="cursor:pointer;color:red">
                        Eliminar
                    </span>
                </a>
                <br>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<input type="hidden" id="txt_delete_stock_product_exit_route" value="{{ route('delete_stock_product_exit_route') }}">
@endif
@endsection