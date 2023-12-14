<!-- Modal -->
<div class="modal fade" id="solicitar_retiro_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Solicitar retiro
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('solicitar_retiro') }}" method="POST">
                @csrf
                <input type="hidden" name="sale_id" value="{{ $proyecto->id }}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold color-primary-sys">
                                    Proveedor
                                </label>
                                <select name="whitdrawal_provider_id" class="custom-select" required>
                                    <option value>--Seleccione una opción--</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="font-weight-bold color-primary-sys">
                                Pagado
                            </label>
                            <select name="paid" class="custom-select" required>
                                <option value>--Seleccione una opción--</option>
                                <option value="NO">NO</option>
                                <option value="SI">SI</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="font-weight-bold color-primary-sys">
                                Monto
                            </label>
                            <input type="number" name="quantity" class="form-control" step="0.01" required>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="font-weight-bold color-primary-sys">
                                Factura
                            </label>
                            <select name="invoive" class="custom-select" required>
                                <option value>--Seleccione una opción--</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="font-weight-bold color-primary-sys">
                                RFC
                            </label>
                            <input type="text" name="emisor" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="font-weight-bold color-primary-sys">
                                Folio
                            </label>
                            <input type="text" name="folio" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name" class="font-weight-bold color-primary-sys">
                                Descripción
                            </label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enviar petición</button>
                </div>
            </form>
        </div>
    </div>
</div>
