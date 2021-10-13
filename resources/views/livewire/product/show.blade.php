<div class="px-4 py-6">
    <h1 class="font-semibold text-xl tracking-tight"> List of all Products
        <a href="{{ route('products.create') }}"
            class="text-sm float-right bg-gray-900 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-900 rounded shadow inset-y-0.right-0">
            Add New Product
        </a>
    </h1>
    <br>
    <hr>

    @if($viewProduct)
    <form class="w-full max-w-xxl py-6">

        <input type="hidden" wire:model="product_id">
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
                    id="inline-price" type="text" placeholder="Product Price" wire:model="price">
                @error('price') <span class="text-red-500 py-2">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="md:flex md:items-center mb-10">
            <div class="md:w-2/12">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-product-category-id">
                    Select Product Category
                </label>
            </div>
            <div class="w-4/12">
                <div class="w-full w-3/12">
                    <select wire:model="product_category_id"
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="inline-product_category_id-id">
                        <option> Select Product Category </option>
                        @foreach($product_categories as $category)
                            <option @if($product_category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
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

        @if ($image)
        <div class="md:flex md:items-center mb-10">
            <div class="md:w-2/12">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                    for="inline-product-image">
                    Image Preview
                </label>
            </div>
            <div class="w-8/12">
                @if(!is_string($image))
                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="{{ $image->temporaryUrl() }}" alt="{{ $name}}">
                </div>
                @else
                <div class="max-w-sm rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="{{ 'storage/'.$image }}" alt="{{ $name}}">
                </div>
                @endif
            </div>
        </div>
        @endif


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
                    class="shadow hover:bg-gray-900 text-gray-900 font-semibold hover:text-white py-2 px-4 border border-gray-900 hover:border-transparent rounded"
                    type="button" wire:click.prevent="cancelUpdate()">
                    Cancel
                </button>
                <button
                    class="shadow bg-gray-900 hover:bg-gray-700 text-white focus:outline-none text-white font-bold py-2 px-4 rounded"
                    type="button" wire:click.prevent="update()">
                    Update Product
                </button>
            </div>
        </div>
    </form>
    @else
    <div class="w-full max-w-xxl py-6">
        <div class="md:flex md:items-center">
            <div class="md:w-6/12">
                <input
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-900"
                    id="inline-product-name" type="text" placeholder="Search Here..." wire:model="searchTerm">
            </div>
        </div>
        <div wire:loading class="w-full h-full fixed block top-0 left-0 bg-white opacity-75 z-50">
            <span class="text-green-500 opacity-95 top-1/2 my-0 mx-auto block relative w-0 h-0" style="top: 50%;">
                <i class="fas fa-circle-notch fa-spin fa-5x"></i>
            </span>
        </div>
    </div>
    <table class="table-auto" style="width: 100%;">
        <thead>
            <tr>
                <th class="px-4 py-3 text-left">ID</th>
                <th class="px-4 py-3 text-left">Image</th>
                <th class="px-4 py-3 text-left">Product Name</th>
                <th class="px-4 py-3 text-left">Slug</th>
                <th class="px-4 py-3 text-left">Price</th>
                <th class="px-4 py-3 text-left">Product Category</th>
                <th class="px-4 py-3 text-left">Date Created</th>
                <th class="px-4 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td class="border px-4 py-2">{{ $loop->index + 1}}</td>
                <td class="border px-4 py-2">
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}"
                            class="rounded-full h-10 w-10 object-cover">
                    </div>
                </td>
                <td class="border px-4 py-2">{{ $product->name }}</td>
                <td class="border px-4 py-2">{{ $product->slug }}</td>
                <td class="border px-4 py-2">{{ $product->price }}</td>
                <td class="border px-4 py-2">{{ $product->product_category->name }}</td>
                <td class="border px-4 py-2">{{ date('d-m-Y h:i A', strtotime($product->created_at)) }}</td>
                <td class="border px-4 py-2 text-center">
                    <div class="inline-flex">
                        @if ($confirmingProduct === $product->id)
                            <div class="grid grid-rows-2">
                                <span class="text-red font-bold py-1 px-4">
                                    Are you Sure?
                                </span>
                                <div>
                                    <button wire:click="deleteProduct({{ $product->id }})"
                                        wire:loading.attr="disabled"
                                        class="bg-green-600 hover:bg-green-500 text-white font-bold py-1 px-4 rounded-l">
                                        &#10003;
                                    </button>
                                    <button wire:click="cancelDelete({{ $product->id }})"
                                        wire:loading.attr="disabled"
                                        class="bg-black hover:bg-gray-900 text-white font-bold py-1 px-4 rounded-r">
                                        &#10005;
                                    </button>
                                </div>
                            </div>
                            @else
                                <button wire:click="viewProduct({{ $product->id }})"
                                    class="bg-gray-900 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded-l">
                                    Edit
                                </button>
                                <button wire:click="confirmDelete({{ $product->id }})"
                                    wire:loading.attr="disabled"
                                    class="bg-red-600 hover:bg-red-500 text-white font-bold py-1 px-4 rounded-r">
                                    Delete
                                </button>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

</div>
