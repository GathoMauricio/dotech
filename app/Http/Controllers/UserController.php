<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UserRequest;
use App\User;
use App\StatusUser;
use App\RolUser;
use App\LocationUser;
use App\UserDocument;
use App\Vacacion;
use Auth;
use Storage;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($search = null)
    {
        if ($search) {
            $users = User::where('rol_user_id', '!=', 4)->where(function ($q) use ($search) {
                $q->where('email', 'like', '%' . $search . '%');
                $q->orWhere('name', 'like', '%' . $search . '%');
                $q->orWhere('middle_name', 'like', '%' . $search . '%');
                $q->orWhere('last_name', 'like', '%' . $search . '%');
            })->paginate(5);
        } else {
            $users = User::where('rol_user_id', '!=', 4)->paginate(5);
        }
        $users->map(function ($user) {
            $anios = Carbon::parse($user->fecha_contrato)->age;
            $user['anios'] = $anios;
            $user['dias_obtenidos'] = $anios * 15;
            $user['dias_tomados'] = $user->vacaciones->where('estatus', 'aprobado')->pluck('dias')->sum();
            $user['dias_restantes'] = $user['dias_obtenidos'] - $user['dias_tomados'];
        });
        $vacaciones = Vacacion::where('estatus', 'pendiente')->get();
        return view('users.index', ['users' => $users, 'vacaciones' => $vacaciones]);
    }
    public function create()
    {
        $statuses = StatusUser::all();
        $rols = RolUser::all();
        $locations = LocationUser::orderBy('name')->get();
        return view('users.create', ['statuses' => $statuses, 'rols' => $rols, 'locations' => $locations]);
    }
    public function store(UserRequest $request)
    {

        $user = User::create($request->all());
        $rol = RolUser::find($request->rol_user_id);
        $user->assignRole($rol->name);
        $user->password = bcrypt($request->email);
        $user->api_token = \Str::random(60);
        if (!empty($request->image)) {
            $file = $request->file('image');
            $name =  "User_[" . $user->id . "]_" . \Str::random(8) . "_" . $file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $user->image = $name;
            $user->save();
            return redirect()->route('index_user')->with('message', 'El usuario se guardó y su imagen se almacenó con éxito.');
        }
        $user->save();
        #TODO : Make email template whit instructions about login
        return redirect()->route('index_user')->with('message', 'Usuario creado');
    }
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('users.show', compact('usuario'));
    }
    public function showAjax(Request $request)
    {
        $user = User::findOrFail($request->id);
        $image_route = "";
        if ($user->image == 'perfil.png') {
            $image_route = asset('img') . '/' . $user->image;
        } else {
            $image_route = asset('storage') . '/' . $user->image;
        }
        if (empty($user->emergency_phone)) {
            $user->emergency_phone = 'No definido';
        }
        return [
            'image' => $image_route,
            'name' => $user->name . ' ' . $user->middle_name . ' ' . $user->last_name,
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
        $statuses = StatusUser::all();
        $rols = RolUser::all();
        $locations = LocationUser::orderBy('name')->get();
        $documents = UserDocument::where('user_id', $id)->get();
        return view('users.edit', [
            'user' => $user,
            'statuses' => $statuses,
            'rols' => $rols,
            'locations' => $locations,
            'documents' => $documents
        ]);
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $rol = RolUser::find($request->rol_user_id);
        $user->syncRoles();
        $user->assignRole($rol->name);
        $user->status_user_id = $request->status_user_id;
        $user->rol_user_id = $request->rol_user_id;
        $user->location_user_id = $request->location_user_id;
        $user->name = $request->name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->emergency_phone = $request->emergency_phone;
        $user->address = $request->address;
        $user->fecha_contrato = $request->fecha_contrato;
        if (!empty($request->image)) {
            if ($user->image != 'perfil.png') {
                if (\Storage::get($user->image)) {
                    \Storage::disk('local')->delete($user->image);
                }
            }
            $file = $request->file('image');
            $name =  "User_[" . $user->id . "]_" . \Str::random(8) . "_" . $file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $user->image = $name;
            $user->save();
            return redirect()->route('edit_user', $user->id)->with('message', 'La usuario se actualizó y su imagen se almacenó con éxito.');
        }
        $user->save();
        return redirect()->route('edit_user', $user->id)->with('message', 'Usuario actualizado');
    }
    public function updateUserName(Request $request)
    {
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
        $name =  "UserImage_[" . $user->id . "]_" . \Str::random(8) . "_" . $file->getClientOriginalName();
        Storage::disk('local')->put($name,  \File::get($file));
        if ($user->image != 'perfil.png') {
            if (Storage::get($user->image)) {
                Storage::disk('local')->delete($user->image);
                $user->image = $name;
                $user->save();
                return redirect()->back()->with('message', 'La foto se actualizo con éxito.');
            } else {
                return redirect()->back()->with('message', 'Fallo al eliminar la imagen anterior.');
            }
        } else {
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
    public function updateMyPassword(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->password = bcrypt($request->password);
        $user->save();
        createSysLog("actualizó su contraseña");
        return redirect()->back()->with('message', 'Su contraseña se actualizo con exito.');
    }
    public function updatePasswordAdmin(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->password = bcrypt($request->password);
        $user->save();
        createSysLog("actualizó la contraseña de " . $user->name . " " . $user->middle_name . " " . $user->last_name);
        return redirect()->back()->with('message', 'La contraseña se actualizo con exito.');
    }
    public function updateEvaluationTest(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->evaluation = number_format($request->evaluation, 2);
        $user->save();
        return $user;
    }
}
