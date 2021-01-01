<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use  App\Http\Requests\ResetPasswordRequest;
use App\User;
use Auth;
use Storage;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::all();
        return view('users.index',[ 'users' => $users ]);
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return redirect()->route('index_user')->with('message', 'Usuario creado');
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
        $user = User::findOrFail($id);
        return view('users.edit',[ 'user' => $user]);
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        //fields
        $user->save();
        return redirect()->route('edit_user')->with('message', 'Usuario actualizado');
    }
    public function updateUserName(Request $request){
        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->save();
        return redirect()->back()->with('message', 'Información actualizada.');
    }
    public function updateUserImage(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $file = $request->file('image');
        $name =  "UserImage_[".$user->id."]_".\Str::random(8)."_".$file->getClientOriginalName();
        Storage::disk('local')->put($name,  \File::get($file));
        if($user->image != 'perfil.png')
        {
            if(Storage::get($user->image)){
                Storage::disk('local')->delete($user->image);
                $user->image = $name;
                $user->save();
                return redirect()->back()->with('message', 'La foto se actualizo con éxito.');
            }else{ 
                return redirect()->back()->with('message', 'Fallo al eliminar la imagen anterior.');
            }
        }else{
            $user->image = $name;
            $user->save();
            return redirect()->back()->with('message', 'La foto se actualizo con éxito.');
        }
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('index_user')->with('message', 'Usuario eliminado');
    }

    public function updatePassword(ResetPasswordRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->password = bcrypt($request->password);
        $user->save();
        createSysLog("actualizó su contraseña");
        return redirect('/')->with('message', 'Su contraseña se actualizo con exito.');
    }
}
