<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Sale;
use Auth;
class ApiProjectController extends Controller
{
    public function index()
    {
        //if(Auth::user()->rol_user_id == 1)
        if(true)
        {
            $projects = Sale::where('status','Proyecto')->orderBy('id','desc')->get();
        }else{
            $projects = Sale::where('status','Proyecto')->where('author_id',Auth::user()->id)->orderBy('id','desc')->get();
        }
        $json = [];
        foreach($projects as $project)
        {
            $json[] = [
                'id' => $project->id,
                'estimated' => $project->estimated,
                'currency' => $project->currency,
                'company' => $project->company['name'],
                'description' => $project->description
            ];
        }
        return $json;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        return [
            'id' => $sale->id,
            'description' => $sale->description,
            'company' => $sale->company['name'],
            'manager' => $sale->department['manager'],
            'department' => $sale->department['name'],
            'phone' => $sale->department['phone'],
            'email' => $sale->department['email'],
            'author' => $sale->author['name'].' '.$sale->author['middle_name'].' '.$sale->author['last_name']
        ];
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
