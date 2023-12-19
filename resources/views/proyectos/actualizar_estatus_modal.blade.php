<div class="modal fade" id="actualizar_estatus_modal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Actualizar estatus
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('actualizar_estatus_proyecto') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="sale_id" value="{{ $proyecto->id }}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status" class="font-weight-bold color-primary-sys">
                                    Estatus
                                </label>
                                <select name="status" class="custom-select" required>
                                    @if ($proyecto->status == 'Finalizado')
                                        <option value="Finalizado" selected>Finalizado</option>
                                        <option value="Rechazada">Rechazada</option>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Proyecto">Proyecto</option>
                                    @endif
                                    @if ($proyecto->status == 'Rechazada')
                                        <option value="Finalizado">Finalizado</option>
                                        <option value="Rechazada" selected>Rechazada</option>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Proyecto">Proyecto</option>
                                    @endif
                                    @if ($proyecto->status == 'Pendiente')
                                        <option value="Finalizado">Finalizado</option>
                                        <option value="Rechazada">Rechazada</option>
                                        <option value="Pendiente" selected>Pendiente</option>
                                        <option value="Proyecto">Proyecto</option>
                                    @endif
                                    @if ($proyecto->status == 'Proyecto')
                                        <option value="Finalizado">Finalizado</option>
                                        <option value="Rechazada">Rechazada</option>
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Proyecto" selected>Proyecto</option>
                                    @endif
                                </select>
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
