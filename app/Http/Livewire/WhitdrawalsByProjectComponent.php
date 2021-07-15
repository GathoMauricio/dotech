<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Whitdrawal;

class WhitdrawalsByProjectComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];
    public $search = "";
    public $self_component = 'whitdrawals_by_project';

    #propiedades de nueva solicitud de retiro
    public 
    $project_id,
    $whitdrawal_provider_id,
    $quantity,
    $invoive,
    $folio,
    $paid,
    $description;
    
    public function render()
    {
        $whitdrawals = Whitdrawal::where('sale_id',$this->project_id)->orderBy('id', 'desc')->paginate(5);
        return view('livewire.whitdrawals-by-project-component',['whitdrawals'=>$whitdrawals]);
    }
}
