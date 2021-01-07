<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Service;
class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('status','Pendiente')->orderBy('id','desc')->get();
        return view('services.index',[ 'services' => $services]);
    }
    public function processing()
    {
        $services = Service::where('status','En proceso')->orderBy('id','desc')->get();
        return view('services.processing',[ 'services' => $services]);
    }
    public function finished()
    {
        $services = Service::where('status','Finalizado')->orderBy('id','desc')->get();
        return view('services.finished',[ 'services' => $services]);
    }
    public function canceled()
    {
        $services = Service::where('status','Cancelado')->orderBy('id','desc')->get();
        return view('services.canceled',[ 'services' => $services]);
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
