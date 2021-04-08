<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\VehicleHistory;

class ApiVehicleHistoryController extends Controller
{
    public function index(Request $request)
    {
        if(\Auth::user()->rol_user_id == 1)
        {
            $histories = VehicleHistory::where('vehicle_id', $request->vehicle_id)->get();
        }else{
            $histories = VehicleHistory::where('vehicle_id', $request->vehicle_id)->where('author_id',\Auth::user()->id)->get();
        }
        $json = [];
        foreach($histories as $history){
            $json[] = [
                'id' => $history->id,
                'brand' => $history->vehicle['brand'],
                'model' => $history->vehicle['model'],
                'description' => $history->description,
                'observation' => $history->observation,
                'kilometers' => $history->kilometers,
                'date' => formatDate($history->created_at),
                'user' => $history->author['name'].' '.$history->author['middle_name'].' '.$history->author['last_name']
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
        $history = VehicleHistory::create($request->all());
        if($history)
        {
            createSysLog('ha creado un histórico para '.$history->vehicle['brand'].' '.$history->vehicle['model'].': '.$history->description);
            return [
                'error' => 0,
                'history_id' => $history->id,
                'msg' => "El histórico se creo correctamente, por favor agregue las fotos correspondientes."
            ];
        }else{
            return [
                'error' => 1,
                'msg' => "Error al crear el histórico intente de nuevo."
            ];
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
