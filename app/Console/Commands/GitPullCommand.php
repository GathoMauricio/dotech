<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GitPullCommand extends Command
{
    protected $signature = 'git:pull';
    protected $description = 'Ejecuta un git pull en el servidor';

    public function handle()
    {
        $output = [];
        $resultCode = 0;

        // Ejecutar el script .sh
        exec('/opt/lampp/htdocs/dotech/git-pull.sh', $output, $resultCode);

        // Mostrar el resultado en la terminal
        $this->info("Salida:");
        foreach ($output as $line) {
            $this->line($line);
        }

        return $resultCode;
    }
}
