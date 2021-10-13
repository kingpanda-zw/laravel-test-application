<?php

namespace App\Http\Livewire\Product;

use App\Models\ProductCategory;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $product_categories;
    public $name, $price, $product_id, $description, $product_category_id;
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
            'description' => "required|string|max:200",
            'product_category_id' => "required|exists:product_categories,id"
        ]);

        $filename = $this->image->store('product-images', 's3');

        $validatedProduct['slug'] = Str::slug($validatedProduct['name'], '-');
        $validatedProduct['image'] = Storage::disk('s3')->url($filename);
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
        $this->description = '';
    }
}
