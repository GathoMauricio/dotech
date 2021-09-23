<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Document;

class DocumentsComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['destroy' => 'destroy'];

    public $self_component = "documents";
    public $search = "";

    //properties
    public 
        $document_id,
        $name,
        $description,
        $visibility,
        $document;

    public function render()
    {
        if(strlen($this->search) > 0)
        {
            if(\Auth::user()->rol_user_id == 1)
            {
                $documents = Document::where('name','LIKE','%'.$this->search.'%')
                ->orderBy('name')->paginate('10');
            }else{
                $documents = Document::where('name','LIKE','%'.$this->search.'%')
                ->where(function($q){
                    $q->where('author_id',\Auth::user()->id);
                    $q->orWhere('visibility', 'publico');
                })->orderBy('name')->paginate('10');
            }
        }else{
            if(\Auth::user()->rol_user_id == 1)
            {
                $documents = Document::orderBy('name')->paginate('10');
            }else{
                $documents = Document::where(function($q){
                    $q->where('author_id',\Auth::user()->id);
                    $q->orWhere('visibility', 'publico');
                })->orderBy('name')->paginate('10');
            }
        }
        

        return view('livewire.documents-component',['documents' => $documents]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'visibility' => 'required',
            'document' => 'required'
        ],[
            'name.required' => 'Campo obligatorio',
            'visibility.required' => 'Campo obligatorio',
            'document.required' => 'Campo obligatorio'
        ]);
        $doc = Document::create([
            'name' => $this->name,
            'description' => $this->description,
            'visibility' => $this->visibility,
        ]);
        
        if (!empty($this->document)) {
            $docName = "[".$doc->id."]_".str_replace(' ','_',$this->document->getClientOriginalName());
            $this->document->storeAs('documents', $docName);
            $doc->document = $docName;
            $doc->save();
            $this->default();
            $this->emit('dissmisCreateDocument');
            $this->emit('successNotification','Documento almacenado');
        }
    }

    public function edit($id)
    {
        $doc = Document::find($id);
        $this->document_id = $doc->id;
        $this->name = $doc->name;
        $this->description = $doc->description;
        $this->visibility = $doc->visibility;
        $this->document = $doc->document;
        $this->emit('showEditDocument');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'visibility' => 'required'
        ],[
            'name.required' => 'Campo obligatorio',
            'visibility.required' => 'Campo obligatorio'
        ]);

        $doc = Document::find($this->document_id);
        $doc->name = $this->name;
        $doc->description = $this->description;
        $doc->visibility = $this->visibility;
        $doc->save();
        $this->default();
        $this->emit('dismissEditDocument');
        $this->emit('successNotification','Documento actualizado');
    }

    public function destroy($id) {
        $doc = Document::find($id);
        $test = \Storage::delete('documents/'.$doc->name);
        $doc->delete();
        $this->emit('successNotification','Documento eliminado '.$test);
    }

    public function default()
    {
        $this->name = null;
        $this->description = null;
        $this->visibility = null;
        $this->document = null;
    }
}
