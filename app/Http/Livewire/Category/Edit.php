<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\ProductCategory;

class Edit extends Component
{

    public function mount($id)
    {
        $this->category = ProductCategory::find($id);
    }

    public function render()
    {
        return view('livewire.category.edit');
    }

}
