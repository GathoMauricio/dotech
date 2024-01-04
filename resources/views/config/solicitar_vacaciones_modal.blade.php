<!-- Modal -->
<div class="modal fade" id="solicitar_vacaciones_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Solicitar vacaciones</h5>
            </div>
            <form action="{{ route('solicitar_vacaciones') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tipo">Tipo</label>
                                    <select name="tipo" class="custom-select">
                                        <option value="vacaciones">Vacaciones</option>
                                        <option value="permiso">Permiso</option>
                                        <option value="falta">Falta</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="dias">Dias</label>
                                    <input type="number" name="dias" class="form-control" min="1"
                                        max="{{ $user->dias_restantes }}" value="1" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de incio</label>
                                    <input type="date" name="fecha_inicio" class="form-control"
                                        min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="motivo">Motivo</label>
                                    <textarea name="motivo" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" onclick="$('#modal_editar_password').modal('hide')" class="btn btn-secondary"
                        data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Solicitar</button>
                </div>
            </form>
        </div>
    </div>
</div>
