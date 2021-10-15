<!-- Modal -->
<div class="modal fade" id="add_provider_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Agregar proveedor
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('store_whitdrawal_provider') }}" method="POST">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="currency" class="font-weight-bold color-primary-sys">
                                    Nombre
                                </label>
                                <input name="name" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bank" class="font-weight-bold color-primary-sys">
                                    Banco
                                </label>
                                <input name="bank" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account" class="font-weight-bold color-primary-sys">
                                    Cuenta
                                </label>
                                <input name="account" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pay_type" class="font-weight-bold color-primary-sys">
                                    Forma pago
                                </label>
                                <input name="pay_type" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rfc" class="font-weight-bold color-primary-sys">
                                    rfc
                                </label>
                                <input name="rfc" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="font-weight-bold color-primary-sys">
                                    Dirección
                                </label>
                                <input name="address" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="manager" class="font-weight-bold color-primary-sys">
                                    Ejecutivo
                                </label>
                                <input name="manager" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="font-weight-bold color-primary-sys">
                                    Telefono
                                </label>
                                <input name="phone" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>