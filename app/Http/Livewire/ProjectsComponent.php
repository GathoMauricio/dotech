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

class ProjectsComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];
    public $search = "";
    public $self_component = 'projects';

    public
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

    public function render()
    {
        if (strlen($this->search) > 0) {
            //Check this
            $this->gotoPage(1);
            $sales = Sale::select(
                'sales.id AS ID',
                'companies.name AS COMPANIA',
                'sales.description AS DESCRIPCION',
                'sales.estimated AS MONTO',
                'sales.created_at AS FECHA'
            )
                ->join('companies', 'sales.company_id', '=', 'companies.id')
                ->where('sales.status', 'Proyecto')
                ->where(function ($q) {
                    $q->where('sales.id', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('companies.name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('sales.description', 'LIKE', '%' . $this->search . '%')
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
        $sale = Sale::findOrFail($id);
        $products = ProductSale::where('sale_id', $id)->get();
        $whitdrawals = Whitdrawal::where('sale_id', $id)->where('status', 'Aprobado')->get();
        $payments = SalePayment::where('sale_id', $id)->get();
        $documents = SaleDocument::where('sale_id', $id)->get();
        $binnacles = Binnacle::where('sale_id', $id)->get();

        $estimado = 0;
        foreach ($products as $product) {
            $estimado += $product->unity_price_sell * $product->quantity;
        }
        $sale->estimated = $estimado;
        $sale->iva = ($estimado + ($estimado * 0.16)) - $estimado;
        $sale->save();
        $totalRetiros = 0;
        foreach ($whitdrawals as $whitdrawal) {
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
}
