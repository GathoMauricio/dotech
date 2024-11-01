<div wire:ignore.self class="full-modal" id="full_modal_index_products">
    <p>
        <span wire:click="dissmisFullModal" class="icon-cross float-right p-3" style="cursor:pointer;"></span>
    </p>
    @if (!is_null($currentQuote))
        <div class="col-md-11 float-right">
            <h3 class="m-3">
                Productos: {{ $currentQuote->description }} (<i>{{ $currentQuote->company['name'] }})</i>
            </h3>

            <a href="#" onclick="createProductQuote();"><span class="icon-plus"></span> Agregar producto</a>
            <a href="{{ route('load_sale_pdf', $currentQuote->id) }}" style="color:red" target="_blank"><span
                    class="icon-file-pdf"></span> Generar cotización</a>
            @if (count($products) <= 0)
                @include('layouts.no_records')
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cant</th>
                            <th>U. Medida</th>
                            <th>Producto</th>
                            <th>P/U</th>
                            {{--  <th>Descuento %</th>  --}}
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    @if (!empty($product->measure))
                                        {{ $product->measure }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $product->description }}</td>
                                <td>${{ number_format($product->unity_price_sell, 2) }}</td>
                                {{--  <td>{{ $product->discount }}%</td>  --}}
                                <!--<td>${{ number_format($product->unity_price_sell * $product->quantity, 2) }}</td>-->
                                <td>${{ number_format($product->total_sell, 2) }}</td>
                                <td>
                                    <span wire:click="editQuoteProduct({{ $product->id }})" class="icon-pencil"
                                        style="cursor:pointer;color:#F39C12;"></span>
                                    <br>
                                    <span onclick="destroyProductQuote({{ $product->id }})" class="icon-bin"
                                        style="cursor:pointer;color:#E74C3C ;"></span>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="7" class="text-right">Subtotal: ${{ $subtotal }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-right">IVA: ${{ $iva }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-right">Total: ${{ $total }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>
    @endif
</div>
