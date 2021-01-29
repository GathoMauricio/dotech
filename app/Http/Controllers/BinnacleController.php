<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Binnacle;
class BinnacleController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $binnacle = Binnacle::create($request->all());
        return redirect()->back()
            ->with('message', 'La bitácora '.$binnacle->description.' se creó con éxito.');
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
