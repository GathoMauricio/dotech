<a href="javascript:void(0)" onclick="$('#upload_file_modal').modal();" class="float-right"> [<span class="icon-upload">
        Cargar documento<span>]</a>
<br><br>
<a href="{{ asset('file/template_excel.xlsx') }}" target="_blank" class="float-right"> [<span class="icon-download">
        Descargar template<span>]</a>
<br><br>
{{ $transactions->links('pagination-links') }}
<button onclick="$('#create_transaction_modal').modal()" class="btn btn-primary float-right"> <span
        class="icon icon-plus"></span> Nuevo</button>
<br><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th scope="col">Banco</th>
            <th width="10%" scope="col">Día</th>
            <th scope="col">Concepto / Referencia</th>
            <th scope="col">Cargo</th>
            <th scope="col">Abono</th>
            <th scope="col">Saldo</th>
            <th scope="col">Observaciones</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->bank }}</td>
                <td>{{ $transaction->date }}</td>
                <td>{{ $transaction->concept_ref }}</td>
                <td>
                    @if ($transaction->chargue)
                        ${{ $transaction->chargue }}
                    @else
                        <center><strong>-</strong></center>
                    @endif
                </td>
                <td>
                    @if ($transaction->payment)
                        ${{ $transaction->payment }}
                    @else
                        <center><strong>-</strong></center>
                    @endif
                </td>
                <td>
                    @if ($transaction->balance)
                        ${{ $transaction->balance }}
                    @else
                        <center><strong>-</strong></center>
                    @endif
                </td>
                <td>
                    @if ($transaction->description)
                        {{ $transaction->description }}
                    @else
                        <center><strong>-</strong></center>
                    @endif
                </td>
                <td>
                    <button wire:click="edit({{ $transaction->id }});" class="btn btn-warning btn-block">
                        <span class="icon-pencil"></span>Editar
                    </button>

                    <button onclick="deleteTransaction({{ $transaction->id }});" class="btn btn-danger btn-block">
                        <span class="icon-bin"></span>Eliminar
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $transactions->links('pagination-links') }}
