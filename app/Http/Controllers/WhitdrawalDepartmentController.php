<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\WhitdrawalDepartment;
class WhitdrawalDepartmentController extends Controller
{
    public function index()
    {
        $departments = WhitdrawalDepartment::all();
        return view('withdrawal.index_department',[ 'departments' => $departments ]);
    }
    public function create()
    {
        return view('withdrawal.create_department');
    }
    public function store(Request $request)
    {
        $department = WhitdrawalDepartment::create($request->all());
        return redirect()->route('index_department')->with('message', 'Departamento creado');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $department = WhitdrawalDepartment::findOrFail($id);
        return view('withdrawal.edit_department',[ 'department' => $department]);
    }
    public function update(Request $request, $id)
    {
        $department = WhitdrawalDepartment::findOrFail($id);
        $department->name = $request->name;
        $department->save();
        return redirect()->route('index_department')->with('message', 'Departamento actualizado');
    }
    public function destroy($id)
    {
        $department = WhitdrawalDepartment::findOrFail($id);
        $department->delete();
        return redirect()->route('index_department')->with('message', 'Departamento eliminado');
    }
}
