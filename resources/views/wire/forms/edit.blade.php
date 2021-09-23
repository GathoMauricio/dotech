<!-- Modal -->
<div wire:ignore.self class="modal fade" id="edit_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Editar machote
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input wire:model="name" type="text" class="form-control">
                                @error('name') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea  wire:model="description"  class="form-control"></textarea>
                                @error('description') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <a href="{{ asset('storage/forms') }}/{{ $document }}" target = "_blank">{{ $document }}</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
               
            <div class="modal-footer">
                    <button wire:click = "update" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>