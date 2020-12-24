<!--Company Show Modal -->
<div class="modal fade" id="conmpany_show_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    <input type="hidden" id="txt_company_show_ajax" value="{{ route('company_show_ajax') }}">
                    Detalles de la compañía
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="color-primary-sys font-weight-bold">
                                Origen: 
                            </label>
                            <span id="span_origin_modal">---</span>
                        </div>
                        <div class="col-md-6">
                            <label class="color-primary-sys font-weight-bold">
                                Estatus: 
                            </label>
                            <span id="span_status_modal">---</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="color-primary-sys font-weight-bold">
                                Nombre: 
                            </label>
                            <span id="span_name_modal">---</span>
                        </div>
                        <div class="col-md-6">
                            <label class="color-primary-sys font-weight-bold">
                                Responsable: 
                            </label>
                            <span id="span_responsable_modal">---</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="color-primary-sys font-weight-bold">
                                RFC: 
                            </label>
                            <span id="span_rfc_modal">---</span>
                        </div>
                        <div class="col-md-4">
                            <label class="color-primary-sys font-weight-bold">
                                Email: 
                            </label>
                            <span id="span_email_modal">---</span>
                        </div>
                        <div class="col-md-4">
                            <label class="color-primary-sys font-weight-bold">
                                Phone: 
                            </label>
                            <span id="span_phone_modal">---</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="color-primary-sys font-weight-bold">
                                Dirección: 
                            </label>
                            <span id="span_address_modal">---</span>
                        </div>
                        <div class="col-md-6">
                            <label class="color-primary-sys font-weight-bold">
                                Descripción: 
                            </label>
                            <span id="span_description_modal">---</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>