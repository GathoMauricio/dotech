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
