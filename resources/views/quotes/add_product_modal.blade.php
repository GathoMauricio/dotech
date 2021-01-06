<!-- Modal -->
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Agregar producto
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('store_product') }}" method="POST">
                @csrf
                <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="currency" class="font-weight-bold color-primary-sys">
                                    Descripción del producto
                                </label>
                                <textarea name="description" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="quantity" class="font-weight-bold color-primary-sys">
                                    Cantidad
                                </label>
                                <input type="number" name="quantity" value="1" min="1" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="measure" class="font-weight-bold color-primary-sys">
                                    Unida de medida
                                </label>
                                <input type="text" name="measure" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="discount" class="font-weight-bold color-primary-sys">
                                    Descuento
                                </label>
                                <input type="number" name="discount" value="0" min="0" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="unity_price_sell" class="font-weight-bold color-primary-sys">
                                    P/U Venta
                                </label>
                                <input type="number" step="0.01" name="unity_price_sell" value="1" min="1" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>