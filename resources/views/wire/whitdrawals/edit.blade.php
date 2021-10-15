<!-- Modal -->
<div wire:ignore.self class="modal fade" id="edit_whitdrawal_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Editar retiro
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <textarea wire:model = "descripcion" class="form-control"></textarea>
                                @error('descripcion') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Costo</label>
                                <input type = "number" wire:model = "quantity" step ="0.01"class="form-control" />
                                @error('quantity') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">RFC Emisor</label>
                                <input type = "text" wire:model = "emisor" class="form-control" />
                                @error('emisor') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Folio fiscal</label>
                                <input type = "text" wire:model = "folio_fiscal" class="form-control" />
                                @error('folio_fiscal') <span class="error-message">{{ $message }}</span> @enderror
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