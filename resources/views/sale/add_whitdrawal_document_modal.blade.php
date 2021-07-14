<!-- Modal -->
<div class="modal fade" id="add_whitdrawal_document_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Agregar docmento del retiro
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('store_whitdrawal_document') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="txt_add_whitdrawal_document_modal_id">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="document" class="font-weight-bold color-primary-sys">Documento</label>
                                    <input type="file" name="document" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="folio" class="font-weight-bold color-primary-sys">Folio</label>
                                    <input type="text" name="folio" class="form-control" required />
                                </div>
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