<!-- Modal -->
<div class="modal fade" id="modal_preview_proyecto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-info" id="exampleModalLabel">
                    Detalles del proyecto <span id="span_folio_proyecto"></span>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container">
                <div class="row">
                    <div class="col-md-12">
                        <b>Autor: </b> <span id="span_autor"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <b>Cliente:</b>
                        <br>
                        <span id="span_cliente"></span>
                    </div>
                    <div class="col-md-6">
                        <b>Departamento:</b>
                        <br>
                        <span id="span_departamento"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <b>Descripción: </b> <span id="span_descripcion"></span>
                    </div>
                    <div class="col-md-6">
                        <b>$: </b> <span id="span_estimado"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <b>Observaciones: </b> <span id="span_observaciones"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <a href="#" id="link_abrir_proyecto" target="_BLANK" class="btn btn-primary">Abrir proyecto</a>
            </div>
        </div>
    </div>
</div>
