<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Vehicle;
class ApiVehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return $vehicles;
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
