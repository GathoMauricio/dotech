<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VehicleVerification;

class VehicleVerificationController extends Controller
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
        $verification = VehicleVerification::create($request->all());
        if($verification)
        {
            $file = $request->file('image');
            $name =  "VehicleVerification_[".$verification->id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $verification->image = $name;
            $verification->save();
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
