<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Binnacle;
class ApiBinnacleController extends Controller
{
    public function index($id)
    {
        $binnacles = Binnacle::where('sale_id',$id)->get();
        $json = [];
        foreach($binnacles as $binnacle)
        {
            $json[] = [
                'id' => $binnacle->id,
                'author' => $binnacle->author['name'].' '.$binnacle->author['middle_name'].' '.$binnacle->author['last_name'],
                'description' => $binnacle->description,
                'date' => onlyDate($binnacle->created_at),
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
