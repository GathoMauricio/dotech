<div class="modal fade" id="add_binnacle_modal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Agregar bitácora
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('store_binnacle') }}" method="POST">
                @csrf
                <input type="hidden" name="_token" value="hj0DbnoNyJtHVcs4WJEfUr8yQqIDsWhognVw8WPe">
                <input type="hidden" name="sale_id" value="{{ $proyecto->id }}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="currency" class="font-weight-bold color-primary-sys">
                                    Descripción de la bitácora
                                </label>
                                <textarea name="description" class="form-control" required=""></textarea>
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
