<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ClientController extends Controller
{
    use AuthenticatesUsers;

    protected $guard = 'clients';

    public function showLoginForm()
    {
        if(!empty(\Auth::guard('clients')->user()))
        {
            return redirect('clients/dashboard');
        }
        return view('clients.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->except(['_token']);

        if(\Auth::guard('clients')->attempt($credentials))
        { 
            return redirect('clients/dashboard');
        }else{
            return "No login";
        }
    }

    public function authenticated()
    {
        return redirect('clients/dashboard');
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
        return redirect()->guest(route( 'clients/login' ));
    }

    public function dashboard()
    {
        if (empty(\Auth::guard('clients')->user())) 
            return redirect('clients/login');
        return view('clients/dashboard');
    }
}
