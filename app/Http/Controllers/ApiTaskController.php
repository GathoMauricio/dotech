<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Task;
use App\Company;
use App\Sale;
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
                'author' => $task->author['name'].' '.$task->author['middle_name'].' '.$task->author['last_name'],
                'deadline' => $task->deadline,

            ];
        }
        return $json;
    }
    public function show($id)
    {
        $task = Task::findOrFail($id);
        if(!empty($task->company_id))
        {
            $cliente = Company::findOrFail($task->company_id);
        }else{
            $cliente = ['name' => 'No asignado'];
        }
        if(!empty($task->sale_id))
        {
            $sale = Sale::findOrFail($task->sale_id);
        }else{
            $sale = ['description' => 'No asignado'];
        }
        $taskUser = User::findOrFail($task->user_id);
        $users = User::orderBy('name')->get();
        $clientes = Company::orderBy('name')->get();
        $proyectos = Sale::where('company_id',$task->company_id)->get();
        return [
            'task' => $task,
            'taskUser' => $taskUser,
            'users' => $users,
            'clientes' => $clientes,
            'proyectos' => $proyectos,
            'cliente' => $cliente,
            'sale' => $sale,
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
    public function getClientes()
    {
        $companies = Company::orderBy('name')->get();
        return $companies;
    }
    public function getProyectos(Request $request)
    {
        $projects = Sale::where('status','Proyecto')->where('company_id',$request->company_id)->orderBy('description')->get();
        return $projects;
    }
}
