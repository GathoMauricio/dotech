<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\WhitdrawalAccount;
class WhitdrawalAccountController extends Controller
{
    public function index()
    {
        $accounts = WhitdrawalAccount::all();
        return view('withdrawal.index_account',[ 'accounts' => $accounts ]);
    }
    public function create()
    {
        return view('withdrawal.create_account');
    }
    public function store(Request $request)
    {
        $account = WhitdrawalAccount::create($request->all());

        $msg = "agregó la cuenta ".$account->name;
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('index_account')
            ]));
        }

        return redirect()->route('index_account')->with('message', 'Cuenta creada');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $account = WhitdrawalAccount::findOrFail($id);
        return view('withdrawal.edit_account',[ 'account' => $account]);
    }
    public function update(Request $request, $id)
    {
        $account = WhitdrawalAccount::findOrFail($id);
        $account->name = $request->name;
        $account->type = $request->type;
        $account->balance = $request->balance;
        $account->number = $request->number;
        $account->save();
        $msg = "actualizó la cuenta ".$account->name;
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('index_account')
            ]));
        }
        return redirect()->route('index_account')->with('message', 'Cuenta actualizada');
    }
    public function destroy($id)
    {
        $account = WhitdrawalAccount::findOrFail($id);

        $msg = "eliminó la cuenta ".$account->name;
        createSysLog($msg);
        $notificationUsers = \App\User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('index_account')
            ]));
        }

        $account->delete();
        return redirect()->route('index_account')->with('message', 'Cuenta eliminada');
    }
}
