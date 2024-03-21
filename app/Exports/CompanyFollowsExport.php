<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Company;

class CompanyFollowsExport implements FromView
{
    public function __construct()
    {
    }

    public function view(): View
    {
        $clientes = Company::orderBy('status')->orderBy('name')->get();
        return view('exports.company_follows', ['clientes' => $clientes]);
    }
}
