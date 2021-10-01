<!-- Modal -->
<div class="modal fade" id="edit_company_document_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Actualizar documento
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update_company_document') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id = "txt_edit_company_document_id">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="currency" class="font-weight-bold color-primary-sys">
                                    Documento
                                </label>
                                <a href="#" target="_blank" id="a_edit_company_document_document">Document</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="currency" class="font-weight-bold color-primary-sys">
                                    Descripción del documento
                                </label>
                                <textarea name="description" class="form-control" id = "txt_edit_company_document_description" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>