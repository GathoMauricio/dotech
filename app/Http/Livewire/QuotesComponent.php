<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Sale;
use App\ProductSale;
use App\Company;
use App\CompanyDepartment;

class QuotesComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'destroy' => 'destroy',
        'editQuoteProduct' => 'editQuoteProduct',
        'destroyProductQuote' => 'destroyProductQuote'
    ];
    public $search = "";
    public $self_component = 'quotes';

    #Propiedades auxiliares para mostrar información
    public
        $currentQuote = null,
        $companies = null,
        $departments = null,
        $products = null;

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
        $currency,
        $investment;
    #Propiedades para ,anipular un producto a una cotización
    public
        $id_product,
        $productDescription,
        $productQuantity,
        $productMeasure,
        $productDiscount,
        $productUnityPriceSell,

        $subtotal,
        $iva,
        $total;

    public function render()
    {
        if (strlen($this->search) > 0) {
            $quotes = Sale::select(
                'sales.id AS ID',
                'sales.folio_cotizacion AS FOLIO',
                'companies.name AS COMPANIA',
                'sales.description AS DESCRIPCION',
                'sales.currency AS DIVISA',
                'sales.estimated AS MONTO',
                'sales.investment AS INVERSION',
                'company_department.email AS EMAIL',
                'sales.created_at AS FECHA'
            )
                ->join('companies', 'sales.company_id', '=', 'companies.id')
                ->join('company_department', 'company_department.id', '=', 'sales.department_id')
                ->where('sales.status', 'Pendiente')
                ->where(function ($q) {
                    $q->where('sales.id', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('companies.name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('sales.description', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('sales.currency', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('sales.estimated', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('sales.folio_cotizacion', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('sales.created_at', 'LIKE', '%' . $this->search . '%');
                });
            if (\Auth::user()->hasRole('Vendedor')) {
                $quotes = $quotes->where('author_id', \Auth::user()->id);
            }

            $quotes = $quotes->orderBy('sales.id', 'DESC')
                ->paginate(15);
        } else {
            $quotes = Sale::where('status', 'Pendiente')->orderBy('id', 'desc');
            if (\Auth::user()->hasRole('Vendedor')) {
                $quotes = $quotes->where('author_id', \Auth::user()->id);
            }

            $quotes = $quotes->orderBy('sales.id', 'DESC')
                ->paginate(15);
        }
        foreach ($quotes as $q) {
            $products = ProductSale::where('sale_id', $q->id)->get();


            foreach ($products as $p) {
                $p->total_sell = $p->unity_price_sell * $p->quantity;
                $p->total_sell = ($p->total_sell - ($p->total_sell / 100 * $p->discount));
                $p->save();
            }

            #suma el total de los productos
            $subtotal = $products->sum('total_sell');
            #calcula el iva
            $iva = ($subtotal * .16);
            #calcula el total de la cotización
            $total = $subtotal + $iva;
            #Actualza costo total de la cotización
            $q->estimated = $total;
            $q->save();
        }
        $this->companies = Company::orderBy('name')->get();
        return view('livewire.quotes-component', ['quotes' => $quotes]);
    }

    public function showFullModalProducts($id)
    {
        $this->currentQuote = Sale::find($id);
        $this->products = ProductSale::where('sale_id', $this->currentQuote->id)->get();
        #suma el total de los productos
        $this->subtotal = $this->products->sum('total_sell');
        #calcula el iva
        $this->iva = ($this->subtotal * .16);
        #calcula el total de la cotización
        $this->total = $this->subtotal + $this->iva;
        #muestra el modal contoda la informacion
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
            //'investment' => 'required|numeric|min:0',
            'shipping' => 'required',
            'payment_type' => 'required',
            'credit' => 'required',
            'currency' => 'required',
        ], [
            'company_id.required' => 'Este campo es obligatorio.',
            'department_id.required' => 'Este campo es obligatorio.',
            'description.required' => 'Este campo es obligatorio.',
            //'observation' => '',
            'delivery_days.required' => 'Este campo es obligatorio.',
            'delivery_days.numeric' => 'Este campo debe ser un número.',
            'delivery_days.min' => 'El número debe ser por lo menos 0.',
            'investment.required' => 'Este campo es obligatorio.',
            'investment.numeric' => 'Este campo debe ser un número.',
            'investment.min' => 'El número debe ser por lo menos 0.',
            'shipping.required' => 'Este campo es obligatorio.',
            'payment_type.required' => 'Este campo es obligatorio.',
            'credit.required' => 'Este campo es obligatorio.',
            'currency.required' => 'Este campo es obligatorio.',
        ]);
        #Crear registro
        $last_cot = Sale::orderBy('id', 'DESC')->first();
        $part = explode('-', $last_cot->folio_cotizacion);

        $this->currentQuote = Sale::create([
            'status' => 'Pendiente',
            'company_id' => $this->company_id,
            'department_id' => $this->department_id,
            'description' => $this->description,
            'observation' => $this->observation,
            'delivery_days' => $this->delivery_days,
            'investment' => $this->investment,
            'shipping' => $this->shipping,
            'payment_type' => $this->payment_type,
            'credit' => $this->credit,
            'currency' => $this->currency,
            'folio_cotizacion' => 'COT-' . ($part[1] + 1),
        ]);
        #Notificar
        $this->emit('successNotification', 'Cotización ' . $this->currentQuote->id . ' creada.');
        #Ocultar contenedor del formulario
        $this->dissmisFullModal();
        #Igualar el id de la nueva cotización con la propiedad pública del componente para agregar productos
        $this->quote_id = $this->currentQuote->id;
        #mostrar formulario para agregar productos
        $this->products = ProductSale::where('sale_id', $this->currentQuote->id)->get();
        $this->emit('showFullModalProducts');
    }

    public function storeProduct()
    {
        $this->validate([
            'productDescription' => 'required',
            'productQuantity' => 'required|numeric',
            //'productDiscount' => 'required|numeric',
            'productUnityPriceSell' => 'required',
        ], [
            'productDescription.required' => 'Este campo es requerido.',
            'productQuantity.required' => 'Este campo es requerido.',
            'productQuantity.numeric' => 'Este campo debe ser un número valido.',
            //'productDiscount.required' => 'Este campo es requerido.',
            //'productDiscount.numeric' => 'Este campo debe ser un número valido.',
            'productUnityPriceSell.required' => 'Este campo es requerido.',
        ]);
        $total = ($this->productUnityPriceSell * $this->productQuantity);
        /*

        if($this->productDiscount > 0)
        {
            if(strlen($this->productDiscount) <= 1)
            $total = $total - ($total * ($this->productDiscount / 100));
            else
            $total = ($this->productUnityPriceSell * $this->productQuantity) / number_format('1.'.$this->productDiscount,2);
        }
        */
        $total = $total - ($total * ($this->productDiscount / 100));
        $product = ProductSale::create([
            'sale_id' => $this->currentQuote->id,
            'description' => $this->productDescription,
            'quantity' => $this->productQuantity,
            'measure' => $this->productMeasure,
            'discount' => $this->productDiscount,
            'unity_price_sell' => $this->productUnityPriceSell,
            'total_sell' => $total
        ]);

        $this->products = ProductSale::where('sale_id', $this->currentQuote->id)->get();
        #suma el total de los productos
        $this->subtotal = $this->products->sum('total_sell');
        #calcula el iva
        $this->iva = ($this->subtotal * .16);
        #calcula el total de la cotización
        $this->total = $this->subtotal + $this->iva;
        #Actualza costo total de la cotización
        $quote = Sale::find($this->currentQuote->id);
        $quote->estimated = $this->total;
        $quote->save();
        $this->emit('successNotification', 'El producto ' . $product->description . ' ha sido creado.');
        $this->emit('dissmisCreateProductQuote');

        $this->productDescription = null;
        $this->productQuantity = null;
        $this->productMeasure = null;
        $this->productDiscount = null;
        $this->productUnityPriceSell = null;
    }

    public function editQuoteProduct($id)
    {
        $product = ProductSale::find($id);
        $this->id_product = $product->id;
        $this->productDescription = $product->description;
        $this->productQuantity = $product->quantity;
        $this->productMeasure = $product->measure;
        $this->productDiscount = $product->discount;
        $this->productUnityPriceSell = $product->unity_price_sell;
        $this->emit('editQuoteProductModal');
    }

    public function updateProduct()
    {
        $this->validate([
            'productDescription' => 'required',
            'productQuantity' => 'required|numeric',
            //'productDiscount' => 'required|numeric',
            'productUnityPriceSell' => 'required',
        ], [
            'productDescription.required' => 'Este campo es requerido.',
            'productQuantity.required' => 'Este campo es requerido.',
            'productQuantity.numeric' => 'Este campo debe ser un número valido.',
            //'productDiscount.required' => 'Este campo es requerido.',
            //'productDiscount.numeric' => 'Este campo debe ser un número valido.',
            'productUnityPriceSell.required' => 'Este campo es requerido.',
        ]);
        $product = ProductSale::find($this->id_product);
        $total = ($this->productUnityPriceSell * $this->productQuantity);
        $total = $total - ($total * ($this->productDiscount / 100));
        #actualizar registro
        $product->description = $this->productDescription;
        $product->quantity = $this->productQuantity;
        $product->measure = $this->productMeasure;
        $product->discount = $this->productDiscount;
        $product->unity_price_sell = $this->productUnityPriceSell;
        $product->total_sell = $total;
        $product->save();

        #recargar productos
        $this->products = ProductSale::where('sale_id', $this->currentQuote->id)->get();
        #suma el total de los productos
        $this->subtotal = $this->products->sum('total_sell');
        #calcula el iva
        $this->iva = ($this->subtotal * .16);
        #calcula el total de la cotización
        $this->total = $this->subtotal + $this->iva;
        #Actualza costo total de la cotización
        $quote = Sale::find($this->currentQuote->id);
        $quote->estimated = $this->total;
        $quote->save();

        $this->emit('successNotification', 'El producto ' . $product->description . ' ha sido creado.');
        $this->emit('dissmisEditProductQuote');
    }

    public function dissmisFullModal()
    {
        $this->emit('dissmisFullModal');
    }

    public function changeCompany()
    {
        if (strlen($this->company_id) > 0) {
            $this->departments = CompanyDepartment::where('company_id', $this->company_id)->get();
        } else {
            $this->departments = null;
        }
    }

    public function destroyProductQuote($id)
    {
        $item = ProductSale::find($id);
        $item->delete();
        $this->products = ProductSale::where('sale_id', $this->currentQuote->id)->get();
        #suma el total de los productos
        $this->subtotal = $this->products->sum('total_sell');
        #calcula el iva
        $this->iva = ($this->subtotal * .16);
        #calcula el total de la cotización
        $this->total = $this->subtotal + $this->iva;
        #Actualza costo total de la cotización
        $quote = Sale::find($this->currentQuote->id);
        $quote->estimated = $this->total;
        $quote->save();
        $this->emit('successNotification', "Registro eliminado.");
    }
}
