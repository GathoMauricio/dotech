<!-- Modal -->
<div class="modal fade" id="add_maintenance_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Agregar mantenimiento
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('maintenance_store') }}" method="POST">
                @csrf
                <input type="hidden" name="vehicle_id" id="txt_add_maintenance_id">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="maintenance_type_id" class="font-weight-bold color-primary-sys">
                                    Tipo
                                </label>
                                <select onchange="checkSectionOther(this.value)" name="maintenance_type_id" class="form-control">
                                    @php
                                        $types = App\MaintenanceType::orderBy('id')->get();
                                    @endphp
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kilometers" class="font-weight-bold color-primary-sys">
                                    Kilometros
                                </label>
                                <input type="text" name="kilometers" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="section_other_type" style="display: none;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="other" class="font-weight-bold color-primary-sys">
                                    Otro
                                </label>
                                <input type="text" name="other" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date" class="font-weight-bold color-primary-sys">
                                    Fecha
                                </label>
                                <input type="date" name="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="amount" class="font-weight-bold color-primary-sys">
                                    Monto
                                </label>
                                <input type="text" name="amount" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description" class="font-weight-bold color-primary-sys">
                                    Descripción
                                </label>
                                <textarea name="description" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>