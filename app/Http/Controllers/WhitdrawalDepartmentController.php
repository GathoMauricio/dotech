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

        $msg = "agregó el departamento de retiro ".$department->name;
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('index_department')
            ]));
        }

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

        $msg = "actualizó el departamento de retiro ".$department->name;
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('index_department')
            ]));
        }

        return redirect()->route('index_department')->with('message', 'Departamento actualizado');
    }
    public function destroy($id)
    {
        $department = WhitdrawalDepartment::findOrFail($id);

        $msg = "eliminó el departamento de retiro ".$department->name;
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('index_department')
            ]));
        }

        $department->delete();
        return redirect()->route('index_department')->with('message', 'Departamento eliminado');
    }
}
