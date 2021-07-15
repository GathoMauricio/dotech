<p class="float-right">
    <a href="{{ route('index_proyects_finished') }}">[Proyectos finalizados]</a>
</p>
@include('wire.partials.search')
@if(count($sales) <= 0)
@include('layouts.no_records')
@else
{{ $sales->links('pagination-links') }}
<table class="table table-bordered">
    <thead>
        <tr>
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
        @if(strlen($search)>0)
            <td>{{ $sale->ID }}</td>
            <td>{{ $sale->COMPANIA }}</td>
            <td>{{ $sale->DESCRIPCION }}</td>
            <td>${{ number_format($sale->MONTO + ($sale->MONTO * 0.16),2) }}</td>
            <td>{{ onlyDate($sale->FECHA) }}</td>
            <td>
                <a href="{{ route('binnacles_by_project',$sale->ID) }}"><span class="icon-book" title="Proyecto" style="cursor:pointer;color:#8E44AD"> Bitácoras</span></a>
                <br>

                <a href="void(0);" wire:click.prevent="show({{$sale->ID}})"><span class="icon-eye" title="Proyecto" style="cursor:pointer;color:#3498DB"> Proyecto</span></a>
                <br>
                <a href="#" onclick="editProject({{ $sale->ID }});"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>
                <br>
                <a href="#" onclick="saleFollowModal({{ $sale->ID }});"><span class="icon-bubble" title="Seguimientos" style="cursor:pointer;color:#2980B9"> Seguimientos</span></a>
                @if(Auth::user()->rol_user_id == 1)
                <br>
                <a href="#" onclick="deleteSale({{ $sale->ID }})"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                @endif
            </td>
        @else
        
            <td>{{ $sale->id }}</td>
            <td>{{ $sale->company['name'] }}</td>
            <td>{{ $sale->description }}</td>
            <td>${{ number_format($sale->estimated + ($sale->estimated * 0.16),2) }}</td>
            <td>{{ onlyDate($sale->created_at) }}</td>
            <td>
                <a href="{{ route('binnacles_by_project',$sale->id) }}"><span class="icon-book" title="Proyecto" style="cursor:pointer;color:#8E44AD"> Bitácoras</span></a>
                <br>

                <a href="void(0);" wire:click.prevent="show({{$sale->id}})"><span class="icon-eye" title="Proyecto" style="cursor:pointer;color:#3498DB"> Proyecto</span></a>
                <br>
                <a href="#" onclick="editProject({{ $sale->id }});"><span class="icon-pencil" title="Editar" style="cursor:pointer;color:#F39C12"> Editar</span></a>
                <br>
                <a href="#" onclick="saleFollowModal({{ $sale->id }});"><span class="icon-bubble" title="Seguimientos" style="cursor:pointer;color:#2980B9"> Seguimientos</span></a>
                @if(Auth::user()->rol_user_id == 1)
                <br>
                <a href="#" onclick="deleteSale({{ $sale->id }})"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#C0392B"> Eliminar</span></a>
                @endif
            </td>
        
        @endif
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<input type="hidden" id="txt_delete_sale_route" value="{{ route('delete_sale') }}">
@include('projects.show_modal')
@include('projects.edit_project_modal')
@include('sale.sale_follow_modal')