<div class="modal fade" id="actualizar_descripcion_modal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Actualizar descrición
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('actualizar_descripcion_proyecto') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="sale_id" value="{{ $proyecto->id }}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status" class="font-weight-bold color-primary-sys">
                                    Descripción
                                </label>
                                <textarea class="form-control" name="description" id="txt_actualizar_descripcion"></textarea>
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
