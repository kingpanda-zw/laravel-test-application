<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $name;

    public function render()
    {
        return view('livewire.category.create');
    }

    public function store()
    {
        $validatedCategory = $this->validate([
            'name' => "required|string|unique:product_categories,name",
        ]);

        $validatedCategory['created_by'] = Auth::user()->id;

        ProductCategory::create($validatedCategory);
  
        session()->flash('message', 'Product Category Created Successfully.');
  
        $this->resetInputFields();
        return redirect()->to('/product-categories');
    }

    private function resetInputFields(){
        $this->name = '';
    }

}
