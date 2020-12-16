<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\CompanyFollow;
use Auth;
class CompanyFollowController extends Controller
{
    public function index(Request $request)
    {
        $comapanyFollows = CompanyFollow::where('company_id',$request->id)->get();
        $json = [];
        foreach($comapanyFollows as $companyFollow)
        {
            $json[] = [
                'author' => $companyFollow->author['name']." ".$companyFollow->author['middle_name']." ".$companyFollow->author['last_name'],
                'body' => $companyFollow->body,
                'created_at' => formatDate($companyFollow->created_at)
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
        CompanyFollow::create([
            'company_id' => $request->company_id,
            'body' => $request->body
        ]);
        $comapanyFollows = CompanyFollow::where('company_id',$request->company_id)->get();
        $json = [];
        foreach($comapanyFollows as $companyFollow)
        {
            $json[] = [
                'author' => $companyFollow->author['name']." ".$companyFollow->author['middle_name']." ".$companyFollow->author['last_name'],
                'body' => $companyFollow->body,
                'created_at' => formatDate($companyFollow->created_at)
            ];
        }
        return $json;
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
