<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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

        \Mail::send('email.company_notification', [], function ($mail) {
            $mail->subject('Catálogo DOTECH');
            $mail->from('dotechapp@dotredes.com', env('APP_NAME'));
            $mail->to(['mauricio2769@gmail.com']);
            $mail->attach(public_path('catalogo/dotech_catalogo.pdf'));
        });

        \Log::debug("CompanyNotification...");
    }
}
