<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use Auth;

class ApiExpenseController extends Controller
{
    public function index()
    {
        if (Auth::user()->rol_user_id == 1) {
            $expenses = Expense::orderBy('id', 'desc')->get();
        }else{
            $expenses = Expense::where('author_id',Auth::user()->id)->orderBy('id', 'desc')->get();
        }
        $json = [];
        foreach ($expenses as $expense) {
            $json[] = [
                'id' => $expense->id,
                'amount' => $expense->amount,
                'status' => $expense->status,
                'title' => $expense->title,
                'detail' => $expense->detail,
                'author' => $expense->author['name'].' '.$expense->author['middle_name'].' '.$expense->author['last_name'],
                'date' => formatDate($expense->created_at)
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
        $expense = Expense::create($request->all());
        if($expense)
        {
            createSysLog("agregó un nuevo gasto: ".$expense->title." - ".$expense->detail);
            return [
                'error' => 0,
                'msg' => 'Se agregó el registro correctamente'
            ];
        }else{
            return [
                'error' => 1,
                'msg' => 'Error al agregar el registro'
            ];
        }
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request)
    {
        $expense = Expense::find($request->id);
        $expense->status = $request->status;
        $expense->save();
        createSysLog("actualizó el estatus a $request->status del gasto $expense->title - $expense->detail");
        return "Estatus actualizado.";
    }
    public function destroy(Request $request)
    {
        $expense = Expense::find($request->id);
        createSysLog("eliminó el gasto $expense->title - $expense->detail");
        $expense->delete();
        return "Registro eliminado.";
    }
}
