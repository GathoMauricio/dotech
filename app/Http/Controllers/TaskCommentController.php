<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\TaskComment;
class TaskCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }
    public function indexAjax(Request $request)
    {
        $comments = TaskComment::where('task_id',$request->id)->orderBy('created_at','ASC')->get();
        $json=[];
        foreach($comments as $comment)
        {
            $json[] = [
                'author' => $comment->user['name'].' '.$comment->user['middle_name'].' '.$comment->user['last_name'],
                'body' => $comment->body,
                'created_at' => formatDate($comment->created_at),
            ];
        }
        return $json;
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function storeAjax(Request $request)
    {
        $taskComment = TaskComment::create($request->all());
        if($taskComment)
        {
            $comments = TaskComment::where('task_id',$request->task_id)->orderBy('created_at','ASC')->get();
            $json=[];
            
            foreach($comments as $comment)
            {
                $json[] = [
                    'author' => $comment->user['name'].' '.$comment->user['middle_name'].' '.$comment->user['last_name'],
                    'body' => $comment->body,
                    'created_at' => formatDate($comment->created_at),
                ];
            }
            $msg = "comentó la tarea ".$taskComment->task['title']." : ".$taskComment->body;
            createSysLog($msg);
            $ids=\App\TaskComment::distinct()->where('task_id',$request->task_id)->where('user_id','!=',$taskComment->user_id)->get('user_id');
            foreach($ids as $id)
            {
                event(new \App\Events\NotificationEvent([
                    'event' => 'task_comment',
                    'task_id' => $taskComment->task_id,
                    'id' => $id->user_id,
                    'msg' => \Auth::user()->name.' '.\Auth::user()->middle_name.' '.$msg,
                    'route' => route('task_index')
                ]));
            }
            return $json;
        }else{ return "Fail"; }
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
