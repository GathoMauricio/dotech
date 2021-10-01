<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Task;

class TasksComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];

    public $self_component = "tasks";
    public $search = "";

    //properties
    public 
        $clientes ,
        $proyectos = null,
        $empleados,
        $show_archived = "",

        $task_id,
        $user_id,
        $company_id = null,
        //$project_id,
        $sale_id,
        $priority,
        $context,
        $title,
        $description,
        $deadline,
        $status,
        $visibility,
        $archived
        ;
    public function mount()
    {
        $this->clientes = \App\Company::orderBy('name')->get();
        $this->empleados = \App\User::where('status_user_id',1)->orderBy('name')->get();
    }
    public function render()
    {
        if(strlen($this->search) > 0)
        {
            if (\Auth::user()->rol_user_id == 1) {
                $tasks = Task::where('title','LIKE','%'.$this->search.'%')
                ->where('archived','LIKE','%'.$this->show_archived.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(15);
            } else {
                $tasks = Task::where('title','LIKE','%'.$this->search.'%')
                ->where('archived','LIKE','%'.$this->show_archived.'%')
                ->where(function ($query) {
                        $query->orWhere('user_id', \Auth::user()->id);
                        $query->orWhere('author_id', \Auth::user()->id);
                        $query->orWhere('visibility', 'Público');
                    })
                    ->orderBy('created_at', 'DESC')
                    ->paginate(15);
            }
        }else{
            if (\Auth::user()->rol_user_id == 1) {
                $tasks = Task::where('archived','LIKE','%'.$this->show_archived.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(15);
            } else {
                $tasks = Task::where('archived','LIKE','%'.$this->show_archived.'%')->where(function ($query) {
                        $query->orWhere('user_id', \Auth::user()->id);
                        $query->orWhere('author_id', \Auth::user()->id);
                        $query->orWhere('visibility', 'Público');
                    })
                    ->orderBy('created_at', 'DESC')
                    ->paginate(15);
            }
        }
        
        return view('livewire.tasks-component',['tasks' => $tasks]);
    }

    public function store()
    {
        $this->validate([
            'priority' => 'required',
            'context' => 'required',
            'deadline' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'status' => 'required',
            'visibility' => 'required',
        ],[
            'priority.required' => 'Campo obligatorio',
            'context.required' => 'Campo obligatorio',
            'deadline.required' => 'Campo obligatorio',
            'user_id.required' => 'Campo obligatorio',
            'title.required' => 'Campo obligatorio',
            'status.required' => 'Campo obligatorio',
            'visibility.required' => 'Campo obligatorio',
        ]);
        $task = Task::create([
            'priority' => $this->priority,
            'context' => $this->context,
            'deadline' => $this->deadline,
            'company_id' => $this->company_id,
            'sale_id' => $this->sale_id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'visibility' => $this->visibility,
        ]);
        $this->default();
        $this->emit('dismissCreateTask');
        $this->emit('successNotification','Tarea creada');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $this->task_id = $task->id;

        $this->user_id = $task->user_id;
        $this->company_id = $task->company_id;
        //$this->project_id = $task->project_id;
        $this->sale_id = $task->sale_id;
        $this->priority = $task->priority;
        $this->context = $task->context;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->deadline = $task->deadline;
        $this->status = $task->status;
        $this->visibility = $task->visibility;
        $this->archived = $task->archived;

        $this->emit('showEditTask');
    }

    public function update(){
        $this->validate([
            'priority' => 'required',
            'context' => 'required',
            'deadline' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'status' => 'required',
            'visibility' => 'required',
            'archived' => 'required'
        ],[
            'priority.required' => 'Campo obligatorio',
            'context.required' => 'Campo obligatorio',
            'deadline.required' => 'Campo obligatorio',
            'user_id.required' => 'Campo obligatorio',
            'title.required' => 'Campo obligatorio',
            'status.required' => 'Campo obligatorio',
            'visibility.required' => 'Campo obligatorio',
            'archived.required' => 'Campo obligatorio',
        ]);

        $task = Task::findOrFail($this->task_id);

        $task->user_id = $this->user_id;
        $task->company_id = $this->company_id;
        //$task->project_id = $this->project_id;
        $task->sale_id = $this->sale_id;
        $task->priority = $this->priority;
        $task->context = $this->context;
        $task->title = $this->title;
        $task->description = $this->description;
        $task->deadline = $this->deadline;
        $task->status = $this->status;
        $task->visibility = $this->visibility;
        $task->archived = $this->archived;

        $task->save();
        $this->default();
        $this->emit('dismissEditTask');
        $this->emit('successNotification','Tarea actualizada');

    }

    public function cambiarCliente(){
        if(strlen($this->company_id) > 0){
            $this->proyectos = \App\Sale::where('company_id',$this->company_id)->where('status','Proyecto')->get();
        }else{
            $this->proyectos = null;
        }
    }

    public function destroy($id){
        $task = Task::findOrFail($id);
        $task->delete();
        $this->emit('successNotification','Tarea eliminada');
    }

    public function default()
    {
        $this->task_id = null;
        $this->user_id = null;
        $this->company_id = null;
        $this->project_id = null;
        $this->sale_id = null;
        $this->priority = null;
        $this->context = null;
        $this->title = null;
        $this->description = null;
        $this->deadline = null;
        $this->status = null;
        $this->visibility = null;
        $this->archived = null;
    }
}
