<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Task;
use App\Service;
use App\Sale;
use App\Expense;
use Auth;
class ApiMenuController extends Controller
{
    public function index()
    {
        //if(Auth::user()->rol_user_id == 1)
        if(true)
        {
            $taskCount = count(Task::
            where('archived','NO')->get());
            $serviceCount = count(Service::where('status','Pendiente')->orderBy('id','desc')->get());
            $quoteCount = count(Sale::where('status','Pendiente')->get());
            $projectCount = count(Sale::where('status','Proyecto')->get());
            $expenseCount = count(Expense::where('status','Pendiente')->get());
        }else{
            $taskCount = count(Task::
            where('archived','NO')->
            where(function($query) {
                $query->orWhere('user_id',Auth::user()->id);
                $query->orWhere('author_id',Auth::user()->id);
                $query->orWhere('visibility','Público');
            })->get());
            $serviceCount = count(Service::
            where('status','Pendiente')
            ->where(function($query) {
                $query->orWhere('author_id',Auth::user()->id);
                $query->orWhere('technical_id',Auth::user()->id);
            })
            ->orderBy('id','desc')->get());
            $quoteCount = count(Sale::where('status','Pendiente')->where('author_id',Auth::user()->id)->get());
            $projectCount = count(Sale::where('status','Proyecto')->where('author_id',Auth::user()->id)->get());
            $expenseCount = count(Expense::where('status','Pendiente')->where('author_id',Auth::user()->id)->get());
        }
        return [
            'taskCount' => $taskCount,
            'serviceCount' => $serviceCount,
            'quoteCount' => $quoteCount,
            'projectCount' => $projectCount,
            'expenseCount' => $expenseCount
        ];
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
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
