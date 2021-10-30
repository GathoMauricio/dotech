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

    public $searchMonth = "";
    public $searchCriteria = "";
    public $searchStatus = "";

    public $password = "";
    public $password_confirmation = "";

    public function render()
    {
        /*
        if (strlen($this->searchCriteria) > 0) {
            $sales = Sale::where('company_id',auth('clients')->user()->id)
            ->where('created_at','LIKE','%'.$this->searchCriteria.'%')
            ->where('description','LIKE','%'.$this->searchCriteria.'%')
            ->orderBy('created_at','DESC')
            ->get();
        }else{
            $sales = Sale::where('company_id',auth('clients')->user()->id)
            ->where(function($q){
                $q->where('status','Pendiente');
                $q->orWhere('status','Proyecto');
                $q->orWhere('status','Finalizado');
            })
            ->orderBy('created_at','DESC')
            ->get();
        }
        */
        $sales = Sale::where('company_id',auth('clients')->user()->id)
            ->where('created_at','LIKE','%'.$this->searchMonth.'%')
            ->where('description','LIKE','%'.$this->searchCriteria.'%')
            ->where('status','LIKE','%'.$this->searchStatus.'%')
            ->where(function($q){
                $q->where('status','Pendiente');
                $q->orWhere('status','Proyecto');
                $q->orWhere('status','Finalizado');
            })
            ->orderBy('created_at','DESC')
            ->get();

        return view('livewire.client-component',['sales' => $sales]);
    }

    public function updatePassword(){
        $this->validate([
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ],[
            'password.required' => "El password es obligatorio",
            'password.min' => "Su password debe ser al menos de 6 caracteres",
            'password_confirmation.required_with' => "La confirmación de password es obligatoria",
            'password_confirmation.same' => "Su password y la confirmación no coinciden",
            'password_confirmation.min' => "La confirmación debe se al menos de 6 caracteres",
        ]);
        $company = \App\Company::find(auth('clients')->user()->id);
        $company->password = bcrypt($this->password);
        $company->save();
        $this->password = "";
        $this->password_confirmation = "";
        $this->emit('dismissPasswordModal');
    }
}
