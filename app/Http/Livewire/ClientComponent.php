<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Sale;
use App\Binnacle;

class ClientComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search = "";

    public function render()
    {
        if (strlen($this->search) > 0) {
            $sales = Sale::where('company_id',auth('clients')->user()->id)
            ->where('description','LIKE','%'.$this->search.'%')
            ->orderBy('created_at','DESC')
            ->paginate(10);
        }else{
            $sales = Sale::where('company_id',auth('clients')->user()->id)
            ->orderBy('created_at','DESC')
            ->paginate(10);
        }

        return view('livewire.client-component',['sales' => $sales]);
    }
}
