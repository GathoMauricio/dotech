<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\CompanyRepository;
use App\Company;
class CompanyRepositoryController extends Controller
{
    public function index($id)
    {
        $repositories = CompanyRepository::where('company_id', $id)->get();
        $company = Company::findOrFail($id);
        return view('repository.index', compact('repositories','company'));
    }
    public function create($id)
    {
        $company = Company::findOrFail($id);
        return view('repository.create', compact('company'));
    }
    public function store(Request $request)
    {
        $repository = CompanyRepository::create($request->all());
        if($repository)
        {
            return redirect()->route('repository_company',$request->company_id)->with('message', 'Repositorio creado.');
        }
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $repository = CompanyRepository::findOrFail($id);
        return view('repository.edit', compact('repository'));
    }
    public function update(Request $request, $id)
    {
        $repository = CompanyRepository::findOrFail($id);
        $repository->title = $request->title;
        $repository->body = $request->body;
        $repository->save();
        return redirect()->route('repository_company',$repository->company_id)->with('message', 'Repositorio actualizado.');
    }
    public function destroy($id)
    {
        $repository = CompanyRepository::findOrFail($id);
        $repository->delete();
        return redirect()->route('repository_company',$repository->company_id)->with('message', 'Repositorio eliminado.');
    }
}
