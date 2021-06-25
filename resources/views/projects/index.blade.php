@extends('layouts.app')
@section('content')
<h4 class="title_page ">Proyectos</h4>
<p class="float-right">
    <a href="{{ route('index_proyects_finished') }}">[Proyectos finalizados]</a>
</p>
@if(count($sales) <= 0)
@include('layouts.no_records')
@else
{{ $sales->links() }}
<table class="table table-bordered">
    <thead>
        <tr>
            <tr>
                <td colspan="6" width="100%">
                    
                    <!--
                    <input id="txt_search_project" class="form-control" placeholder="Buscar..." />
                    <input type="hidden" id="txt_search_project_route_ajax" value="{{ route('search_project_ajax') }}">
                    <input type="hidden" id="txt_show_project_route_ajax" value="{{ route('show_project_ajax') }}">
                    -->
                    <input onkeyup="searchProjects(this.value)" id="txt_search_project2" class="form-control" placeholder="Buscar..." />
                    <input type="hidden" id="txt_search_project_route_ajax2" value="{{ route('search_project_ajax2') }}">
                    <span id="span_result"></span>
                </td>
            </tr>
            <th width="15%">Folio</th>
            <th width="15%">Compañía</th>
            <th width="25%">Descriptción</th>
            <th width="15%">Costo</th>
            <th width="15%">Fecha</th>
            <th width="15%"></th>
        </tr>
    </thead>
    <tbody id="tbl_projects_to_search">
        @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->id }}</td>
            <td>{{ $sale->company['name'] }}</td>
            <td>{{ $sale->description }}</td>
            <td>${{ number_format($sale->estimated + ($sale->estimated * 0.16),2) }}</td>
            <td>{{ onlyDate($sale->created_at) }}</td>
            <td>
                <a href="{{ route('binnacles_by_project',$sale->id) }}"><span class="icon-book" title="Proyecto" style="cursor:pointer;color:#8E44AD"> Bitácoras</span></a>
                <br>

                <a href="{{ route('show_sale',$sale->id) }}"><span class="icon-eye" title="Proyecto" style="cursor:pointer;color:#3498DB"> Proyecto</span></a>
                <br>

                <a href="#" onclick="editProject({{ $sale->id }});"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>
                <br>

                <a href="#" onclick="saleFollowModal({{ $sale->id }});"><span class="icon-bubble" title="Seguimientos" style="cursor:pointer;color:#2980B9"> Seguimientos</span></a>
                
                @if(Auth::user()->rol_user_id == 1)
                <br>
                <a href="#" onclick="deleteSale({{ $sale->id }})"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<input type="hidden" id="txt_delete_sale_route" value="{{ route('delete_sale') }}">
@include('projects.show_modal')
@include('projects.edit_project_modal')
@include('sale.sale_follow_modal')
@endif
@endsection
