<?php

namespace App\Livewire\Admin;

use App\Models\Category as ModelsCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Category extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name;
    public $description;
    public $thumbnail;
    public $edit_thumbnail;
    public $edit_category_id;
    public $button_text = "Create Categroy";

    public function add_new_category()
    {
        if($this->edit_thumbnail){
            $this->update($this->edit_category_id);
        }else{
            $this->validate([
                'name' => 'required|min:4|max:50',
                'description' => 'required',
                'thumbnail' => 'required|image',
            ]);

            ModelsCategory::create([
                'name' => $this->name,
                'description' => $this->description,
                'thumbnail' => $this->thumbnail->store('photos','public'),
            ]);


            $this->name="";
            $this->description="";
            $this->thumbnail="";


            session()->flash('message', 'Category Created successfully.');
        }
    }

    public function edit($id)
    {
        $category = ModelsCategory::findOrFail($id);
        $this->edit_category_id = $id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->edit_thumbnail    = $category->thumbnail;

        $this->button_text="Update";
    }

    public function update($id)
    {
        $this->validate([
            'name' => 'required|max:50',
            'description' => 'required',
        ]);
        $category = ModelsCategory::findOrFail($id);
        $category->name = $this->name;
        $category->description = $this->description;
        if ($this->thumbnail) {
            $this->validate([
                'thumbnail' => 'image',
            ]);
            if($category->thumbnail){
                Storage::delete('public/'.$category->thumbnail);
            }
            $category->thumbnail = $this->thumbnail->store('photos','public');
        }
        $category->save();

        $this->name="";
        $this->description="";
        $this->thumbnail="";
        $this->edit_category_id="";
        session()->flash('message', 'Cateogry Updated Successfully.');

        $this->button_text = "Update";

    }

    public function delete($id)
    {
        $category = ModelsCategory::findOrFail($id);
        if($category->thumbnail){
            Storage::delete('public/'.$category->thumbnail);
        }
        $category->delete();
        session()->flash('message', 'Category Deleted Successfully.');

        $this->name="";
        $this->description="";
        $this->thumbnail="";
    }

    public function render()
    {
        return view('livewire.admin.category',['categories' => ModelsCategory::latest()->paginate(10)])->layout('admin.layouts.wire_app');
    }
}
