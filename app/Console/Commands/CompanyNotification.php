<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Company;
use PhpParser\Node\Stmt\TryCatch;

class CompanyNotification extends Command
{

    protected $signature = 'company:notification';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        ini_set('max_execution_time', '3600');
        foreach (Company::get() as $cliente) {
            try {
                \Mail::send('email.company_notification', ['cliente' => $cliente], function ($mail) use ($cliente) {
                    $mail->subject('Catálogo DOTECH');
                    $mail->from('dotechapp@dotredes.com', env('APP_NAME'));
                    $mail->to([$cliente->email]);
                    $mail->attach(public_path('catalogo/dotech_catalogo.pdf'));
                });
                \Log::debug("Enviado: " . $cliente->email);
            } catch (\Exception $e) {
                \Log::debug($e->getMessage());
                \Log::debug("Error al enviar email: " . $cliente->email);
            }
            sleep(10);
        }


        \Log::debug("CompanyNotification success...");
    }
}
