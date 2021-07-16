<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Sale;

class QuotesComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];
    public $search = "";
    public $self_component = 'quotes';
    
    public function render()
    {
        if (strlen($this->search) > 0) {
            $quotes = Sale::select(
                    'sales.id AS ID',
                    'companies.name AS COMPANIA',
                    'sales.description AS DESCRIPCION',
                    'sales.estimated AS MONTO',
                    'company_department.email AS EMAIL',
                    'sales.created_at AS FECHA'
                    )
                    ->join('companies', 'sales.company_id', '=', 'companies.id')
                    ->join('company_department','company_department.id','=','sales.department_id')
                    ->where('sales.status','Pendiente')
                    ->where(function($q){
                        $q->where('sales.id','LIKE','%'.$this->search.'%')
                        ->orWhere('companies.name','LIKE','%'.$this->search.'%')
                        ->orWhere('sales.description','LIKE','%'.$this->search.'%')
                        ->orWhere('sales.estimated','LIKE','%'.$this->search.'%')
                        ->orWhere('sales.created_at','LIKE','%'.$this->search.'%')
                        ;
                    })
                    ->orderBy('sales.id','DESC')
                    ->paginate(15);
        }else{
            $quotes = Sale::where('status','Pendiente')->orderBy('id','desc')->paginate(15);
        }
        return view('livewire.quotes-component',['quotes' => $quotes]);
    }
}
