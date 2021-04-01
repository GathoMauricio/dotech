<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\WhitdrawalProvider;
class WhitdrawalProviderController extends Controller
{
    public function index()
    {
        $whitdrawals = WhitdrawalProvider::orderBy('name')->get();
        return view('providers.index',['whitdrawals' => $whitdrawals]);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $WhitdrawalProvider=WhitdrawalProvider::create($request->all());

        $msg = "agregó el proveedor de retiro ".$WhitdrawalProvider->name;
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('provider_index')
            ]));
        }

        return redirect()->back()->with('message', 'El proveedor se agregó correctamente');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $whitdrawal = WhitdrawalProvider::findOrFail($id);
        return view('providers.edit',['whitdrawal' => $whitdrawal]);
    }
    public function update(Request $request, $id)
    {
        $WhitdrawalProvider = WhitdrawalProvider::findOrFail($id);
        $WhitdrawalProvider->name = $request->name;
        $WhitdrawalProvider->bank = $request->bank;
        $WhitdrawalProvider->account = $request->account;
        $WhitdrawalProvider->pay_type = $request->pay_type;
        $WhitdrawalProvider->rfc = $request->rfc;
        $WhitdrawalProvider->address = $request->address;
        $WhitdrawalProvider->manager = $request->manager;
        $WhitdrawalProvider->phone = $request->phone;
        $WhitdrawalProvider->save();

        $msg = "actualizó el proveedor de retiro ".$WhitdrawalProvider->name;
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('provider_index')
            ]));
        }

        return redirect()->back()->with('message', 'El proveedor se actualizó correctamente');
    }
    public function destroy($id)
    {
        $WhitdrawalProvider = WhitdrawalProvider::findOrFail($id);

        $msg = "eliminó el proveedor de retiro ".$WhitdrawalProvider->name;
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('provider_index')
            ]));
        }

        $WhitdrawalProvider->delete();
        return redirect()->back()->with('message', 'El proveedor se eliminó correctamente');
    }
}
