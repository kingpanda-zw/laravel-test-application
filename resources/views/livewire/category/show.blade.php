<div class="px-4 py-6">
    <h1 class="font-semibold text-xl tracking-tight"> List of all Product Categories
        <a href="{{ route('product-categories.create') }}"
            class="text-sm float-right bg-gray-900 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-900 rounded shadow inset-y-0.right-0">
            Add New Category
        </a>
    </h1>
    <br>
    <hr>

    @if (session()->has('message'))
        <div class="text-center py-4 lg:px-4">
            <div class="p-2 w-full bg-green-600 items-center text-green-100 leading-none lg:rounded-full flex lg:inline-flex"
                role="alert">
                <span class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3">Message</span>
                <span class="font-semibold mr-2 text-left flex-auto">{{ session('message') }}</span>
                <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
                </svg>
            </div>
        </div>
    @endif

    @if ($viewCategory)
        <form class="w-full max-w-xxl py-6" enctype="multipart/form-data">

            <input type="hidden" wire:model="category_id">
            <div class="md:flex md:items-center mb-10">
                <div class="md:w-2/12">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                        for="inline-category-name">
                        Category Name
                    </label>
                </div>
                <div class="md:w-3/12">
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-900"
                        id="inline-category-name" type="text" placeholder="Category" wire:model="name">
                    @error('name') <span class="text-red-500 py-2">{{ $message }}</span>@enderror
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
                        Update Category
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
                        id="inline-category-name" type="text" placeholder="Search Here..." wire:model="searchTerm">
                </div>
            </div>
        </div>


        <div wire:loading class="w-full h-full fixed block top-0 left-0 bg-white opacity-75 z-50">
            <span class="text-green-500 opacity-95 top-1/2 my-0 mx-auto block relative w-0 h-0" style="top: 50%;">
                <i class="fas fa-circle-notch fa-spin fa-5x"></i>
            </span>
        </div>
        <table class="table-auto" style="width: 100%;">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Category Name</th>
                    <th class="px-4 py-3 text-left">Slug</th>
                    <th class="px-4 py-3 text-left">Number of Products</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $category->name }}</td>
                        <td class="border px-4 py-2">{{ $category->slug }}</td>
                        <td class="border px-4 py-2">{{ $category->products->count() }}</td>
                        <td class="border px-4 py-2 text-center">
                            <div class="inline-flex">
                                @if ($confirmingCategory === $category->id)
                                    <div class="grid grid-rows-2">
                                        <span class="text-red font-bold py-1 px-4">
                                            Are you Sure?
                                        </span>
                                        <div>
                                            <button wire:click="deleteCategory({{ $category->id }})"
                                                wire:loading.attr="disabled"
                                                class="bg-green-600 hover:bg-green-500 text-white font-bold py-1 px-4 rounded-l">
                                                &#10003;
                                            </button>
                                            <button wire:click="cancelDelete({{ $category->id }})"
                                                wire:loading.attr="disabled"
                                                class="bg-black hover:bg-gray-900 text-white font-bold py-1 px-4 rounded-r">
                                                &#10005;
                                            </button>
                                        </div>
                                    </div>
                                    @else
                                        <button wire:click="viewCategory({{ $category->id }})"
                                            class="bg-gray-900 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded-l">
                                            Edit
                                        </button>
                                        <button wire:click="confirmDelete({{ $category->id }})"
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
