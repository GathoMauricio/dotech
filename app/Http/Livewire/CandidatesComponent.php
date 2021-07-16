<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Candidate;

class CandidatesComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];
    public $search = "";
    public $self_component = 'candidates';
    
    public function render()
    {
        
        if (strlen($this->search) > 0) {
            $users = Candidate::where('rol_user_id',4)->where(function($q){
                $q->orWhere('name','LIKE','%'.$this->search.'%');
                $q->orWhere('middle_name','LIKE','%'.$this->search.'%');
                $q->orWhere('last_name','LIKE','%'.$this->search.'%');
            })->paginate(15);
        }else{
            $users = Candidate::where('rol_user_id',4)->paginate(15);
        }
        return view('livewire.candidates-component',['users' => $users]);
    }
}
