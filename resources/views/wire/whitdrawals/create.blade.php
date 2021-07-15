<!-- Modal -->
<div wire:ignore.self class="modal fade" id="add_sale_whitdrawal_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Solicitud de retiro
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <a href="#" onclick="addProviderModal();" class="float-right"><span class="icon-plus"></span> Agregar nuevo</a>
                                <label for="whitdrawal_provider_id"
                                    class="font-weight-bold color-primary-sys">Proovedor</label>
                                <select wire:model="whitdrawal_provider_id" class="custom-select">
                                    @php $providers = \App\WhitdrawalProvider::orderBy('name')->get() @endphp
                                    @foreach($providers as $provider)
                                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantity" class="font-weight-bold color-primary-sys">Monto</label>
                                <input type="number" wire:model="quantity" class="form-control" step="0.01" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="invoive" class="font-weight-bold color-primary-sys">Factura</label>
                                <select wire:model="invoive" class="custom-select">
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>                      
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="folio" class="font-weight-bold color-primary-sys">Fólio</label>
                                <input type="text" wire:model="folio" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="paid" class="font-weight-bold color-primary-sys">Pagado</label>
                                <select wire:model="paid" class="custom-select">
                                    <option value="NO">NO</option>
                                    <option value="SI">SI</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description" class="font-weight-bold color-primary-sys">Descripción</label>
                                <textarea  wire:model="description" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button wire:click = "store" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>