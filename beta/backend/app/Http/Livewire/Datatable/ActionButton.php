<?php

namespace App\Http\Livewire\Datatable;

use Livewire\Component;

class ActionButton extends Component
{
    public $model_id;
 
    public function mount($model_id)
    { 
        $this->model_id = $model_id;
    }

    public function action($modal_id, $action) {
        if($action == 'edit') {
            //Update
            $this->dispatchBrowserEvent('openModal', ['action' => 'update']);
            $this->emit('getCategoryData', $modal_id);
        } else {
            //Delete
            $this->dispatchBrowserEvent('openModal', ['action' => 'delete', 'id' => $modal_id]);
        }
    }

    public function render()
    {
        return view('livewire.datatable.action-button', [
            'model_id' => $this->model_id,
        ]);  
    }
}
