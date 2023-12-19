<!-- Modal -->
<div class="modal fade" id="subir_factura_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Subir factura
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('subir_factura_retiro') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="txt_retiro_id">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="document" class="font-weight-bold color-primary-sys">Documento</label>
                                <input type="file" name="document" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="folio" class="font-weight-bold color-primary-sys">Folio</label>
                                <input type="text" name="folio" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enviar petición</button>
                </div>
            </form>
        </div>
    </div>
</div>
