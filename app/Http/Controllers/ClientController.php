<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Binnacle;

class ClientController extends Controller
{
    use AuthenticatesUsers;

    protected $guard = 'clients';

    public function showLoginForm()
    {
        if(!empty(\Auth::guard('clients')->user()))
        {
            return redirect('clients_dashboard');
        }
        return view('clients.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->except(['_token']);

        if(\Auth::guard('clients')->attempt($credentials))
        { 
            return redirect('clients_dashboard');
        }else{
            return redirect()->back()->withErrors(['email' => 'Las credenciales no se encuentran en nuestros registros.']);
        }
    }

    public function authenticated()
    {
        return redirect('clients_dashboard');
    }

    public function secret()
    {
        return auth('clients')->user()->email;
    }

    public function logout(Request $request)
    {
        \Auth::guard('clients')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'clients_login' ));
    }

    public function dashboard()
    {
        if (empty(\Auth::guard('clients')->user())) 
            return redirect('clients_login');
        return view('clients.dashboard');
    }
    public function makePdf($id)
    {
        

        $binnacle = Binnacle::findOrFail($id);
        if(auth('clients')->user()->id != $binnacle->sale->company['id']){
            abort(404);
        }
        $logo = parseBase64(public_path("img/dotech_fondo.png"));
        if(!empty($binnacle->sale['description']))
        {
           $logo2 = parseBase64(public_path("storage/".$binnacle->sale->company['image'])); 
        }else{
            $logo2 = parseBase64(public_path("storage/compania.png")); 
        }
        if(!empty($binnacle->firm)) $firm = parseBase64(public_path("storage/".$binnacle->firm)); else $firm = NULL;
        $pdf = \PDF::loadView('pdf.binnacle',
            [
                'logo' => $logo,
                'logo2' => $logo2,
                'firm' => $firm,
                'binnacle' => $binnacle
            ]
        );
        return $pdf->stream('Bitacora_'.$binnacle->id.'.pdf');
    }
}
