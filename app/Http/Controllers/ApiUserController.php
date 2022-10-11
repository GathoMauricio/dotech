<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;
class ApiUserController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password,$user->password))
        {
            if( $user->status_user_id != 2 )
            {
                return
                [
                    'error' => 0,
                    'api_token' => $user->api_token,
                    'name' => $user->name,
                    'middle_name' => $user->middle_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'image' => $user->image,
                ];
            }else{
                return
                [
                    'error' => 1,
                    'message' => 'El usuario se encuentra inactivo.'
                ];
            }
        }else{
            return
            [
                'error' => 2,
                'message' => 'El usuario no se encuentra en nuestros registros.'
            ];
        }

    }
    public function index()
    {
        //
    }
    public function activeUsers()
    {
        $users = User::where('status_user_id',1)->orderBy('name')->get();
        return $users;
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
    public function UpdateFcmToken(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->fcm_token = $request->fcm_token;
        $user->save();
        return $user;
    }
    public function userDounloadNewVersion(Request $request)
    {
        createSysLog("Descargó la versión ".$request->version." de la app móvil.");
        return "Descargó la versión ".$request->version." de la app móvil.";
    }
}
