<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDocument;
use App\Company;

class CompanyDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $company = Company::find($id);
        $documents = CompanyDocument::where('company_id', $id)->orderBy('created_at','DESC')->paginate(10);
        return view('company_documents.index',['company' => $company, 'documents' => $documents]);
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
        $document = CompanyDocument::create($request->all());
        if($document)
        {
            $file = $request->file('file');
            $name =  "CompanyDocument_[".$document->id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $document->document = $name;
            $document->save();
            return redirect()->back()->with('message','El registro se agrego correctamente');
        }
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
    public function edit(Request $request)
    {
        $document = CompanyDocument::find($request->id);
        return $document;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $document = CompanyDocument::find($request->id);
        $document->description = $request->description;
        $document->save();
        return redirect()->back()->with('message','El registro se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = CompanyDocument::find($id);
        $document->delete();
        return redirect()->back()->with('message','El registro se eliminó correctamente');
    }
}
