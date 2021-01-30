<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Whitdrawal;
use App\WhitdrawalAccount;
use App\User;
class WhitdrawalController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(\Auth::user()->id);
        if (\Hash::check($user->email,$user->password))
        {
            return view('users.default_password',['user' => $user]);
        }else{
            $whitdrawals = Whitdrawal::where('status','Pendiente')->orderBy('id','desc')->paginate(15);
            return view('withdrawal.index',[ 'whitdrawals' => $whitdrawals]);
        }
    }
    public function indexAproved()
    {
        $whitdrawals = Whitdrawal::where('status','Aprobado')->orderBy('id','desc')->paginate(15);
        return view('withdrawal.disaproved',[ 'whitdrawals' => $whitdrawals]);
    }
    public function indexDisaproved()
    {
        $whitdrawals = Whitdrawal::where('status','Desaprobado')->orderBy('id','desc')->paginate(15);
        return view('withdrawal.disaproved',[ 'whitdrawals' => $whitdrawals]);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $whitdrawal = Whitdrawal::create($request->all());
        if($whitdrawal){
            createSysLog("Creo una solicitud de retiro: ".$whitdrawal->description);
            return redirect()->back()->with('message', 'Solicitud de retiro agreagada');
        }else{
            return "error";
        }
    }
    public function uploadDocument(Request $request)
    {
        $whitdrawal = Whitdrawal::findOrFail($request->id);
        $file = $request->file('document');
        $name =  "WhitdrawalDocument_[".$whitdrawal->id."]_".\Str::random(8)."_".$file->getClientOriginalName();
        \Storage::disk('local')->put($name,  \File::get($file));
        $whitdrawal->document = $name;
        $whitdrawal->save();
        createSysLog("Subió la factura del retiro: ".$whitdrawal->description);
        return redirect()->back()->with('message', 'El documento se almacenó con éxito con el nombre: '.$whitdrawal->document);
    }
    public function aprove(Request $request)
    {
        $whitdrawal = Whitdrawal::findOrFail($request->id);
        $whitdrawal->status= 'Aprobado';
        $whitdrawal->whitdrawal_account_id = $request->whitdrawal_account_id;
        $whitdrawal->whitdrawal_department_id = $request->whitdrawal_department_id;
        $whitdrawal->type = $request->type;
        $whitdrawal->save();
        $account = WhitdrawalAccount::findOrFail($request->whitdrawal_account_id);
        $account->balance = floatval($account->balance) - floatval($whitdrawal->quantity);
        if(!empty($request->file))
        {
            $file = $request->file('file');
            $name =  "WhitdrawalDocument_[".$whitdrawal->id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $whitdrawal->document = $name;
        }
        $account->save();
        createSysLog("Aprobó retiro: ".$whitdrawal->description);
        return redirect()->back()->with('message', 'La solicitud se ha aprovado y la cantidad se ha descontado de la cuenta seleccionada.');
    }
    public function show(Request $request)
    {
        $whitdrawal = Whitdrawal::findOrFail($request->id);
        return $whitdrawal;
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function disaproveWithdrawal($id)
    {
        $whitdrawal = Whitdrawal::findOrFail($id);
        $whitdrawal->status= 'Desaprobado';
        $whitdrawal->delete();
        createSysLog("Rechazó el retiro: ".$whitdrawal->description);
        return redirect()->back()->with('message', 'La solicitud ha sido rechazada.');
    }
    public function destroy($id)
    {
        $whitdrawal = Whitdrawal::findOrFail($id);
        $whitdrawal->delete();
        createSysLog("Eliminó retiro: ".$whitdrawal->description);
        return redirect()->back()->with('message', 'La solicitud ha sido eliminada por completo.');
    }
}
