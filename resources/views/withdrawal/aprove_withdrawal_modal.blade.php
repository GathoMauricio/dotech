<!-- Modal -->
<div class="modal fade" id="aprove_withdrawal_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Aprovar retiro
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('apreove_withdrawal') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="txt_aprove_withdrawal_modal_id">
                <input type="hidden" name="status" value="Aprobado">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="whitdrawal_account_id" class="font-weight-bold color-primary-sys">
                                    Seleccione la cuenta
                                </label>
                                <select name="whitdrawal_account_id" class="custom-select">
                                    @php $accounts = App\WhitdrawalAccount::orderBy('name')->get();  @endphp
                                    @foreach($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account['name'] }} - ${{ $account->balance }} - {{ $account->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="whitdrawal_department_id" class="font-weight-bold color-primary-sys">
                                    Seleccione el departamento
                                </label>
                                <select name="whitdrawal_department_id" class="custom-select">
                                    @php $departments = App\WhitdrawalDepartment::orderBy('name')->get();  @endphp
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type" class="font-weight-bold color-primary-sys">
                                    Seleccione el tipo de retiro
                                </label>
                                <select name="type" class="custom-select">
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Transferencia">Transferencia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Aprovar</button>
                </div>
            </form>
        </div>
    </div>
</div>