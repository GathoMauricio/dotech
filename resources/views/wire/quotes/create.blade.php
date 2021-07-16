<div wire:ignore.self class="full-modal" id="full_modal_create_quote">
    <p>
        <span wire:click="dissmisFullModal" class="icon-cross float-right p-3" style="cursor:pointer;"></span>
    </p>
<div class="col-md-11 float-right">
    <h3 class="m-3">
        Crear cotización
    </h3>

    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <!--
                                    <a href="{{ route('create_company') }}"class="float-right"><span class="icon-plus"></span> Agregar compañía</a>
                                    -->
                                    <label for="company_id" class="color-primary-sys font-weight-bold">Compañía</label>
                                    <select wire:model="company_id"  wire:change="changeCompany"  class="custom-select">
                                        <option value>::Seleccione una opción::</option>
                                        @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('company_id') <span class="error-message">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <!--
                                    <a href="#" onclick="addDepartmentCompanyModal()" class="float-right"><span class="icon-plus"></span> Agregar departamento</a>
                                    -->
                                    <label for="department_id" class="color-primary-sys font-weight-bold">
                                        Departamento
                                    <span id="load_departments_by_company" class="icon-spinner9 float-right" style="color:#3498DB;display:none"></span>
                                    </label>
                                    
                                    <select wire:model="department_id" id="cbo_departments_by_company" class="custom-select">
                                        <option value>::Seleccione una opción::</option>
                                        @if(!is_null($departments))
                                        @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }} - {{ $department->email }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('department_id') <span class="error-message">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="delivery_days" class="font-weight-bold color-primary-sys">
                                        Tiempo de entrega (Días)
                                    </label>
                                    <input wire:model="delivery_days" type="text" 
                                        min="0"  class="form-control"  />
                                    @error('delivery_days') <span class="error-message">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description" class="font-weight-bold color-primary-sys">
                                        Detalles de la cotización
                                    </label>
                                    <textarea wire:model="description" class="form-control" ></textarea>
                                    @error('description') <span class="error-message">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="observation" class="font-weight-bold color-primary-sys">
                                        Observaciones
                                    </label>
                                    <textarea wire:model="observation" class="form-control"></textarea>
                                    @error('observation') <span class="error-message">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="shipping" class="font-weight-bold color-primary-sys">
                                        Incluye envio
                                    </label>
                                    <select wire:model="shipping" class="form-control">
                                        <option value>::Seleccione una opción::</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    @error('shipping') <span class="error-message">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="payment_type" class="font-weight-bold color-primary-sys">
                                        Forma de pago
                                    </label>
                                    <select wire:model="payment_type" class="form-control" >
                                        <option value>::Seleccione una opción::</option>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Deposito">Deposito</option>
                                        <option value="Transferencia">Transferencia</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                    @error('payment_type') <span class="error-message">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="credit" class="font-weight-bold color-primary-sys">
                                        Crédito
                                    </label>
                                    <select wire:model="credit" class="form-control">
                                        <option value>::Seleccione una opción::</option>
                                        <option value="N/A">N/A</option>
                                        <option value="15 Días">15 Días</option>
                                        <option value="30 Días">30 Dias</option>
                                    </select>
                                    @error('credit') <span class="error-message">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="currency" class="font-weight-bold color-primary-sys">
                                        Divisa
                                    </label>
                                    <select wire:model="currency" class="form-control">
                                        <option value>::Seleccione una opción::</option>
                                        <option value="MXN">MXN</option>
                                        <option value="USD">USD</option>
                                    </select>
                                    @error('currency') <span class="error-message">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 content">
                            <button wire:click="store" class="btn btn-primary float-right">Agregar</button>
                        </div>
                    </div>

</div>