<!-- Modal -->
<div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    <input type="hidden" id="txt_show_product_ajax" value="{{ route('show_product_ajax') }}">
                    Editar producto
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update_product') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="txt_add_product_modal_id">
                <input type="hidden" name="sale_id" id="txt_add_product_modal_sale_id">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="currency" class="font-weight-bold color-primary-sys">
                                    Descripción del producto
                                </label>
                                <textarea id="txt_add_product_modal_description" name="description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="quantity" class="font-weight-bold color-primary-sys">
                                    Cantidad
                                </label>
                                <input id="txt_add_product_modal_quantity" type="number" name="quantity" value="1" min="1" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="measure" class="font-weight-bold color-primary-sys">
                                    Unidad de medida
                                </label>
                                <input id="txt_add_product_modal_measure" type="text" name="measure" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="discount" class="font-weight-bold color-primary-sys">
                                    Descuento
                                </label>
                                <input id="txt_add_product_modal_discount" type="number" name="discount" value="0" min="0" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="unity_price_sell" class="font-weight-bold color-primary-sys">
                                    P/U Venta
                                </label>
                                <input type="number"  step="0.01" id="txt_add_product_modal_unity_price_sell" name="unity_price_sell" value="1" min="1" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Actalizar</button>
                </div>
            </form>
        </div>
    </div>
</div>