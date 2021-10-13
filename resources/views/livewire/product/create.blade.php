<div class="px-4 py-6">
    <h1 class="font-semibold text-xl tracking-tight"> Create A New Product
        <a href="{{ route('products.index') }}"
            class="text-sm float-right bg-gray-900 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-900 rounded shadow inset-y-0.right-0">
            &laquo; Back to Products
        </a>
    </h1>
    <br>
    <hr>
    <form class="w-full max-w-xxl py-6" enctype="multipart/form-data">

        <div class="md:flex md:items-center mb-10">
            <div class="md:w-2/12">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-product-name">
                    Product Name
                </label>
            </div>
            <div class="md:w-3/12">
                <input
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-900"
                    id="inline-product-name" type="text" placeholder="Product Name" wire:model="name">
                @error('name') <span class="text-red-500 py-2">{{ $message }}</span>@enderror
            </div>
            <div class="md:w-2/12">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-price">
                    Price
                </label>
            </div>
            <div class="w-3/12">
                <input
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-900"
                    id="inline-price" type="number" min="0" step="0.01" placeholder="Product Price" wire:model="price">
                @error('price') <span class="text-red-500 py-2">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="md:flex md:items-center mb-10">
            <div class="md:w-2/12">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-product-category-id">
                    Product Category
                </label>
            </div>
            <div class="w-3/12">
                <div class="w-full w-3/12">
                    <select wire:model="product_category_id"
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="inline-product-category-id">
                        <option> Select Product Category </option>
                        @foreach($product_categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                    @error('product_category_id') <span class="text-red-500 py-2">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
        <div class="md:flex md:items-center mb-10">
            <div class="md:w-2/12">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-product-name">
                    Product Description
                </label>
            </div>
            <div class="md:w-8/12">
                <textarea
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-900"
                    id="inline-product-name" type="text" placeholder="Product Description" wire:model="description" rows="5"></textarea>
                @error('description') <span class="text-red-500 py-2">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="md:flex md:items-center mb-10">
            <div class="md:w-2/12">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                    for="inline-product-image">
                    Product Image
                </label>
            </div>
            <div class="w-8/12">
                <input
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-900"
                    id="inline-product-image" type="file" placeholder="Product Image" wire:model="image">
                @error('image') <span class="text-red-500 pt-4">{{ $message }}</span>@enderror
            </div>
        </div>
{{-- 
        <div class="md:flex md:items-center mb-10">
            <div class="md:w-2/12">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                    for="inline-product-image">
                    Image Preview
                </label>
            </div>
            
             @if ($image)
            <div class="w-8/12">
                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="{{ $image->temporaryUrl() }}" alt="{{ $name}}">
                </div>
            </div>
            @endif
    
        </div> --}}

        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">
            <!-- Progress Bar -->
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>

        <hr>
        <br>
        <div class="md:flex md:items-center">
            <div class="md:w-2/12"></div>
            <div class="md:w-8/12">
                <button
                    class="shadow bg-gray-900 hover:bg-gray-700 text-white focus:outline-none text-white font-bold py-2 px-4 rounded"
                    type="button" wire:click.prevent="store()">
                    Create Product
                </button>
            </div>
        </div>
    </form>
</div>