<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Show extends Component
{
    public $message;
    public $searchTerm;
    public $categories;

    public $name, $category_id, $category;
    public $viewCategory = false;

    /**
     * Indicates if user deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingCategory;

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $this->categories = ProductCategory::where('name', 'like', $searchTerm)->get();

        return view('livewire.category.show');
    }

    public function viewCategory($id){

        $category = ProductCategory::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->viewCategory = true;

    }

    public function cancelUpdate(){

        return $this->resetForm();

    }

    public function resetForm(){

        $this->category_id = '';
        $this->name = '';
        $this->viewCategory = false;

    }

    public function update(){

        $validatedCategory = $this->validate([
            'category_id' => 'required|numeric',
            'name' => "required|string|unique:product_categories,name,$this->name,name",
        ]);

        $validatedCategory['created_by'] = Auth::user()->id;
        $validatedCategory['slug'] = Str::slug($validatedCategory['name'], '-');

        $category = ProductCategory::find($this->category_id);
        $category->update($validatedCategory);
  
        session()->flash('message', 'Product Category Updated Successfully.');
  
        $this->resetForm();

    }

    public function confirmDelete($id){
        $this->confirmingCategory = $id;
    }

    public function cancelDelete($id){
        $this->confirmingCategory = "";
    }

    public function deleteCategory($id){

        ProductCategory::find($id)->delete();

        session()->flash('message', 'Product Category Deleted Successfully.');
    }
}
