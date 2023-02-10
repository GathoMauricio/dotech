<!-- Modal -->
<div wire:ignore.self class="modal fade" id="show_transacciones_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold color-primary-sys" id="exampleModalLabel">
                    Transacciones
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table  class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Cargo</th>
                            <th>Pago</th>
                            <th>Observaciones</th>
                            <th>Banco</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($currentTransactions))
                            @foreach($currentTransactions as $transaction)
                            <tr>
                                <td>{{ $transaction->transaction->concept_ref }}</td>
                                <td>${{ $transaction->transaction->chargue }}</td>
                                <td>${{ $transaction->transaction->payment }}</td>
                                <td>{{ $transaction->transaction->description }}</td>
                                <td>{{ $transaction->transaction->bank }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
