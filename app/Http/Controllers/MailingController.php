<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mailing;

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
        //si es por defecto SI setear todas las demas en no
        $mailing = Mailing::create($request->all());

        if ($mailing) {
            return redirect()->route('mailing')->with('message', 'Registro insertado.');
        }
    }

    public function show($id)
    {
        $mailing = Mailing::find($id);
        return view('mailing.show', compact('mailing'));
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
}
