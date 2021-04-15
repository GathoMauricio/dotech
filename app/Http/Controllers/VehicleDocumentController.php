<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VehicleDocument;

class VehicleDocumentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $document = VehicleDocument::create($request->all());
        if($document)
        {
            $file = $request->file('file');
            $name =  "VehicleDocument_[".$document->id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $document->file = $name;
            $document->save();
            return redirect()->back()->with('message','El registro se agrego correctamente');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
