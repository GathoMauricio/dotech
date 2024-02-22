<!-- Modal -->
<div class="modal fade" id="prospectos_seguimientos_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seguimientos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 200px;overflow: hidden;overflow-y: scroll;" id="caja_seguimientos">
            </div>
            <div class="modal-footer">
                <form action="#" id="form_store_seguimiento_prospecto" method="POST" style="width: 100%;">
                    @csrf
                    <input type="hidden" name="prospecto_id" id="txt_seguimiento_prospecto_id">
                    <div class="form-group">
                        <label>Tipo de seguimiento</label>
                        <select name="tipo_seguimiento" id="cbo_tipo_seguimiento" class="custom-select">
                            <option value="Respondio">Respondio</option>
                            <option value="No espondio">No espondio</option>
                            <option value="No existe">No existe</option>
                            <option value="Número equivocado">Número equivocado</option>
                            <option value="Manda a buzón">Manda a buzón</option>
                        </select>
                    </div>
                    <table style="width: 100%;">
                        <tr>
                            <td width="90%">
                                <input type="text" id="txt_body_seguimiento" name="body" class="form-control"
                                    placeholder="Escriba aquí..." required>
                            </td>
                            <td width="10%">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

        </div>
    </div>
</div>
