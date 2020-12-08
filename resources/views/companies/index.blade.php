@extends('layouts.app')
@section('content')
<a href="#" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar compañía ]</a>
<h4 class="title_page">Compañías</h4> 
@if(count($companies) <= 0)
@include('layouts.no_records')
@else
<!--
<div id="company_table_renderrender"></div>
-->
<input type="hidden" id="txt_index_company_route" value="{{ route('company_index_ajax') }}">
<table id="company_table_sort" class="table table-bordered">
    <thead>
        <tr>
            <th >Nombre</th>
            <th >Enacargado</th>
            <th >Email</th>
            <th >Teléfono</th>
            <!--<th >Dirección</th>-->
            <th >Opciones</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@endif
@endsection