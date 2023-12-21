<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Transaction;
use App\ProjectTransaction;
use App\Sale;
use App\Whitdrawal;
use App\WithdrawalTransaction;
use App\Http\Controllers\DataMigrater;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TransactionsComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];

    public $self_component = "transactions";

    public $transaction, $file, $date, $concept_ref, $chargue, $payment, $balance, $description, $bank;

    public $project_id, $whitdrawal_id;

    public function render()
    {
        $transactions = Transaction::orderBy('id', 'desc')->paginate(15);
        $projects = Sale::where('status', 'Proyecto')->orderBy('id', 'DESC')->get();
        $whitdrawals = Whitdrawal::orderBy('id', 'DESC')->get();
        return view('livewire.transactions-component', compact('transactions', 'projects', 'whitdrawals'));
    }

    public function store()
    {
        $this->validate([
            'date' => 'required',
            // 'chargue' => 'numeric',
            // 'payment' => 'numeric',
            // 'balance' => 'numeric',
        ], [
            'date.required' => 'Campo obligatorio',
            'chargue.numeric' => 'El campo debe ser númerico',
            'payment.numeric' => 'El campo debe ser númerico',
            'balance.numeric' => 'El campo debe ser númerico',
        ]);

        $transaction = Transaction::create([
            'date' => $this->date,
            'concept_ref' => $this->concept_ref,
            'chargue' => $this->chargue,
            'payment' => $this->payment,
            'balance' => $this->balance,
            'description' => $this->description,
            'bank' => $this->bank,
        ]);

        if ($this->project_id) {
            ProjectTransaction::create([
                'sale_id' => $this->project_id,
                'transaction_id' => $transaction->id
            ]);
        }

        if ($this->whitdrawal_id) {
            WithdrawalTransaction::create([
                'whitdrawal_id' => $this->whitdrawal_id,
                'transaction_id' => $transaction->id
            ]);
        }

        if ($transaction) {
            $this->emit('successNotification', 'Registro almacenado...');
        }
        $this->emit('dissmissCreateTransactionModal');
    }

    public function edit($transaction_id)
    {
        $this->clean();
        $this->transaction = Transaction::find($transaction_id);
        $this->date = $this->transaction->date;
        $this->concept_ref = $this->transaction->concept_ref;
        $this->chargue = $this->transaction->chargue;
        $this->payment = $this->transaction->payment;
        $this->balance = $this->transaction->balance;
        $this->description = $this->transaction->description;
        $this->bank = $this->transaction->bank;
        $projectTransaction = ProjectTransaction::where('transaction_id', $transaction_id)->first();
        if ($projectTransaction) {
            $this->project_id = $projectTransaction->sale_id;
        }
        $whitdrawalTransaction = WithdrawalTransaction::where('transaction_id', $transaction_id)->first();
        if ($whitdrawalTransaction) {
            $this->whitdrawal_id = $whitdrawalTransaction->whitdrawal_id;
        }
        $this->emit('showEditTransactionModal');
    }

    public function update()
    {
        $this->validate([
            'date' => 'required',
            // 'chargue' => 'numeric',
            // 'payment' => 'numeric',
            // 'balance' => 'numeric',
        ], [
            'date.required' => 'Campo obligatorio',
            'chargue.numeric' => 'El campo debe ser númerico',
            'payment.numeric' => 'El campo debe ser númerico',
            'balance.numeric' => 'El campo debe ser númerico',
        ]);
        $this->transaction->date = $this->date;
        $this->transaction->concept_ref = $this->concept_ref;
        $this->transaction->chargue = $this->chargue;
        $this->transaction->payment = $this->payment;
        $this->transaction->balance = $this->balance;
        $this->transaction->description = $this->description;
        $this->transaction->bank = $this->bank;
        $this->transaction->save();
        ProjectTransaction::where('transaction_id', $this->transaction->id)->delete();
        if ($this->project_id) {
            ProjectTransaction::create([
                'sale_id' => $this->project_id,
                'transaction_id' => $this->transaction->id
            ]);
        }
        WithdrawalTransaction::where('transaction_id', $this->transaction->id)->delete();
        if ($this->whitdrawal_id) {
            WithdrawalTransaction::create([
                'whitdrawal_id' => $this->whitdrawal_id,
                'transaction_id' => $this->transaction->id
            ]);
        }
        $this->emit('dissmissEditTransactionModal');
        $this->emit('successNotification', 'Registro actualizado...');
    }

    public function uploadFile()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx'
        ], [
            'file.required' => 'No se ha seleccionado un archivo',
            'file.mimes' => 'El formato del documento debe ser .xlsx'
        ]);

        $file_name = $this->file->store('files', 'public');
        $aux = explode('/', $file_name);

        $insert = DataMigrater::ExcelArray($aux[1], 'app/public/' . $aux[0]);
        foreach ($insert as $row) {
            $date = Date::excelToDateTimeObject($row['dia']);
            $date = \Carbon\Carbon::parse($date);
            Transaction::updateOrCreate([
                'date' => $date->format('Y-m-d'),
                'concept_ref' => $row['concepto_referencia'],
                'chargue' => $row['cargo'],
                'payment' => $row['abono'],
                'balance' => $row['saldo'],
                'description' => $row['observaciones'],
                'bank' => $row['banco']
            ]);
        }
        $this->emit('dissmisUploadFileModal');
        $this->emit('successNotification', 'Archivo procesado...');
        $this->clean();
    }

    public function destroy($transaction_id)
    {
        $this->transaction = Transaction::find($transaction_id);
        $this->transaction->delete();
        $this->emit('successNotification', 'Registro eliminado...');
    }

    public function downloadTemplate()
    {
        return \Storage::download('storage/app/template.xlsx');
    }

    public function clean()
    {
        $this->file = null;
        $this->project_id = null;
        $this->whitdrawal_id = null;
    }
}
