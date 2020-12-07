<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
class WithdrawRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        if (Hash::check($user->email,$user->password))
        {
            return view('users.default_password',['user' => $user]);
        }else{
            return redirect(route('task_index')); //Temp Redirect
            return view('withdraw_request.index');
        }
        return redirect(route('task_index')); //Temp Redirect
        return view('withdraw_request.index');
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
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
        //
    }
}
