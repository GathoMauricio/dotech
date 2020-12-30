@extends('layouts.app')
@section('content')
<h4 class="title_page">Seguimientos de {{ $sale->description }} para {{ $sale->company['name'] }}</h4>
<a href="#" onclick="addSaleFollowModal({{ $sale->id }});">Agregar seguimiento</a>
@if(count($follows) <= 0)
@include('layouts.no_records')
@else
{{ $follows->links() }}
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Author</th>
            <th>Comentario</th>
            <th>Fecha</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($follows as $follow)
        <tr>
            <td>{{ $follow->author['name'] }} {{ $follow->author['middle_name'] }} {{ $follow->author['last_name'] }}</td>
            <td>{{ $follow->body }}</td>
            <td>{{ formatDate($follow->created_at) }}</td>
            <td>Opc</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@include('sale.add_sale_follow_modal')
@endsection