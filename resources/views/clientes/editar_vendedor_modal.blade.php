<!-- Modal -->
<div class="modal fade" id="editar_vendedor_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Editar vendedor</h4>
                <input type="hidden" id="txt_cliente_id" />
            </div>
            <div class="modal-body">
                <select class="form-control" id="cbo_vendedor_id">
                    <option value>--Seleccione una opción--</option>
                    @foreach ($vendedores as $vendedor)
                        <option value="{{ $vendedor->id }}">{{ $vendedor->name }} {{ $vendedor->middle_name }}
                            {{ $vendedor->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="$('#editar_vendedor_modal').modal('hide')" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarVendedor();">Guardar</button>
            </div>
        </div>
    </div>
</div>
