@extends('layouts.app')
@section('content')
<a href="{{ route('create_company') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar vehiculo ]</a>
<h4 class="title_page">Vehículos</h4> 
@if(count($vehicles) <= 0)
@include('layouts.no_records')
@else
<table id="company_table_sort" class="table table-bordered">
    <thead>
        <tr>
            <th width="20%">Tipo</th>
            <th width="20%">Marca</th>
            <th width="20%">Modelo</th>
            <th width="20%">Matrícula</th>
            <th width="20%">Opciones</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
<input type="hidden" id="txt_delete_company_route" value="{{ route('delete_company') }}">
@include('companies.follow_modal')
@include('quotes.add_quote_by_company_modal')
@include('companies.add_department_company_modal')
@endif
@endsection