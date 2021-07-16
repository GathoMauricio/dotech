<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Sale;
use App\Company;
use App\CompanyDepartment;

class QuotesComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];
    public $search = "";
    public $self_component = 'quotes';

    #Propiedades auxiliares para mostrar información
    public 
    $currentQuote = null,
    $companies = null,
    $departments = null;
    
    #Propiedades para validar y crear una cotización
    public 
        $quote_id,
        $company_id,
        $department_id,
        $description,
        $observation,
        $delivery_days,
        $shipping,
        $payment_type,
        $credit,
        $currency;
    
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
        $this->companies = Company::orderBy('name')->get();
        return view('livewire.quotes-component',['quotes' => $quotes]);
    }

    public function showFullModalProducts($id)
    {
        $this->currentQuote = Sale::find($id);
        $this->emit('showFullModalProducts');
    }

    public function store()
    {
        #Validar campos
        $this->validate([
            'company_id' => 'required',
            'department_id' => 'required',
            'description' => 'required',
            //'observation' => '',
            'delivery_days' => 'required|numeric|min:0',
            'shipping' => 'required',
            'payment_type' => 'required',
            'credit' => 'required',
            'currency' => 'required',
        ],[
            'company_id.required' => 'Este campo es obligatorio.',
            'department_id.required' => 'Este campo es obligatorio.',
            'description.required' => 'Este campo es obligatorio.',
            //'observation' => '',
            'delivery_days.required' => 'Este campo es obligatorio.',
            'delivery_days.numeric' => 'Este campo debe ser un número.',
            'delivery_days.min' => 'El número debe ser por lo menos 0.',
            'shipping.required' => 'Este campo es obligatorio.',
            'payment_type.required' => 'Este campo es obligatorio.',
            'credit.required' => 'Este campo es obligatorio.',
            'currency.required' => 'Este campo es obligatorio.',
        ]);
        #Crear registro
        $this->currentQuote = Sale::create([
            'status' => 'Pendiente',
            'company_id' => $this->company_id,
            'department_id' => $this->department_id,
            'description' => $this->description,
            'observation' => $this->observation,
            'delivery_days' => $this->delivery_days,
            'shipping' => $this->shipping,
            'payment_type' => $this->payment_type,
            'credit' => $this->credit,
            'currency' => $this->currency,
        ]);
        #Notificar
        $this->emit('successNotification','Cotización '.$this->currentQuote->id.' creada.');
        #Ocultar contenedor del formulario
        $this->dissmisFullModal();
        #Igualar el id de la nueva cotización con la propiedad pública del componente para agregar productos
        $this->quote_id = $this->currentQuote->id;
        #mostrar formulario para agregar productos

        //$this->emit('showFullModalProducts');
    }

    public function dissmisFullModal()
    {
        $this->emit('dissmisFullModal');
    }

    public function changeCompany()
    {
        if(strlen($this->company_id) > 0)
        {
            $this->departments = CompanyDepartment::where('company_id',$this->company_id)->get(); 
        }else{
            $this->departments = null;
        }    
    }
}
