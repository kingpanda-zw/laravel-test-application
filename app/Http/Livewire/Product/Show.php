<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductCategory;

class Show extends Component
{
    use WithFileUploads;

    public $message;
    public $searchTerm;
    public $products;

    public $name, $price, $product_category_id, $product;
    public $image;
    public $viewProduct = false;


    public $confirmingProductDeletion = false;

    public function render()
    {

        $searchTerm = '%' . $this->searchTerm . '%';
        $this->products = Product::where('name', 'like', $searchTerm)->get();
        $this->product_categories = ProductCategory::all();

        return view('livewire.product.show');
    }


    public function viewProduct($id){

        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->image = $product->image;
        $this->product_category_id = $product->product_category->id;
        $this->viewProduct = true;

    }

    public function cancelUpdate(){

        return $this->resetForm();

    }

    public function confirmProductDeletion($id){

        $this->confirmingProductDeletion = true;
        $this->product_id = $id;

    }

    public function resetForm(){

        $this->product_id = '';
        $this->name = '';
        $this->price = '';
        $this->image = '';
        $this->product_category_id = '';
        $this->viewProduct = false;

    }

    public function update(){

        if(!is_string($this->image)){

            $validatedProduct = $this->validate([
                'product_category_id' => 'required|exists|product_categories,id',
                'product_id' => 'required|numeric',
                'name' => "required|string|unique:products,name,$this->name,name",
                'image' => "image|mimes:jpeg,png,jpg,gif,svg|max:10000",
                'price' => "required|numeric"
            ]);

            $filename = $this->image->store('product-images', 'public');
            $validatedProduct['image'] = $filename;

        }else{

            $validatedProduct = $this->validate([
                'product_category_id' => 'required|numeric',
                'name' => "required|string|unique:products,name,$this->name,name",
                'price' => "required|string"
            ]);

        }
        $validatedProduct['created_by'] = Auth::user()->id;

        $product = Product::find($this->product_id);
        $product->update($validatedProduct);
  
        session()->flash('message', 'Product Updated Successfully.');
  
        $this->resetForm();

    }

    public function delete(){

        Product::find($this->product_id)->delete();

        session()->flash('message', 'Product Deleted Successfully.');
    }

}
