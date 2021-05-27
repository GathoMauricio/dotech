<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Project;
class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function storeAjax(ProjectRequest $request)
    {
        $p = Project::create($request->all());
        if($p)
        {
            $html = "";
            $projects = Project::All();
            foreach($projects as $project)
            {
                if($project->id == $p->id)
                {
                    $html .= "<option value='$project->id' selected>$project->name</option>";
                }else{
                    $html .= "<option value='$project->id' >$project->name</option>";
                }
            }
            createSysLog("ha creado el proyecto ".$p->name);
            return $html;
        }else{ return "Error al procesar la petición."; }
    }
    public function show($id)
    {
        //
    }
    public function showAjax(Request $request)
    {
        $project = Project::findOrFail($request->id);
        return [
            'author_id' => $project->author_id,
            'project_author' => $project->author['name'].' '.$project->author['middle_name'].' '.$project->author['last_name'],
            'project_name' => $project->name,
            'project_description' => $project->description,
            'created_at' => formatDate($project->created_at),
            'updated_at' => formatDate($project->updated_at),
        ];
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function updateAjax(ProjectRequest $request){
        $project = Project::findOrFail($request->project_id);
        createSysLog("ha actualizado el projecto ".$project->name." : ".$project->description." por ".$request->name." : ".$request->description);
        $project->name = $request->name;
        $project->description = $request->description;
        if($project->save()){ 
            return [
            'type' => 'Listo: ','msg' => 'Proyecto actualizado.',
            'project_id' => $project->id,
            'name' => $project->name,
            'description' => $project->description,
            ]; 
        }
        else{ return ['type' => 'Error: ','msg' => 'Error al actualizar el registro.']; }
    }
    public function destroy($id)
    {
        //
    }
    public function searchProjectAjax(Request $request)
    {
        $sales = Project::where('description','LIKE','%'.$request->q.'%')->get();
        $json = [];
        foreach($sales as $sale){
            $json [] = [
                'label' => $sale->id.' - '.$sale->description,
                'value' => $sale->id
            ];
        }
        return $json;
    }
}
