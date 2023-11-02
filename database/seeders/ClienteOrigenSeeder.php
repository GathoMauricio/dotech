<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\ClienteOrigen;

class ClienteOrigenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClienteOrigen::create([
            'author_id' => 15,
            'origen' => 'Recomendación'
        ]);
        ClienteOrigen::create([
            'author_id' => 15,
            'origen' => 'Google'
        ]);
        ClienteOrigen::create([
            'author_id' => 15,
            'origen' => 'Facebook'
        ]);
    }
}
