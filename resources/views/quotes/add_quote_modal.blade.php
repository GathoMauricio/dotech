<!-- Modal -->
<div class="modal fade" id="add_quote_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Agregar cotización
                </h5>
                <input type="hidden" id="txt_show_company_ajax_route" value="{{ route('company_show_ajax') }}">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('store_quote') }}" method="POST">
                @csrf
                <input type="hidden" name="company_id" id="add_quote_by_company_modal_company_id">
                <input type="hidden" name="status" value="Pendiente">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="company_id" class="color-primary-sys font-weight-bold">Compañía</label>
                                    <input type="hidden" id="txt_route_load_departments_by_id" value="{{ route('load_departments_by_id') }}">
                                    <select onchange="loadDepartmentsByCompany(this.value)" name="company_id" class="custom-select">
                                        @php 
                                            $companies = \App\Company::orderBy('name')->get(); 
                                            $company_id= $companies[0]->id;
                                            @endphp
                                        @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('company_id'))
                                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('company_id') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span id="load_departments_by_company" class="icon-spinner9 float-right" style="color:#3498DB;display:none"></span>
                                    <label for="department_id" class="color-primary-sys font-weight-bold">Departamento</label>
                                    <select name="department_id" id="cbo_departments_by_company" class="custom-select">
                                        @php 
                                            $departments = \App\CompanyDepartment::where('company_id',$company_id)->get(); 
                                        @endphp
                                        @foreach($departments as $department)
                                        @if($sale->department_id == $department->id)
                                        <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                                        @else
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @if($errors->has('department_id'))
                                    <small class="color-primary-sys font-weight-bold">{{ $errors->first('department_id') }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description" class="font-weight-bold color-primary-sys">
                                        Detalles de la cotización
                                    </label>
                                    <textarea name="description" class="form-control" 
                                        required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="observation" class="font-weight-bold color-primary-sys">
                                        Observaciones
                                    </label>
                                    <textarea name="observation" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="delivery_days" class="font-weight-bold color-primary-sys">
                                        Tiempo de entrega (Días)
                                    </label>
                                    <input name="delivery_days" type="number" 
                                        min="0" value="0" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping" class="font-weight-bold color-primary-sys">
                                        Incluye envio
                                    </label>
                                    <select name="shipping" class="form-control">
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_type" class="font-weight-bold color-primary-sys">
                                        Forma de pago
                                    </label>
                                    <select name="payment_type" class="form-control" >
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Deposito">Deposito</option>
                                        <option value="Transferencia">Transferencia</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="credit" class="font-weight-bold color-primary-sys">
                                        Crédito
                                    </label>
                                    <select name="credit" class="form-control">
                                        <option value="N/A">N/A</option>
                                        <option value="15 Días">15 Días</option>
                                        <option value="30 Días">30 Dias</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="currency" class="font-weight-bold color-primary-sys">
                                        Divisa
                                    </label>
                                    <select name="currency" class="form-control">
                                        <option value="MXN">MXN</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>