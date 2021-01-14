<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Task;
use App\User;
use Auth;
class ApiTaskController extends Controller
{
    public function index(){
        if(Auth::user()->rol_user_id == 1)
        {
            $tasks = Task::
            where('archived','NO')->get();
        }else{
            $tasks = Task::
            where('archived','NO')->
            where(function($query) {
                $query->orWhere('user_id',Auth::user()->id);
                $query->orWhere('author_id',Auth::user()->id);
                $query->orWhere('visibility','Público');
            })->get();
        }
        return $tasks;
    }
    public function show($id)
    {
        $task = Task::findOrFail($id);
        $taskUser = User::findOrFail($task->user_id);
        $users = User::orderBy('name')->get();
        return [
            'task' => $task,
            'taskUser' => $taskUser,
            'users' => $users
        ];
    }
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->fill($request->all())->save();
        return "El registro se actualizó con éxito.";
    }
}
