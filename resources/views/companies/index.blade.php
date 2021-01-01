@extends('layouts.app')
@section('content')
<a href="{{ route('create_company') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar compañía ]</a>
<h4 class="title_page">Compañías</h4> 
@if(count($companies) <= 0)
@include('layouts.no_records')
@else
<input type="hidden" id="txt_index_company_route" value="{{ route('company_index_ajax') }}">
<table id="company_table_sort" class="table table-bordered">
    <thead>
        <tr>
            <th width="20%">Nombre</th>
            <th width="20%">Enacargado</th>
            <th width="20%">Email</th>
            <th width="20%">Teléfono</th>
            <th width="20%">Opciones</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
@include('companies.follow_modal')
@include('quotes.add_quote_by_company_modal')
@endif
@endsection