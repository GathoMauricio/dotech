<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Whitdrawal;

class WhitdrawalsComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];
    public $search = "";
    public $self_component = 'whitdrawals';

    public function render()
    {
        
        if (strlen($this->search) > 0) {
            $whitdrawals = Whitdrawal::
            select(
                'whitdrawals.id as ID',
                'sales.id AS ID_VENTA',
                'whitdrawal_providers.name AS PROVEDOR',
                'companies.name as NOMBRE_COMPANIA',
                'sales.description AS PROYECTO',
                'whitdrawals.description AS DESCRIPCION',
                'users.name AS NOMBRE_AUTOR',
                'users.middle_name AS PATERNO_AUTOR',
                'users.last_name AS MATERNO_AUTOR',
                'whitdrawals.quantity AS CANTIDAD',
                'whitdrawals.invoive AS FACTURA',
                'whitdrawals.created_at AS FECHA',
                'whitdrawals.document AS DOCUMENTO',
                'whitdrawals.folio AS FOLIO',
                'whitdrawals.paid AS PAGADO'
                )
            ->join('sales', 'sales.id', '=', 'whitdrawals.sale_id')
            ->join('whitdrawal_providers','whitdrawal_providers.id','whitdrawals.whitdrawal_provider_id')
            ->join('companies','companies.id','=','sales.company_id')
            ->join('users','users.id','=','whitdrawals.author_id')

            ->where('whitdrawals.status','Pendiente')
            ->where(function($q){
                $q->where('companies.name','LIKE','%'.$this->search.'%')
                ->orWhere('whitdrawal_providers.name','LIKE','%'.$this->search.'%')
                ->orWhere('sales.description','LIKE','%'.$this->search.'%')
                ->orWhere('whitdrawals.description','LIKE','%'.$this->search.'%')
                ->orWhere('users.name','LIKE','%'.$this->search.'%')
                ->orWhere('users.middle_name','LIKE','%'.$this->search.'%')
                ->orWhere('users.last_name','LIKE','%'.$this->search.'%')
                ->orWhere('whitdrawals.quantity','LIKE','%'.$this->search.'%')
                ->orWhere('whitdrawals.folio','LIKE','%'.$this->search.'%')
                ->orWhere('whitdrawals.created_at','LIKE','%'.$this->search.'%')
                ;
            })
            ->orderBy('whitdrawals.id','DESC')
            ->paginate(15);
        }else
        {
            $whitdrawals = Whitdrawal::where('status','Pendiente')->orderBy('id','desc')->paginate(15);
        }
        return view('livewire.whitdrawals-component',['whitdrawals' => $whitdrawals]); 
    }
}
