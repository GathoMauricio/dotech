<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Task;
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
}
