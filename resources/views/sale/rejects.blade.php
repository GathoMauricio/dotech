@extends('layouts.app')
@section('content')
<h4 class="title_page">Cotizaciones rechazadas</h4>

@if(count($sales) <= 0)
@include('layouts.no_records')
@else

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Folio</th>
            <th>Compañía</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Fecha</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->id }}</td>
            <td>{{ $sale->company['name'] }}</td>
            <td>{{ $sale->description }}</td>
            <td>${{ number_format($sale->estimated + ($sale->estimated * 0.16),2) }}</td>
            <td>{{ formatDate($sale->created_at) }}</td>
            <td><a href="{{ route('show_sale',$sale->id) }}">Ver detalles</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endif

@endsection
