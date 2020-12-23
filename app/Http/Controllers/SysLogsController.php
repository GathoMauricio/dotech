<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\SysLog;
class SysLogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $logs = SysLog::orderBy('id','desc')->paginate(20);
        return view('logs.index',['logs' => $logs]);
    }
    public function create()
    {
        //
    }
    public function store($body)
    {
        SysLog::create(['body' => $body]);
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
