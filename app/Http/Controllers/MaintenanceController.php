<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Maintenance;
class MaintenanceController extends Controller
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
        $maintenance = Maintenance::create($request->all());
        if($maintenance)
        {
            return redirect()->back()->with('message', 'El mantenimiento para '.$maintenance->vehicle['brand'].' se creó con éxito.');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        
        return view('maintenances.edit',['maintenance' => $maintenance]);
    }

    public function update(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->fill($request->all())->save();
        return redirect()->back()->with('message', 'El mantenimiento se actualizó con éxito.');
    }

    public function destroy($id)
    {
        //
    }
}
