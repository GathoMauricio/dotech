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
        return redirect()->route('index_account')->with('message', 'Cuenta actualizada');
    }
    public function destroy($id)
    {
        $account = WhitdrawalAccount::findOrFail($id);
        $account->delete();
        return redirect()->route('index_account')->with('message', 'Cuenta eliminada');
    }
}
