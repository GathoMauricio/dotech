<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserDocument;
class UserDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $file = $request->file('document');
        $name =  "UserDocument_[".$user->id."]_".\Str::random(8)."_".$file->getClientOriginalName();
        \Storage::disk('local')->put($name,  \File::get($file));
        $userDocument = UserDocument::create([
            'user_id' => $request->user_id,
            'description' => $request->description,
            'document' => $name
        ]);

        $msg = "agregó el documento ".$userDocument->description." al usuario ".$user->name.' '.$user->middle_name.' '.$user->last_name;
        createSysLog($msg);
        return redirect()->back()->with('message', 'El documento '.$userDocument->description.' se agregó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = UserDocument::findOrFail($id);
        if(\Storage::get($document->document)){
            \Storage::disk('local')->delete($document->document);
            $document->delete();
            return redirect()->back()->with('message', 'El documento ha sido eliminado.');
        }
    }
}
