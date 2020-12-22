@extends('layouts.app')
@section('content')
<h4 class="title_page">Cotizaciones {{ $company->name }}</h4>
@if(count($sales) <= 0)
@include('layouts.no_records')
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Inversión</th>
            <th>Estimado</th>
            <th>Descriptción</th>
            <th>Observación</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
        <tr>
            <td>{{ formatDate($sale->created_at) }}</td>
            <td>${{ $sale->investment }}</td>
            <td>${{ $sale->estimated }}</td>
            <td>{{ $sale->description }}</td>
            <td>{{ $sale->observation }}</td>
            <td><a href="{{ route('show_sale',$sale->id) }}">Ver cotización>></a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection