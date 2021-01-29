<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\BinnacleImage;
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
