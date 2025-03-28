<!-- Modal -->
<div class="modal fade" id="anadir_lista_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Añadir a lista</h4>
            </div>
            <form action="{{ route('anadir_lista') }}" method="POST">
                @csrf
                <input type="hidden" name="cliente_id" value="{{ $cliente_id }}" />
                <div class="modal-body">
                    <select class="form-control" name="lista_id">
                        <option value>--Seleccione una opción--</option>
                        @foreach ($listas as $lista)
                            <option value="{{ $lista->id }}">{{ $lista->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="$('#anadir_lista_modal').modal('hide')" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>
