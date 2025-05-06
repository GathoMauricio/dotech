<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mailing;
use App\MailingAdjunto;
use App\MailingLista;
use App\MailingListaPivot;

class MailingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mailing = Mailing::find($this->id);
        $emails = [];
        foreach ($mailing->listas_pivot as $pivot_lista) {
            //obtener clientes
            foreach ($pivot_lista->lista->clientes_pivot as $pivot_cliente) {
                //no repetir clientes por si existe el mismo en diferentes listas
                if (!in_array($pivot_cliente->cliente->email, $emails)) {
                    $emails[] = $pivot_cliente->cliente->email;
                }
            }
            for ($i = 0; $i < count($emails); $i++) {
                //Se le envia a cada cliente uno por uno
                $to = $emails[$i];
                try {
                    \Mail::send('email.mailing', ['to' => $to, 'mailing' => $mailing], function ($mail) use ($mailing, $to) {
                        $mail->subject($mailing->subject);
                        $mail->from($mailing->from, env('APP_NAME'));
                        $mail->to([$to]);
                        foreach ($mailing->adjuntos as $adjunto) {
                            $mail->attach(public_path('storage/public/mailing/' . $mailing->id . '/' . $adjunto->ruta));
                        }
                    });
                } catch (\Exception $e) {
                    //\Log::debug("Error al enviar email: " . $e);
                }
            }
        }
    }
}
