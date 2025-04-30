<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mailing;
use App\MailingAdjunto;
use App\MailingLista;
use App\MailingListaPivot;
use App\Jobs\MailingJob;
use App\ClienteListaPivot;
use App\Company;

class MailingController extends Controller
{
    public function index()
    {
        $mailings = Mailing::orderBy('id', 'DESC')->get();
        return view('mailing.index', compact('mailings'));
    }

    public function create()
    {
        return view('mailing.create');
    }

    public function store(Request $request)
    {
        $mailing = Mailing::create($request->all());
        if ($mailing) {
            if ($request->file('adjuntos')) {
                for ($i = 0; $i < count($request->file('adjuntos')); $i++) {
                    $archivo = $request->file('adjuntos')[$i];
                    $ruta = $archivo->store('public/mailing/' . $mailing->id);
                    $ruta = explode('/', $ruta)[3];
                    MailingAdjunto::create([
                        'mailing_id' => $mailing->id,
                        'ruta' => $ruta,
                    ]);
                }
            }
            return redirect()->route('mailing')->with('message', 'Registro insertado.');
        }
    }

    public function show($id)
    {
        $mailing = Mailing::find($id);
        $listas = MailingLista::get();
        return view('mailing.show', compact('mailing', 'listas'));
    }

    public function edit($id)
    {
        $mailing = Mailing::find($id);
        return view('mailing.edit', compact('mailing'));
    }

    public function update(Request $request, $id)
    {
        $mailing = Mailing::find($id);

        if ($mailing->update($request->all())) {
            return redirect()->back()->with('message', 'Registro actualizado.');
        }
    }

    public function updateListas(Request $request, $id)
    {
        MailingListaPivot::where('mailing_id', $id)->delete();
        if ($request->listas) {
            for ($i = 0; $i < count($request->listas); $i++) {
                MailingListaPivot::create([
                    'mailing_id' => $id,
                    'lista_id' => $request->listas[$i],
                ]);
            }
        }
        return redirect()->back()->with('message', 'Registro actualizado.');
    }

    public function adjuntar(Request $request)
    {
        $archivo = $request->file('adjunto');
        $ruta = $archivo->store('public/mailing/' . $request->mailing_id);
        $ruta = explode('/', $ruta)[3];
        MailingAdjunto::create([
            'mailing_id' => $request->mailing_id,
            'ruta' => $ruta,
        ]);
        return redirect()->back()->with('message', 'Adrchivo adjuntado.');
    }

    public function eliminarAdjunto($id)
    {
        $adjunto = MailingAdjunto::find($id);
        if ($adjunto->delete()) {
            return redirect()->back()->with('message', 'Adrchivo eliminado.');
        }
    }

    public function listas()
    {
        $listas = MailingLista::orderBy('nombre')->get();
        return view('mailing.listas', compact('listas'));
    }

    public function storeLista(Request $request)
    {
        $lista = MailingLista::create($request->all());
        if ($lista) {
            return redirect()->back()->with('message', 'Lista creada.');
        }
    }

    public function enviarMailing($id)
    {
        //Iniciando proceso en segundo plano
        MailingJob::dispatchAfterResponse($id);
    }

    public function miembrosListas($id)
    {
        $lista = MailingLista::find($id);
        $clientes = Company::all();
        return view('listas.miembros_listas', compact('lista', 'clientes'));
    }

    public function storeListaMailing(Request $request)
    {
        //ClienteListaPivot
        foreach ($request->clientes as $cliente) {
            ClienteListaPivot::create([
                'lista_id' => $request->lista_id,
                'cliente_id' => $cliente,
            ]);
        }
        return redirect()->back()->with('message', 'Lista creada.');
    }
}
