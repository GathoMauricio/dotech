<!-- Modal -->
<div class="modal fade" id="stock_category_products_create_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Agregar categoría del producto
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('store_category_product') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="vehicle_id" id="txt_add_vehicle_image_id">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="currency" class="font-weight-bold color-primary-sys">
                                    Nueva categoría
                                </label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>