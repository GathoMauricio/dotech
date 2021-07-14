<!-- Modal -->
<div class="modal fade" id="add_vehicle_verification_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Agregar verificación del vehiculo
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('store_vehicle_verification') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="vehicle_id" id="txt_add_vehicle_verification_id">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="date" class="font-weight-bold color-primary-sys">
                                    Fecha
                                </label>
                                <input type="date" name="date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kilometers" class="font-weight-bold color-primary-sys">
                                    Kilometraje
                                </label>
                                <input type="text" name="kilometers" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="type" class="font-weight-bold color-primary-sys">
                                    Tipo
                                </label>
                                <select name="type" class="form-control" required>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="currency" class="font-weight-bold color-primary-sys">
                                    Imagen
                                </label>
                                <input type="file" name="image" class="form-control" accept="image/x-png,image/gif,image/jpeg" required>
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