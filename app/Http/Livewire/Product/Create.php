<?php

namespace App\Http\Livewire\Product;

use App\Models\ProductCategory;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    use WithFileUploads;

    public $product_categories;
    public $name, $price, $product_id, $product_category_id;
    public $image;

    public function render()
    {
        $this->product_categories = ProductCategory::all();
        return view('livewire.product.create');
    }

    public function store()
    {
        $validatedProduct = $this->validate([
            'name' => "required|string|unique:products,name",
            'image' => "required|image|mimes:jpeg,png,jpg,gif,svg|max:10000",
            'price' => "required|numeric",
            'product_category_id' => "required|exists:product_categories,id"
        ]);

        $filename = $this->image->store('product-images', 'public');

        $validatedProduct['image'] = $filename;
        $validatedProduct['created_by'] = Auth::user()->id;

        Product::create($validatedProduct);
  
        session()->flash('message', 'Product Created Successfully.');
  
        $this->resetInputFields();
        return redirect()->to('/products');
    }

    private function resetInputFields(){
        $this->name = '';
        $this->price = '';
        $this->image = '';
    }
}
