<!-- Modal -->
<div wire:ignore.self class="modal fade" id="edit_transaction_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Editar transacción
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
                                <label for="file">Día</label>
                                <input type="date" class="form-control" wire:model="date">
                                @error('date')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file">Banco</label>
                                <input type="text" class="form-control" wire:model="bank">
                                @error('bank')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file">Concepto | Referencia</label>
                                <input type="text" class="form-control" wire:model="concept_ref">
                                @error('concept_ref')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file">Cargo</label>
                                <input type="text" class="form-control" wire:model="chargue">
                                @error('chargue')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file">Abono</label>
                                <input type="text" class="form-control" wire:model="payment">
                                @error('payment')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file">Saldo</label>
                                <input type="text" class="form-control" wire:model="balance">
                                @error('balance')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file">Observaciones</label>
                                <input type="text" class="form-control" wire:model="description">
                                @error('description')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file">Asignar a un proyecto</label>
                                <select  wire:model="project_id" class="form-control">
                                    <option value>--Seleccione una opcíón--</option>
                                    @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file">Asignar a un retiro {{ $whitdrawal_id }}</label>
                                <select  wire:model="whitdrawal_id" class="form-control">
                                    <option value>--Seleccione una opcíón--</option>
                                    @foreach($whitdrawals as $whitdrawal)
                                    <option value="{{ $whitdrawal->id }}">{{ preg_replace( "/\r|\n/", "", trim($whitdrawal->description)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="update" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
