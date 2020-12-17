@extends('layouts.app')
@section('content')
<h4 class="title_page">
    @if($sale->status == 'Pendiente')
    Cotización
    @else
    {{ $sale->status }} 
    @endif
    {{ $sale->description }} 
    - 
    {{ $sale->company['name'] }}
</h4>
@endsection