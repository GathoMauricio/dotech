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
    public
    $whitdrawal_id,
    $descripcion,
    $quantity,
    $emisor,
    $folio_fiscal;
    #Mostrar todo
    public $showAll = false;
    #Variable para mostrar transacciones
    public $currentTransactions;


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
                'whitdrawals.estado_cfdi AS ESTADO_CFDI',
                'whitdrawals.paid AS PAGADO'
                )
            ->join('sales', 'sales.id', '=', 'whitdrawals.sale_id')
            ->join('whitdrawal_providers','whitdrawal_providers.id','whitdrawals.whitdrawal_provider_id')
            ->join('companies','companies.id','=','sales.company_id')
            ->join('users','users.id','=','whitdrawals.author_id');
            if(!$this->showAll)
            {
                $whitdrawals=$whitdrawals->where('whitdrawals.status','Pendiente');
            }
            $whitdrawals = $whitdrawals->where(function($q){
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
            if($this->showAll)
            {
                $whitdrawals = Whitdrawal::orderBy('id','desc')->paginate(15);
            }else{
                $whitdrawals = Whitdrawal::where('status','Pendiente')->orderBy('id','desc')->paginate(15);
            }

        }
        return view('livewire.whitdrawals-component',['whitdrawals' => $whitdrawals]);
    }

    public function edit($id)
    {
        $whitdrawal = Whitdrawal::findOrFail($id);
        $this->whitdrawal_id = $whitdrawal->id;
        $this->descripcion = $whitdrawal->description;
        $this->quantity = $whitdrawal->quantity;
        $this->emisor = $whitdrawal->emisor;
        $this->folio_fiscal = $whitdrawal->folio;
        $this->emit('eidt_whitdrawal_modal');
    }

    public function update(){
        $this->validate([
            'descripcion' => 'required',
            'quantity' => 'required',
            'emisor' => 'required',
            'folio_fiscal' => 'required'
        ],[
            'descripcion.required' => 'Campo requerido',
            'quantity.required' => 'Campo requerido',
            'emisor.required' => 'Campo requerido',
            'folio_fiscal.required' => 'Campo requerido'
        ]);
        $whitdrawal = Whitdrawal::findOrFail($this->whitdrawal_id );
        $whitdrawal->description = $this->descripcion;
        $whitdrawal->quantity = $this->quantity;
        $whitdrawal->emisor = $this->emisor;
        $whitdrawal->folio = $this->folio_fiscal;

        if(!empty($whitdrawal->emisor) && !empty($whitdrawal->folio))
        {
            //validar CFDI
            $sat = validarCFDI($whitdrawal->emisor,env('DOTECH_RFC'),$whitdrawal->quantity,$whitdrawal->folio);
            $jsonSat = json_decode($sat);
            $estatus = explode(":",$jsonSat->CodigoEstatus);
            if($estatus[0] == 'N - 602')
            {
                $whitdrawal->estado_cfdi = $estatus[1];
            }else{
                $whitdrawal->es_cancelable = $jsonSat->EsCancelable;
                $whitdrawal->codigo_estatus = $jsonSat->CodigoEstatus;
                $whitdrawal->estado_cfdi = $jsonSat->Estado;
                //$whitdrawal->estatus_cancelacion = $jsonSat->EstatusCancelacion;
            }
            $whitdrawal->save();
        }

        $whitdrawal->save();
        $this->emit('dissmisEditWhitdrawalModal');
        $this->emit('successNotification','Retiro actualizado');
        $this->default();
    }

    public function validarFactura($id){
        $whitdrawal = Whitdrawal::findOrFail($id);

        if(empty($whitdrawal->emisor)){
            $whitdrawal->estado_cfdi = "Sin emisor";
            $whitdrawal->save();
            $this->emit('errorNotification','No se ha agregado el emisor de la factura.');
        }else{
            if(empty($whitdrawal->folio)){
                $this->emit('errorNotification','No se ha agregado el folio fiscal de la factura.');
            }else{
                //validar CFDI
                $sat = validarCFDI($whitdrawal->emisor,env('DOTECH_RFC'),$whitdrawal->quantity,$whitdrawal->folio);
                $jsonSat = json_decode($sat);

                $estatus = explode(":",$jsonSat->CodigoEstatus);
                if($estatus[0] == 'N - 601' || $estatus[0] == 'N - 602')
                {
                    $whitdrawal->estado_cfdi = $estatus[1];
                    $this->emit('errorNotification','CFDI Validado: '.$jsonSat->Estado);
                }else{
                    $whitdrawal->es_cancelable = $jsonSat->EsCancelable;
                    $whitdrawal->codigo_estatus = $jsonSat->CodigoEstatus;
                    $whitdrawal->estado_cfdi = $jsonSat->Estado;
                    //$whitdrawal->estatus_cancelacion = $jsonSat->EstatusCancelacion;
                    $this->emit('successNotification','CFDI Validado: '.$jsonSat->CodigoEstatus);
                }
                $whitdrawal->save();
            }
        }
        $this->default();
    }

    public function default() {
        $this->whitdrawal_id = null;
        $this->descripcion = null;
        $this->quantity = null;
        $this->emisor = null;
        $this->folio_fiscal = null;
    }

    public function showTransactions($whitdrawal_id){
        $this->currentTransactions = Whitdrawal::find($whitdrawal_id)->transactions;
        $this->emit('showTransaccionesModal');
    }
}
