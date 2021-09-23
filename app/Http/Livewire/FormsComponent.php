<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Form;

class FormsComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];

    public $self_component = "forms";
    public $search = "";

    //properties
    public 
        $form_id,
        $name,
        $description,
        $document;

    public function render()
    {
        if(strlen($this->search) > 0)
        {
            $forms = Form::where('name','LIKE','%'.$this->search.'%')->orderBy('name')->paginate('10');
        }else{
            $forms = Form::orderBy('name')->paginate('10');
        }

        return view('livewire.forms-component',['forms' => $forms]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'document' => 'required'
        ],[
            'name.required' => 'Campo obligatorio',
            'document.required' => 'Campo obligatorio'
        ]);
        $form = Form::create([
            'name' => $this->name,
            'description' => $this->description
        ]);
        
        if (!empty($this->document)) {
            $docName = "[".$form->id."]_".str_replace(' ','_',$this->document->getClientOriginalName());
            $this->document->storeAs('forms', $docName);
            $form->document = $docName;
            $form->save();
            $this->default();
            $this->emit('dissmisCreateForm');
            $this->emit('successNotification','Machote almacenado');
        }
    }

    public function edit($id)
    {
        $form = Form::find($id);
        $this->form_id = $form->id;
        $this->name = $form->name;
        $this->description = $form->description;
        $this->document = $form->document;
        $this->emit('showEditForm');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Campo obligatorio',
        ]);

        $form = Form::find($this->form_id);
        $form->name = $this->name;
        $form->description = $this->description;
        $form->save();
        $this->default();
        $this->emit('dismissEditForm');
        $this->emit('successNotification','Machote actualizado');
    }

    public function destroy($id) {
        $form = Form::find($id);
        $test = \Storage::delete('forms/'.$form->name);
        $form->delete();
        $this->emit('successNotification','Machote eliminado '.$test);
    }

    public function default()
    {
        $this->name = null;
        $this->description = null;
        $this->document = null;
    }
}
