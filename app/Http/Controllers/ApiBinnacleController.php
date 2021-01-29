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
        $binnacle = Binnacle::create([
            'sale_id' => $request->sale_id,
            'description' => $request->description
        ]);
        if($binnacle)
        {
            return  [
                'error' => 0,
                'msg' => 'Bitácora creada ahora puede agregar imagenes.',
                'id' => $binnacle->id
            ];
        }else{
            return  [
                'error' => 1,
                'msg' => 'Error al crear registro..'
            ];
        }
    }
    public function storeFirm(Request $request)
    {
        $binnacle = Binnacle::findOrFail($request->binnacle_id);
        $image = $request->firma;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'BinnacleFirm_'.$binnacle->id.'.'.'png';
        \Storage::disk('local')->put($imageName,base64_decode($image));
        $binnacle->firm = $imageName;
        $binnacle->save();
        return $binnacle;
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
