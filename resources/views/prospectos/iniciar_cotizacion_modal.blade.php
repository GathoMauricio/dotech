<!-- Modal -->
<div class="modal fade" id="iniciar_cotizacion_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Iniciar cotización</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('iniciar_cotizacion') }}" method="POST">
                <input type="hidden" name="company_id" id="txt_iniciar_cotizacion_prospecto_id">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea name="description" class="form-control" required></textarea>
                                @error('description')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="delivery_days">Tiempo de entrega (Días)</label>
                                <input type="number" name="delivery_days" class="form-control" required>
                                @error('delivery_days')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shipping">¿Incluye envio?</label>
                                <select name="shipping" class="form-control" required>
                                    <option value>--Seleccione una opción--</option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                                @error('shipping')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="payment_type">Forma de pago</label>
                                <select name="payment_type" class="form-control" required>
                                    <option value>--Seleccione una opción--</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Deposito">Deposito</option>
                                    <option value="Transferencia">Transferencia</option>
                                    <option value="Cheque">Cheque</option>
                                </select>
                                @error('payment_type')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="credit">Crédito</label>
                                <select name="credit" class="form-control" required>
                                    <option value>--Seleccione una opción--</option>
                                    <option value="N/A">N/A</option>
                                    <option value="15 Días">15 Días</option>
                                    <option value="30 Días">30 Días</option>
                                </select>
                                @error('credit')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department_id">Departamento</label>
                                <select name="department_id" id="cbo_prospecto_iniciar_cotizacion" class="form-control"
                                    required>
                                    <option value>--Seleccione una opción--</option>

                                </select>
                                @error('department_id')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="currency">Divisa</label>
                                <select name="currency" class="form-control" required>
                                    <option value>--Seleccione una opción--</option>
                                    <option value="MXN">MXN</option>
                                    <option value="USD">USD</option>
                                </select>
                                @error('currency')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observation">Observaciones</label>
                                <textarea name="observation" class="form-control"></textarea>
                                @error('observation')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Almacenar</button>
                </div>
            </form>
        </div>
    </div>
</div>
