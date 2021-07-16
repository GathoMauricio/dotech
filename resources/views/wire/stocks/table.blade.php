<a href="{{ route('stock_product_create') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-plus"></small> Agregar producto ]</a>
<a href="{{ route('product_exits') }}" class="float-right font-weight-bold link-sys">[ <small class="  icon-share"></small> Ver últimas salidas ]</a>
<br/><br/>
@include('wire.partials.search')
@if(count($products) <= 0)
@include('layouts.no_records')
@else
{{ $products->links('pagination-links') }}
<table class="table table-striped">
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
@endif