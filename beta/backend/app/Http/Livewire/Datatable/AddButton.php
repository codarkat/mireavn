<?php

namespace App\Http\Livewire\Datatable;

use Livewire\Component;

class AddButton extends Component
{
    public $name;
 
    public function mount($name)
    { 
        $this->name = $name;
    }


    public function setAddForm() {
        $this->dispatchBrowserEvent('openModal', ['action' => 'create']);
        $this->emit('setAddForm');
    }
    public function render()
    {
        return view('livewire.datatable.add-button', [
            'name' => $this->name,
        ]);
    }
}
