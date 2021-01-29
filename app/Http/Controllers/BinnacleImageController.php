<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\BinnacleImage;
use App\Binnacle;
class BinnacleImageController extends Controller
{
    public function index($id)
    {
        $images = BinnacleImage::where('binnacle_id',$id)->get();
        $json = [];
        foreach($images as $image)
        {
            $json[] = [
                'url' => getUrl().'/storage/'.$image->image,
                'description' => $image->description,
                'date' => formatDate($image->created_at)
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
        $binnacle_image = BinnacleImage::create([
            'binnacle_id' => $request->binnacle_id,
            'description' => $request->description,
        ]);
        if($binnacle_image)
        {
            $file = $request->file('image');
            $name =  "Binnacle[".$binnacle_image->id."_".$binnacle_image->binnacle_id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $binnacle_image->image = $name;
            $binnacle_image->save();
            createSysLog("Subió una imagen a la bitácora ".$binnacle_image->binnacle['description']);
            return redirect()->back()->with('message', 'La imagen '.$binnacle_image->description.' se cargó con exito');
        }else{ "Error durante la carga"; }
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
