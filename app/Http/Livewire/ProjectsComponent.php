<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Sale;

class ProjectsComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];
    public $search = "";
    public $self_component = 'projects';

    public function render()
    {
        if (strlen($this->search) > 0) {
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
}
