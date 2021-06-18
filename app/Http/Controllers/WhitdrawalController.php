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
            $msg = "creo una solicitud de retiro: ".$whitdrawal->description;
            createSysLog($msg);
            $notificationUsers = User::where('rol_user_id',1)->get();
            foreach($notificationUsers as $user)
            {
                event(new \App\Events\NotificationEvent([
                    'id' => $user->id,
                    'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                    'route' => route('whitdrawal_index')
                ]));
            }
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
        $msg = " subió la factura del retiro: ".$whitdrawal->description;
        createSysLog($msg);
        $notificationUsers = User::where('rol_user_id',1)->get();
        foreach($notificationUsers as $user)
        {
            event(new \App\Events\NotificationEvent([
                'id' => $user->id,
                'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                'route' => route('whitdrawal_index')
            ]));
        }
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
        $msg = "aprobó el retiro: ".$whitdrawal->description;
        createSysLog($msg);
        event(new \App\Events\NotificationEvent([
            'id' => $whitdrawal->author_id,
            'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
            'route' => route('show_sale',$whitdrawal->sale_id)
        ]));
        return redirect()->back()->with('message', 'La solicitud se ha aprovado y la cantidad se ha descontado de la cuenta seleccionada.');
    }
    public function show(Request $request)
    {
        $whitdrawal = Whitdrawal::findOrFail($request->id);
        return $whitdrawal;
    }
    public function showWhitdrawalAjax(Request $request)
    {
        $whitdrawal = Whitdrawal::findOrFail($request->id);
        if(!empty($whitdrawal->author['name']))
        {
            $author = $whitdrawal->author['name'].' '.$whitdrawal->author['middle_name'].' '.$whitdrawal->author['last_name'];
        }else{
            $author = "No definido";
        }
        if($whitdrawal->status != 'Aprobado')
        {
            $button1 = '<a href="#" onclick="aproveWithdrawalModal('.$whitdrawal->id.');"><span class="icon-point-up" title="Aprovar" style="cursor:pointer;color:#74DF00"> Aprobar</span></a>';
            $button2 = '<a href="#" onclick="disaproveWithdrawal('.$whitdrawal->id.');"><span class="icon-point-down" title="Desaprobar" style="cursor:pointer;color:#FFBF00"> Rechazar</span></a>';
        }else{
            $button1 = "";
            $button2 = "";
        }
        return [
            'id' => $whitdrawal->id,
            'provider' => $whitdrawal->provider['name'],
            'project' =>  $whitdrawal->sale['id'] .' - '. $whitdrawal->sale['description'],
            'description' => $whitdrawal->description,
            'author' => $author,
            'quantity' => $whitdrawal->quantity,
            'invoive' => $whitdrawal->invoive,
            'date' => onlyDate($whitdrawal->created_at),
            'status' => $whitdrawal->status,
            'button1' => $button1,
            'button2' => $button2
        ];
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
        $msg = "desaprobó el retiro: ".$whitdrawal->description;
        createSysLog($msg);
        event(new \App\Events\NotificationEvent([
            'id' => $whitdrawal->author_id,
            'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
            'route' => route('show_sale',$whitdrawal->sale_id)
        ]));
        return redirect()->back()->with('message', 'La solicitud ha sido rechazada.');
    }
    public function destroy($id)
    {
        $whitdrawal = Whitdrawal::findOrFail($id);
        $whitdrawal->delete();
        createSysLog("Eliminó retiro: ".$whitdrawal->description);
        return redirect()->back()->with('message', 'La solicitud ha sido eliminada por completo.');
    }
    public function searchWhitdrawalAjax(Request $request)
    {
        $whitdrawals = Whitdrawal::where('status','Pendiente')->where('description','LIKE','%'.$request->q.'%')->limit(10)->get();
        $json = [];
        foreach($whitdrawals as $whitdrawal){
            $json [] = [
                'label' => $whitdrawal->sale['description'].' - '.$whitdrawal->description .' - '.$whitdrawal->status,
                'value' => $whitdrawal->id
            ];
        }
        return $json;
    }
    public function searchWhitdrawalAjax2(Request $request)
    {
        $whitdrawals = Whitdrawal::where('status','Pendiente')->where('description','LIKE','%'.$request->q.'%')->limit(10)->get();
        $json = [];
        foreach($whitdrawals as $whitdrawal){

            if(\Auth::user()->rol_user_id == 1)
            {
                $links = '
                <a href="#" onclick="aproveWithdrawalModal('.$whitdrawal->id .');"><span class="icon-point-up" title="Aprovar" style="cursor:pointer;color:#74DF00"> Aprobar</span></a>
                <br>
                <a href="#" onclick="disaproveWithdrawal('.$whitdrawal->id .');"><span class="icon-point-down" title="Desaprobar" style="cursor:pointer;color:#FFBF00"> Rechazar</span></a>
                <br>
                <a href="#" onclick="deleteWithdrawal('.$whitdrawal->id .');"><span class="icon-bin" title="Eliminar" style="cursor:pointer;color:#DF0101"> Eliminar</span></a>
                <br>
                ';
                if($whitdrawal->invoive == 'SI')
                {
                    if(!empty($whitdrawal->document))
                    {
                        $links .= '<a href="'.env('APP_URL').'/storage/'.$whitdrawal->document.'" target="_BLANK"><span class="icon-eye"></span> Ver</a>';
                    }else{
                        $links .= '<a href="#" onclick="addWhitdralDocumentModal('.$whitdrawal->id .');"><span class="icon-upload"></span> Cargar</a>';
                    }
                }else{
                    $links .= 'N/A';
                }
            }else{

                if($whitdrawal->invoive == 'SI')
                {
                    
                    if(!empty($whitdrawal->document))
                    {
                        $links .= '<a href="'.env('APP_URL').'/storage/'.$whitdrawal->document.'" target="_BLANK"><span class="icon-eye"></span> Ver</a>';
                    }else{
                        $links .= '<a href="#" onclick="addWhitdralDocumentModal('.$whitdrawal->id .');"><span class="icon-upload"></span> Cargar</a>';
                    }
                    
                }else{
                    $links .= 'N/A';
                }

            }

            $json [] = [
                'id' => $whitdrawal->id,
                'provider' => $whitdrawal->provider['name'],
                'company' => $whitdrawal->sale->company['name'],
                'sale_id' => $whitdrawal->sale['id'],
                'sale_description' => $whitdrawal->sale['description'],
                'description' => $whitdrawal->description,
                'author' => $whitdrawal->author['name'].' '.$whitdrawal->author['middle_name'].' '.$whitdrawal->author['last_name'],
                'quantity' => $whitdrawal->quantity,
                'invoive' => $whitdrawal->invoive,
                'date' => onlyDate($whitdrawal->created_at),
                //'a_invoive' => $a_invoive,
                'links' => $links
            ];
        }
        return $json;
    }
}
