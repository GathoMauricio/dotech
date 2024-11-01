<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacacion;
use App\User;

class VacacionController extends Controller
{
    public function cambiarEstatus(Request $request)
    {
        $vacacion = Vacacion::find($request->vacacion_id);
        $vacacion->estatus = $request->estatus;
        if ($vacacion->save()) {
            return response()->json([
                'status' => 1,
                'message' => 'Estatus actualizado'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Error en la petición'
            ]);
        }
    }

    public function solicitarVacaciones(Request $request)
    {
        $vacacion = Vacacion::create([
            'user_id' => \Auth::user()->id,
            'estatus' => 'pendiente',
            'tipo' => $request->tipo,
            'dias' => $request->dias,
            'fecha_inicio' => $request->fecha_inicio,
            'motivo' => $request->motivo,
        ]);

        $users = User::where('rol_user_id', 1)->whereNotNull('fcm_token')->get();

        foreach ($users as $user) {
            \Mail::send('email.solicitud_vacaciones', ['vacacion' => $vacacion], function ($mail) use ($user) {
                $mail->subject('Solicitud vacaciones');
                $mail->from('dotechapp@dotredes.com', env('APP_NAME'));
                $mail->to(['rortuno@dotredes.com', 'mauricio2769@gmail.com']);
            });
            $msg = ' ha solicitado ' . $vacacion->tipo;
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name . ' ' . \Auth::user()->middle_name . ' ' . $msg,
                'route' => route('index_user')
            ]));
        }

        if ($vacacion) {
            return redirect()->back()->with('message', 'Solicitud agreagada');
        } else {
            return redirect()->back()->with('message', 'Error al procesar la petición');
        }
    }
}
