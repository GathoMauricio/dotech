<!-- Modal -->
<div class="modal fade" id="edit_name_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Editar nombre
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update_user_name') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold color-primary-sys">
                                    Nombre(s)
                                </label>
                                <input name="name" value="{{ Auth()->user()->name }}" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="middle_name" class="font-weight-bold color-primary-sys">
                                    Apellido paterno
                                </label>
                                <input name="middle_name" value="{{ Auth()->user()->middle_name }}" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="last_name" class="font-weight-bold color-primary-sys">
                                    Apellido materno
                                </label>
                                <input name="last_name" value="{{ Auth()->user()->last_name }}" type="text" class="form-control" required>
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