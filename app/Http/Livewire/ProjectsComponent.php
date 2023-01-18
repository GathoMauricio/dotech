<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Sale;
use App\ProductSale;
use App\Whitdrawal;
use App\SalePayment;
use App\SaleDocument;
use App\Binnacle;
use App\ProjectTransaction;

class ProjectsComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy' ,'eliminarRetiro' => 'eliminarRetiro', 'eliminarDocumento' => 'eliminarDocumento'];
    public $search = "";
    public $self_component = 'projects';

    public
        $sale_id = null,
        $sale = null,
        $products = null,
        $whitdrawals = null,
        $payments = null,
        $documents = null,
        $binnacles = null,

        $costoProyecto = null,
        $utilidad = null,
        $totalRetiros = null,
        $comision = null,

        $totalSell = null,
        $grossProfit = null,
        $grossNoIvaProfit = null,
        $commision = null,
        $grossNoIvaProfitNoCommision = null;

    #Propiedades para manipular retiros retiros
    public
        $WDwhitdrawal_provider_id,
        $WDquantity,
        $WDinvoive,
        $WDemisor,
        $WDfolio,
        $WDpaid,
        $WDdescription;

    #Esta variable muestar las transacciones de algún proyecto;
    public $currentTransactions = null;


    public function render()
    {
        if (strlen($this->search) > 0) {
            //Check this
            $this->gotoPage(1);
            $sales = Sale::select(
                'sales.id AS ID',
                'companies.name AS COMPANIA',
                'sales.description AS DESCRIPCION',
                'sales.currency AS DIVISA',
                'sales.estimated AS MONTO',
                'sales.created_at AS FECHA',
                'sales.project_at AS FECHA2'
            )
                ->join('companies', 'sales.company_id', '=', 'companies.id')
                ->where('sales.status', 'Proyecto')
                ->where(function ($q) {
                    $q->where('sales.id', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('companies.name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('sales.description', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('sales.currency', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('sales.estimated', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('sales.created_at', 'LIKE', '%' . $this->search . '%');
                })
                ->orderBy('sales.id', 'DESC')
                ->paginate(15);
        } else {
            $sales = Sale::where('status', 'Proyecto')->orderBy('id', 'desc')->paginate(15);
        }
        return view('livewire.projects-component', ['sales' => $sales]);
    }

    public function show($id)
    {
        \Log::debug($id);
        $this->sale_id = $id;
        $sale = Sale::findOrFail($this->sale_id);
        $products = ProductSale::where('sale_id', $id)->get();
        $whitdrawals = Whitdrawal::where('sale_id', $id)->where(function($q){
            $q->where('status', 'Aprobado');
            $q->orWhere('status', 'Pendiente');
        })->orderBy('id', 'DESC')->get();
        $payments = SalePayment::where('sale_id', $id)->get();
        $documents = SaleDocument::where('sale_id', $id)->get();
        $binnacles = Binnacle::where('sale_id', $id)->get();
        #Aqui se actualiza el costo del proyecto al mostrar la info completa del mismo
        $estimado = 0;
        foreach ($products as $product) {
            $product->total_sell = $product->unity_price_sell * $product->quantity;
            $estimado += $product->unity_price_sell * $product->quantity;
        }
        $sale->estimated = $estimado;
        $sale->iva = ($estimado + ($estimado * 0.16)) - $estimado;
        $sale->save();
        #end
        $totalRetiros = 0;
        foreach ($whitdrawals as $whitdrawal) {
            if($whitdrawal->status == 'Aprobado')
            $totalRetiros += floatval($whitdrawal->quantity);
        }

        $costoProyecto = number_format($sale->estimated + ($sale->estimated * 0.16), 2);

        $utilidad = number_format($sale->estimated + ($sale->estimated * 0.16) - $totalRetiros, 2);

        //$comision = (($sale->estimated + ($sale->estimated * 0.16) - $totalRetiros / 1.16) * $sale->commision_percent) / 100 ;
        //$comision =  number_format($comision - ($comision * 0.16),2);

        $comision = ($sale->estimated + ($sale->estimated * 0.16) - $totalRetiros) / 1.16;
        $comision = number_format($comision * ($sale->commision_percent / 100), 2);

        /*
        costoProyecto
        1044/1.16=900
        900*.13=117
        */

        $sale->utility = $utilidad;
        $sale->save();
        $totalSell = 0;
        foreach ($whitdrawals as $whitdrawal) {
            if ($whitdrawal->status == 'Aprobado') {
                $totalSell += $whitdrawal->quantity;
            }
        }
        $grossProfit = 0;
        $grossNoIvaProfit = 0;
        $commision = 0;
        $grossNoIvaProfitNoCommision = 0;
        $this->sale = $sale;
        $this->products = $products;
        $this->whitdrawals = $whitdrawals;
        $this->payments = $payments;
        $this->documents = $documents;
        $this->binnacles = $binnacles;

        $this->costoProyecto = $costoProyecto;
        $this->utilidad = $utilidad;
        $this->totalRetiros = $totalRetiros;
        $this->comision = $comision;

        $this->totalSell = $totalSell;
        $this->grossProfit = $grossProfit;
        $this->grossNoIvaProfit = $grossNoIvaProfit;
        $this->commision = $commision;
        $this->grossNoIvaProfitNoCommision = $grossNoIvaProfitNoCommision;

        $this->emit('showFullModal');
    }

    public function storeWhitdrawal()
    {
        $this->validate(
            [
                'WDwhitdrawal_provider_id' => 'required',
                'WDquantity' => 'required|numeric',
                'WDinvoive' => 'required',
                'WDpaid' => 'required',
                'WDdescription' => 'required'
            ],
            [
                'WDwhitdrawal_provider_id.required' => 'Este campo es obligatorio',
                'WDquantity.required' => 'Este campo es obligatorio',
                'WDquantity.numeric' => 'Este campo debe ser un número válido',
                'WDinvoive.required' => 'Este campo es obligatorio',
                'WDpaid.required' => 'Este campo es obligatorio',
                'WDdescription.required' => 'Este campo es obligatorio'
            ]
        );
        $whitdrawal = Whitdrawal::create([
            'sale_id' => $this->sale_id,
            'status' => 'Pendiente',
            'whitdrawal_provider_id' => $this->WDwhitdrawal_provider_id,
            'quantity' => $this->WDquantity,
            'invoive' => $this->WDinvoive,
            'folio' => $this->WDfolio,
            'emisor' => $this->WDemisor,
            'paid' => $this->WDpaid,
            'description' => $this->WDdescription
        ]);

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

            //Actualizar RFC del provedor
            $provedor = \App\WhitdrawalProvider::find($whitdrawal->whitdrawal_provider_id);
            $provedor->rfc = $whitdrawal->emisor;
            $provedor->save();
        }

        #Regarga los retiros
        $this->whitdrawals = Whitdrawal::where('sale_id', $this->sale_id)->where(function($q){
            $q->where('status', 'Aprobado');
            $q->orWhere('status', 'Pendiente');
        })->orderBy('id', 'DESC')->get();
        $this->emit('dissmisCreateWhitdrawal');
        $this->emit('successNotification','Retiro '.$whitdrawal->description.' agregado.');
        $this->WDwhitdrawal_provider_id = null;
        $this->WDquantity = null;
        $this->WDinvoive = null;
        $this->WDfolio = null;
        $this->WDEmisor = null;
        $this->WDpaid = null;
        $this->WDdescription = null;
    }

    public function dissmisProject()
    {
        $this->emit('dissmisFullModal');
        $this->sale = null;
        $this->products = null;
        $this->whitdrawals = null;
        $this->payments = null;
        $this->documents = null;
        $this->binnacles = null;

        $this->costoProyecto = null;
        $this->utilidad = null;
        $this->totalRetiros = null;
        $this->comision = null;

        $this->totalSell = null;
        $this->grossProfit = null;
        $this->grossNoIvaProfit = null;
        $this->commision = null;
        $this->grossNoIvaProfitNoCommision = null;
    }

    public function eliminarRetiro($id)
    {
        $retiro = Whitdrawal::find($id);
        $retiro->delete();
        $this->whitdrawals = Whitdrawal::where('sale_id', $this->sale_id)->where(function($q){
            $q->where('status', 'Aprobado');
            $q->orWhere('status', 'Pendiente');
        })->orderBy('id', 'DESC')->get();
        $this->emit('successNotification','Registro eliminado');
    }

    public function eliminarDocumento($id)
    {
        $documento = SaleDocument::find($id);
        $documento->delete();
        $this->documents = SaleDocument::where('sale_id', $this->sale_id)->get();
        $this->emit('successNotification','Registro eliminado');
    }

    public function loadRfc(){
        $proveedor = \App\WhitdrawalProvider::find($this->WDwhitdrawal_provider_id);
        if($proveedor)$this->WDemisor = $proveedor->rfc;
    }

    public function showTransactions($sale_id){
        $this->currentTransactions = Sale::find($sale_id)->transactions;
        $this->emit('showTransaccionesModal');
    }
}
