<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Service;
use App\ServiceLocation;
use App\Company;
use App\CompanyDepartment;
use App\ServiceFollow;
use App\ServiceImage;
use App\User;
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
        $locations = ServiceLocation::orderBy('name')->get();
        $companies = Company::orderBy('name')->get();
        $departments = CompanyDepartment::where('company_id',$companies[0]->id)->orderBy('name')->get();
        $users = User::where('status_user_id',1)->orderBy('name')->get();
        return view('services.create',[
            'locations' => $locations,
            'users' => $users,
            'companies' => $companies,
            'departments' => $departments
        ]);
    }
    public function store(Request $request)
    {
        $service = Service::create($request->all());
        if($service){
            $service->programed_at = $request->date.' '.$request->time;
            $service->save();
            return redirect()->route('index_service')
            ->with('message', 'El servicio para '.$service->department['manager'].' se creó con exito.');
        }
    }
    public function show($id)
    {
        $service = Service::findOrFail($id);
        $images = ServiceImage::where('service_id', $id)->get();
        $follows = ServiceFollow::where('service_id', $id)->get();
        return view('services.show',[
            'service' => $service,
            'images' => $images,
            'follows' => $follows
        ]);
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
