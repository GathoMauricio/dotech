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
                                    Inversión estimada
                                </label>
                                <input type = "number" name = "investment" step="0.01" id ="txt_change_status_id_investment" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="currency" class="font-weight-bold color-primary-sys">
                                    Seleccione el nuevo estatus de la cotización
                                </label>
                                <select name="status" onchange="isQuoteReject(this.value)" class="form-control">
                                    <option value="Proyecto">Proyecto</option>
                                    <option value="Rechazada">Rechazada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" style="display:none;" id="div_quote_reject_follow">
                            <div class="form-group">
                                <label for="follow" class="font-weight-bold color-primary-sys">
                                    Agregue una descripción*
                                </label>
                                <textarea name="follow" id="txt_quote_reject_follow" class="form-control"></textarea>
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
<input type ="hidden" id = "get_sale_ajax" value ="{{ route('show_sale_ajax') }}"/>