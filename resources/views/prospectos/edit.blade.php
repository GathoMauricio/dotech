<!-- Modal -->
<div class="modal fade" id="prospectos_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear prospecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('update_prospecto') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="prospecto_id" id="txt_edit_prospecto_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="javascript:void(0)" onclick="nuevoOrigen();" class="float-right">Nuevo
                                    origen</a>
                                <label for="origin">Origen</label>
                                <select name="origin" id="cbo_edit_origin" class="form-control" required>
                                    <option value>--Seleccione una opción--</option>
                                    @foreach ($origenes as $key => $origen)
                                        <option value="{{ $origen->origen }}">{{ $origen->origen }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="txt_edit_name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="responsable">Responsable</label>
                                <input type="text" name="responsable" id="txt_edit_responsable" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Teléfono</label>
                                <input type="text" name="phone" id="txt_edit_phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="txt_edit_email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="status">Estatus</label>
                            <select name="status" id="cbo_edit_status" class="form-control" required>
                                <option value>--Seleccione una opción--</option>
                                <option value="Prospecto">Prospecto</option>
                                <option value="Cliente">Cliente</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
