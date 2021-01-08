<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ServiceImage;
class ServiceImageController extends Controller
{
    public function show(Request $id){
        $image = ServiceImage::findOrFail($id);
        return [
            'image' => env('APP_URL').'/storage/'.$image[0]->image,
            'description' => $image[0]->description
        ]; 
    }
}