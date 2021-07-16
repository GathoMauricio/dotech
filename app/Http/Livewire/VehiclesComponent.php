<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Vehicle;

class VehiclesComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];
    public $search = "";
    public $self_component = 'vehicles';
    
    public function render()
    {
        if (strlen($this->search) > 0) {
            $vehicles = Vehicle::where(function($q){
                $q->where('brand','like',"%".$this->search."%");
                $q->orWhere('model','like',"%".$this->search."%");
                $q->orWhere('enrollment','like',"%".$this->search."%");
            })->orderBy('brand')->paginate(15);
        }else{
            $vehicles = Vehicle::orderBy('brand')->paginate(15);
        }
        return view('livewire.vehicles-component',['vehicles' => $vehicles]);
    }
}
