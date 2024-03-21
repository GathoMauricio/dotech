<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Company;
use App\User;
//use App\Exports\CompanyFollowsExport;

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
        $emails = [];
        foreach (User::get() as $user) {
            if ($user->hasRole('Administrador') || $user->hasRole('Gerente de venta') || $user->hasRole('Vendedor')) {
                $emails[] = $user->email;
            }
        }

        \Mail::send('email.company_follows', ['clientes' => $clientes], function ($mail) use ($emails) {
            $mail->subject('Últimos seguimientos');
            $mail->from('dotechapp@dotredes.com', env('APP_NAME'));
            $mail->to($emails);
        });

        \Log::debug('CompanyFollows...');
    }
}
