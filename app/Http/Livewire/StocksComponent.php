<?php

namespace App\Http\Livewire;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\StockProduct;

use Livewire\Component;

class StocksComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];
    public $search = "";
    public $self_component = 'stocks';
    
    public function render()
    {
        if (strlen($this->search) > 0) {
            $products = StockProduct::where(function($q){
                $q->where('product','LIKE','%'.$this->search.'%');
                $q->orWhere('description','LIKE','%'.$this->search.'%');
            })->orderBy('product')->paginate(15);
        }else{
            $products = StockProduct::orderBy('product')->paginate(15);
        }
        
        return view('livewire.stocks-component',['products' => $products]);
    }
}
