<!-- Modal -->
<div class="modal fade" id="change_status_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Cambiar estatus
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update_status_sale') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="sale_id" id="txt_change_status_id">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="currency" class="font-weight-bold color-primary-sys">
                                    Seleccione el nuevo estatus de la cotización
                                </label>
                                <select name="status" class="form-control">
                                    <option value="Proyecto">Proyecto</option>
                                    <option value="Rechazada">Rechazada</option>
                                    <option value="Finalizado">Finalizado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Cambiar estatus</button>
                </div>
            </form>
        </div>
    </div>
</div>