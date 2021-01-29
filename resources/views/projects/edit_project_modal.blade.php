<!-- Modal -->
<div class="modal fade" id="edit_project_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">Actualizar proyecto
                    para <span id="edit_quote_modal_company"></span> </h5>
                <input type="hidden" id="txt_show_quote_modal_ajax" value="{{ route('show_quote_ajax') }}">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update_quote') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="sale_id" id="edit_quote_modal_sale_id">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="font-weight-bold color-primary-sys">
                                        Descripción
                                    </label>
                                    <textarea name="description" class="form-control"
                                        id="edit_quote_modal_description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="observation" class="font-weight-bold color-primary-sys">
                                        Observaciones
                                    </label>
                                    <textarea name="observation" class="form-control"
                                        id="edit_quote_modal_observation"></textarea>
                                </div>
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