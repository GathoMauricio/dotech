<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowGatho extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gatho:show';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show develop user Gatho ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = \App\User::findOrFail(15);
        \Log::info('Showing '.$user->name.' '.date('Y-m-d H:i:s'));
    }
}
