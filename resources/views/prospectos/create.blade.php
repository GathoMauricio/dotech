<!-- Modal -->
<div class="modal fade" id="prospectos_create_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear prospecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('store_prospecto') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <a href="javascript:void(0)" onclick="nuevoOrigen();" class="float-right">Nuevo
                                    origen</a>
                                <label for="origin">Origen</label>
                                <select name="origin" id="cbo_origin" class="form-control" required>
                                    <option value>--Seleccione una opción--</option>
                                    @foreach ($origenes as $key => $origen)
                                        <option value="{{ $origen->origen }}">{{ $origen->origen }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="porcentaje">Porcentaje %</label>
                                @if (Auth::user()->hasRole('Administrador'))
                                    <select name="porcentaje" id="cbo_porcentaje" class="form-control" required>
                                        <option value>--Seleccione una opción--</option>
                                        <option value="8">8%</option>
                                        <option value="13">13%</option>
                                    </select>
                                @else
                                    <center><strong>8%</strong></center>
                                    <input type="hidden" name="porcentaje" value="8" readonly>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="responsable">Responsable</label>
                                <input type="text" name="responsable" id="responsable" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Teléfono</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="web">URL</label>
                                <input type="text" name="web" id="web" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="giro">Giro</label>
                                <input type="text" name="giro" id="giro" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
