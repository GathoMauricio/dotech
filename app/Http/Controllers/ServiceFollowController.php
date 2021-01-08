<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ServiceFollow;
class ServiceFollowController extends Controller
{
    public function index(Request $request)
    {
        $comapanyFollows = ServiceFollow::where('service_id',$request->id)->get();
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
        $follow = ServiceFollow::create([
            'service_id' => $request->service_id,
            'body' => $request->body
        ]);
        $serviceFollows = ServiceFollow::where('service_id',$request->service_id)->get();
        $json = [];
        foreach($serviceFollows as $serviceFollow)
        {
            $json[] = [
                'author' => $serviceFollow->author['name']." ".$serviceFollow->author['middle_name']." ".$serviceFollow->author['last_name'],
                'body' => $serviceFollow->body,
                'created_at' => formatDate($serviceFollow->created_at)
            ];
        }
        createSysLog("Dió seguimiento a al expediente ".$follow->service['id']." (".$follow->body.") ");
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
