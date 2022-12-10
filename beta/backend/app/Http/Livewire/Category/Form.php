<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Validation\Rule;

class Form extends Component
{
    public $name, $description, $category_id;
    public $titleModal = 'Add Category';
    protected $listeners = [
        'getCategoryData',
        'deleteCategory',
        'setAddForm'
    ];
    
    public function save()
    {
        $this->validate([
            'name' => [
                'required',
                Rule::unique('categories')->ignore($this->category_id),
            ],
            'description' => 'required',
        ], [
            'name.unique' => 'The name has already been taken',
            'name.required' => 'The name is required',
            'description.required' => 'The description is required',
        ]);
        

        $data = [
            'name' => $this->name,
            'description' => $this->description
        ];

        if($this->category_id) {
            $category = Category::find($this->category_id)->update($data);
            $this->dispatchBrowserEvent('closeModal');
        } else {
            $category = Category::create($data);
            $this->dispatchBrowserEvent('closeModal');
        }

        
        $this->dispatchBrowserEvent('refreshTable');
        $this->cleanVars();

        // $category->name = $this->name;
        // $category->description = $this->description;
        // $save = $category->save();
        // if($save) {
        //     $this->showToast('success', 'New category has been added!');
        //     $this->dispatchBrowserEvent('hide_modal_add_category');
        // } else {
        //     $this->showToast('error', 'Something went wrong!');
        // }

    }

    public function setAddForm(){
        $this->titleModal = 'Add Category';
        $this->name = null;
        $this->description = null;
        $this->category_id = null;
    }

    public function cleanVars(){
        $this->name = null;
        $this->description = null;
        $this->category_id = null;
    }

    public function deleteCategory($category_id){
        Category::destroy($category_id);
        $this->dispatchBrowserEvent('refreshTable');
    }


    public function getCategoryData($category_id){
        $this->titleModal = 'Update Category';
        $category_data = Category::find($category_id);
        $this->name = $category_data->name;
        $this->description = $category_data->description;
        $this->category_id = $category_id;
    }

    public function showToast($type, $message){
        return $this->dispatchBrowserEvent('showToast', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function render()
    {
        return view('livewire.category.form');
    }
}
