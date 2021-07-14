@extends('layouts.app')
@section('content')
<br><br>
<a href="{{ route('stock_product_create') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar producto ]</a>

<a href="{{ route('product_exits') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-share"></small> Ver últimas salidas ]</a>
<h4 class="title_page">Almacén</h4>

@if(count($products) <= 0)
@include('layouts.no_records')
@else
<table class="table table-striped" id="index_table">
    <thead>
        <tr>
            <th>Imagen</th>
            <th>Categoría</th>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Con regreso</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)

        @php
            $image = \App\StockProductImage::where('stock_product_id',$product->id)->orderBy('created_at', 'desc')->first();
            if($image)
            {
                $image = $image->image;
            }else{
                $image = "product_stock.png";
            }
        @endphp

        <tr>
            
            <td>
            <a href="{{ asset('storage') }}/{{ $image }}" target="_blank"><img src="{{ asset('storage') }}/{{ $image }}" width="100" /></a>
            </td>
            
            <td>{{ $product->category['name'] }}</td>
            <td>{{ $product->product }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->return }}</td>
            <td>
                <!--
                <a href="#" onclick="viewStockProductImages({{ $product->id }},{{ count(App\StockProductImage::where('stock_product_id',$product->id)->get()) }})">
                    <span class="icon-image" title="ver imágenes..." style="cursor:pointer;color:#2c49ec">
                        {{ count(App\StockProductImage::where('stock_product_id',$product->id)->get()) }}
                        Imágenes
                    </span>
                </a>
                <br>
                -->
                <a href="{{ route('stock_product_exit_index',$product->id) }}">
                    <span class="icon-share" title="Salidas..." style="cursor:pointer;color:blue">
                        Salidas
                    </span>
                </a>
                <br>
                <a href="{{ route('stock_product_edit',$product->id) }}">
                    <span class="icon-pencil" title="Editar..." style="cursor:pointer;color:green">
                        Ver/Editar
                    </span>
                </a>
                @if(Auth::user()->rol_user_id == 1)
                <br>
                <a onclick="deleteStockProduct({{ $product->id }})" href="#">
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



<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
    jQuery(document).ready(function(){
        $("#index_table").dataTable({
                deferRender: true,
                bJQueryUI: true,
                bScrollInfinite: true,
                bScrollCollapse: true,
                bPaginate: true,
                bFilter: true,
                bSort: true,
                aaSorting: [[2, "asc"]],
                pageLength: 10,
                bDestroy: true,
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [0,6]
                    },
                ],
                oLanguage: {
                    sLengthMenu: "_MENU_ ",
                    sInfo:
                        "<b>Se muestran de _START_ a _END_ elementos de _TOTAL_ registros en total</b>",
                    sInfoEmpty: "No hay registros para mostrar",
                    sSearch: "",
                    oPaginate: {
                        sFirst: "Primer página",
                        sLast: "Última página",
                        sPrevious: "<b>Anterior</b>",
                        sNext: "<b>Siguiente</b>"
                    }
                }
            });
            setTableStyle()
    });
    function setTableStyle() {
        setTimeout(function() {
            $("select[name='DataTables_Table_0_length']").prop(
                "class",
                "custom-select"
            );
            $(".dataTables_length").prepend("<b>Mostrar</b> ");
            $("select[name='table_asistencias_length']").prop(
                "class",
                "custom-select"
            );
            $("select[name='DataTables_Table_0_length']").prop(
                "class",
                "form-control"
            );
            $(".dataTables_length").append(" <b>elementos por página</b>");
    
            $("input[type='search']").prop("class", "form-control");
            $("input[type='search']").prop("placeholder", "Ingrese un filtro...");
        }, 300);
    }
</script>

<input type="hidden" id="txt_delete_binnacle_route" value="{{ route('stock_product_delete') }}">
<input type="hidden" id="txt_view_stock_product_images_route" value="">
@endif

@endsection