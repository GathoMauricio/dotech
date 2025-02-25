<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientControer extends Controller
{
    public function simulateHeavyQuery(Request $request)
    {
        // Simular un tiempo de espera para que parezca una consulta pesada
        sleep(rand(2, 5)); // Espera entre 2 y 5 segundos

        // Registrar la "consulta" en los logs para mayor realismo
        \Log::info('Db de datos para el usuario: ' . $request->user());

        // Crear una respuesta ficticia
        $fakeData = [
            'status' => 'success',
            'message' => 'Operación completada.',
            'data' => [
                'affected_rows' => rand(0, 10),
                'execution_time' => rand(200, 1500) . 'ms'
            ]
        ];

        return response()->json($fakeData);
    }
}
