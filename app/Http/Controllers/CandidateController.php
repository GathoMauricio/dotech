<?php

namespace App\Http\Controllers;

use App\LocationUser;
use App\RolUser;
use App\StatusUser;
use App\UserDocument;
use App\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Candidate::where('rol_user_id',4)->get();
        return view('candidates.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = StatusUser::all();
        $rols = RolUser::all();
        $locations = LocationUser::orderBy('name')->get();
        return view('candidates.create',[ 'statuses' => $statuses, 'rols' => $rols, 'locations' => $locations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Candidate::create($request->all());
        $user->password = bcrypt($request->email);
        $user->api_token = \Str::random(60);
        if(!empty($request->image))
        {
            $file = $request->file('image');
            $name =  "User_[".$user->id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $user->image = $name;
            $user->save();
            return redirect()->route('wire_candidates')->with('message', 'El aspirante se guardó y su imagen se almacenó con éxito.');
        }
        $user->save();
        #TODO : Make email template whit instructions about login
        return redirect()->route('wire_candidates')->with('message', 'Aspirante creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Candidate::findOrFail($id);
        $statuses = StatusUser::all();
        $rols = RolUser::all();
        $locations = LocationUser::orderBy('name')->get();
        $documents = UserDocument::where('user_id',$id)->get();
        return view('candidates.edit',[
            'user' => $user,
            'statuses' => $statuses,
            'rols' => $rols,
            'locations' => $locations,
            'documents' => $documents
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Candidate::findOrFail($id);
        $user->status_user_id = $request->status_user_id;
        $user->rol_user_id = $request->rol_user_id;
        $user->location_user_id = $request->location_user_id;
        $user->name = $request->name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->emergency_phone = $request->emergency_phone;
        $user->address = $request->address;
        if(!empty($request->image))
        {
            if($user->image != 'perfil.png')
            {
                if(\Storage::get($user->image)){
                    \Storage::disk('local')->delete($user->image);
                }
            }
            $file = $request->file('image');
            $name =  "User_[".$user->id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            \Storage::disk('local')->put($name,  \File::get($file));
            $user->image = $name;
            $user->save();
            return redirect()->route('edit_user',$user->id)->with('message', 'El usuario se actualizó y su imagen se almacenó con éxito.');
        }
        $user->save();
        return redirect()->route('edit_user',$user->id)->with('message', 'Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Candidate::findOrFail($id);
        $user->delete();
        return redirect()->route('wire_candidates')->with('message', 'Candidato eliminado');
    }
}
