<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use  App\Http\Requests\ResetPasswordRequest;
use App\User;
use Auth;
class UserController extends Controller
{
    public function index()
    {
        //
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
    public function showAjax(Request $request)
    {
        $user = User::findOrFail($request->id);
        $image_route = "";
        if($user->image == 'perfil.png'){ $image_route = asset('img').'/'.$user->image; }
        else{ $image_route = asset('storage').'/'.$user->image; }
        if(empty($user->emergency_phone)){ $user->emergency_phone = 'No definido'; }
        return [
            'image' => $image_route,
            'name' => $user->name.' '.$user->middle_name.' '.$user->last_name,
            'rol' => $user->rol['name'],
            'email' => $user->email,
            'phone' => $user->phone,
            'emergency' => $user->emergency_phone,
            'address' => $user->address,
            'location' => $user->location['name'],
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
    public function destroy($id)
    {
        //
    }

    public function updatePassword(ResetPasswordRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/')->with('message', 'Su contraseña se actualizo con exito.');
    }
}
