<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Binnacle;

class BinnaclesComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];
    public $search = "";
    public $self_component = 'binnacles';

    public function render()
    {
        if (strlen($this->search) > 0) {
            $binnacles = Binnacle::where('description','LIKE','%'.$this->search.'%')->paginate(15);
        }else{
            $binnacles = Binnacle::orderBy('created_at','DESC')->paginate(15);
        }
        return view('livewire.binnacles-component',['binnacles'=>$binnacles]);
    }
}
