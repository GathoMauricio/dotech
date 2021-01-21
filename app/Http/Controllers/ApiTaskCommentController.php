<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\TaskComment;
class ApiTaskCommentController extends Controller
{
    public function index($id)
    {
        $taskComments = TaskComment::where('task_id',$id)->orderBy('created_at','ASC')->get();
        $json = [];
        foreach($taskComments as $taskComment)
        {
            if($taskComment->user['image'] == 'perfil.png')
            {
                $image= getUrl().'/img/'.$taskComment->user['image'];  
            }else {
                $image= getUrl().'/storage/'.$taskComment->user['image'];  
            }
            $json[] = [
                'image' => $image,
                'user' => $taskComment->user['name'].' '.$taskComment->user['middle_name'],
                'user_id' => $taskComment->user['id'],
                'body' => $taskComment->body,
                'date' => formatDate($taskComment->created_at)
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
        $taskComment = TaskComment::create([
            'task_id' => $request->task_id,
            'body' => $request->body,
        ]);
        return $taskComment;
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
