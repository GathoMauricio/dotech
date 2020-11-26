<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Task;
use App\Project;
use App\User;
use App\TaskComment;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index',['tasks'=>$tasks]);
    }
    public function indexAjax()
    {
        $tasks = Task::all();
        $json= [];
        foreach($tasks as $task)
        {
            $context = "";
            switch($task->context)
            {
                case 'Trabajo': $context = '<span style="display:none">'.$task->context.'</span>'.'<span title="'.$task->context.'" class="icon icon-office" style="color:#9B59B6"></span>'; break;
                case 'Reunión': $context = '<span style="display:none">'.$task->context.'</span>'.'<span title="'.$task->context.'" class="icon icon-users" style="color:#2980B9"></span>'; break;
                case 'Documento': $context = '<span style="display:none">'.$task->context.'</span>'.'<span title="'.$task->context.'" class="icon icon-file-pdf" style="color:#EC7063"></span>'; break;
                case 'Internet': $context = '<span style="display:none">'.$task->context.'</span>'.'<span title="'.$task->context.'" class="icon icon-chrome" style="color:#27AE60"></span>'; break;
                case 'Teléfono': $context = '<span style="display:none">'.$task->context.'</span>'.'<span title="'.$task->context.'" class="icon icon-phone" style="color:#2874A6"></span>'; break;
                case 'Email': $context = '<span style="display:none">'.$task->context.'</span>'.'<span title="'.$task->context.'" class="icon icon-envelop" style="color:#F7DC6F"></span>'; break;
                case 'Hogar': $context = '<span style="display:none">'.$task->context.'</span>'.'<span title="'.$task->context.'" class="icon icon-home" style="color:#5DADE2"></span>'; break;
                case 'Otro': $context = '<span style="display:none">'.$task->context.'</span>'.'<span title="'.$task->context.'" class="icon icon-file-empty" style="color:#D35400"></span>'; break;
                default: $context = $task->context;
            }
            $visibility="";
            switch($task->visibility)
            {
                case 'Público': $visibility = '<span style="display:none">'.$task->visibility.'</span>'.'<span title="'.$task->visibility.'" class="icon icon-unlocked" style="color:#229954"></span>'; break;
                case 'Privado': $visibility = '<span style="display:none">'.$task->visibility.'</span>'.'<span title="'.$task->visibility.'" class="icon icon-lock" style="color:#C0392B"></span>'; break;
                default: $visibility = $task->visibility;
            }
            $statusColor = "";
            switch ($task->status) {
                case '20%': $statusColor = "#C0392B"; break;
                case '40%': $statusColor = "#F39C12"; break;
                case '60%': $statusColor = "#F1C40F"; break;
                case '80%': $statusColor = "#58D68D"; break;
                case '100%': $statusColor = "#229954"; break;
                default: $statusColor = "black";
            }
            $json[] = [
                'context' => $context,
                'visibility' => $visibility,
                'project' => empty($task->project_id) ? "Sin proyecto" : $task->project['name'],
                'title' => $task->title,
                'user' => $task->user['name'].' '.$task->user['middle_name'].' '.$task->user['last_name'],
                'deadline' => $task->deadline,
                'comments' => '<a href="#">'.count(TaskComment::where('task_id', $task->id)->get()).' <span class="icon icon-bubble" style="color:#3498DB;"></span></a>',
                'status' => '<label style="color:'.$statusColor.'" class="font-weight-bold">'.$task->status.'</label>',
                'options' => ""
            ];
        }
        $data = [
            'data' => $json
        ];
        return $data;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::orderBy('name')->get();
        $users = User::where('status_user_id',1)->
        orderBy('name')->
        orderBy('middle_name')->
        orderBy('last_name')
        ->get();
        return view('tasks.create',[
            'projects' => $projects,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create($request->all());
        return redirect('task_index')->with('message', 'La tarea '.$task->title.' se creó con éxito.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
