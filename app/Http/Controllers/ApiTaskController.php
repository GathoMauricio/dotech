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
            where('archived','NO')->orderBy('id','DESC')->get();
        }else{
            $tasks = Task::
            where('archived','NO')->
            where(function($query) {
                $query->orWhere('user_id',Auth::user()->id);
                $query->orWhere('author_id',Auth::user()->id);
                $query->orWhere('visibility','Público');
            })->orderBy('id','DESC')->get();
        }
        $json = [];
        foreach($tasks as $task)
        {
            $json [] = [
                'id' => $task->id,
                'context' => $task->context,
                'visibility' => $task->visibility,
                'status' => $task->status,
                'title' => $task->title,
                'user' => $task->user['name'].' '.$task->user['middle_name'].' '.$task->user['last_name'],
                'author' => $task->author['name'].' '.$task->author['middle_name'].' '.$task->author['last_name']

            ];
        }
        return $json;
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
    public function store(Request $request)
    {
        $task = Task::create($request->all());
        if($task){
            return ['error' => 0 , 'msg' => 'Tarea almacenada'];
        }else{
            return ['error' => 1 , 'msg' => 'Error al almacenar tarea'];
        }
    }
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return "Registro eliminado.";
    } 
}
