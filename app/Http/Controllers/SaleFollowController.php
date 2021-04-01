<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Sale;
use App\SaleFollow;
class SaleFollowController extends Controller
{
    public function index($id)
    {
        $sale = Sale::findOrFail($id);
        $follows = SaleFollow::where('sale_id',$id)->orderBy('created_at','DESC')->paginate(15);
        return view('sale.follows',[ 'sale' => $sale, 'follows' => $follows ]);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $saleFollow = SaleFollow::create($request->all());
        if($saleFollow){

            $msg = "agregó un seguimiento al proyecto ".$saleFollow->sale['description'].": ".$saleFollow->body;
            createSysLog($msg);
            $notificationUsers = \App\User::where('rol_user_id',1)->get();
            foreach($notificationUsers as $user)
            {
                event(new \App\Events\NotificationEvent([
                    'id' => $user->id,
                    'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                    'route' => route('sale_follows',$saleFollow->sale['id'])
                ]));
            }

            return redirect()->back()->with('message', 'Seguimiento agregado');
        }
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
        $saleFollow = SaleFollow::findOrFail($id);
        $saleFollow->delete();
        return redirect()->back()->with('message', 'Seguimiento eliminado');
    }
}
