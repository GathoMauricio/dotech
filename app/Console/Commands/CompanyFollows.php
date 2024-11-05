<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Company;
use App\User;
use App\Exports\CompanyFollowsExport;
use Maatwebsite\Excel\Facades\Excel;

class CompanyFollows extends Command
{
    protected $signature = 'company:follows';

    protected $description = 'Obtener los últimos seguimientos de cada prospecto o cliente y calcular los q tengan 30 días o más días para generar un reporte de estos y darle seguimiento';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $clientes = Company::orderBy('status')->orderBy('name')->get();
        $emails = ['roberto.lopez@dotredes.com', 'rortuno@dotredes.com', 'ventas2@dotredes.com', 'mauricio2769@gmail.com'];
        Excel::store(new CompanyFollowsExport(), 'seguimientos/reporte.xlsx', 'public');

        \Mail::send('email.company_follows', ['clientes' => $clientes], function ($mail) use ($emails) {
            $mail->subject('Últimos seguimientos');
            $mail->from('dotechapp@dotredes.com', env('APP_NAME'));
            $mail->to($emails);
            $mail->attach(storage_path('app/public/seguimientos/reporte.xlsx'));
        });
    }
}
