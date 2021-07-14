<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\BinnacleImage;
class ApiBinnacleImageController extends Controller
{
    public function index($id)
    {
        $binnacle_images = BinnacleImage::where('binnacle_id',$id)->get();
        $json = [];
        foreach($binnacle_images as $binnacle_image)
        {
            $json[] = [
                'author' => $binnacle_image->author['name'].' '.$binnacle_image->author['middle_name'].' '.$binnacle_image->author['last_name'],
                'date' => formatDate($binnacle_image->created_at),
                'image' => getUrl().'/storage/'.$binnacle_image->image,
                'description' => $binnacle_image->description
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
            $name =  "Binnacle_api[".$binnacle_image->id."_".$binnacle_image->binnacle_id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            $img = \Image::make($file);
            $img = $img->widen(intdiv($img->width() , 4));
            $img->save('storage/'.$name, 60);
            //\Storage::disk('local')->put($name,  \File::get($file));
            $binnacle_image->image = $name;
            $binnacle_image->save();
            return "Imagen almacenada";
        }else{ "Error durante la carga"; } 
        
    }
    public function show($id)
    {
        
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
