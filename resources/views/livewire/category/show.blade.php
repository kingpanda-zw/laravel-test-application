<div class="px-4 py-6">
    <h1 class="font-semibold text-xl tracking-tight"> List of all Product Categories
        <a href="{{ route('product-categories.create') }}"
            class="bg-white text-sm float-right bg-gray-900 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-900 rounded shadow inset-y-0.right-0">
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
            Loading...
        </div>
        <table class="table-auto" style="width: 100%;">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Category Name</th>
                    <th class="px-4 py-3 text-left">Number of Products</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $category->name }}</td>
                        <td class="border px-4 py-2">{{ $category->products->count() }}</td>
                        <td class="border px-4 py-2 text-center">
                            <div class="inline-flex">
                                <button wire:click="viewCategory({{ $category->id }})"
                                    class="bg-gray-900 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded-l">
                                    View
                                </button>
                                <button wire:click="confirmCategoryDeletion" wire:loading.attr="disabled"
                                    class="bg-red-600 hover:bg-red-500 text-white font-bold py-1 px-4 rounded-r">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>

@if ($confirmingCategoryDeletion)
    <div class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!--
            Background overlay, show/hide based on modal state.
    
            Entering: "ease-out duration-300"
            From: "opacity-0"
            To: "opacity-100"
            Leaving: "ease-in duration-200"
            From: "opacity-100"
            To: "opacity-0"
        -->
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <!--
            Modal panel, show/hide based on modal state.
    
            Entering: "ease-out duration-300"
            From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            To: "opacity-100 translate-y-0 sm:scale-100"
            Leaving: "ease-in duration-200"
            From: "opacity-100 translate-y-0 sm:scale-100"
            To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Heroicon name: exclamation -->
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                Delete Category
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm leading-5 text-gray-500">
                                    Are you sure you want to delete this Product Category? All of your data will be
                                    permanently
                                    removed. This action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button type="button" wire:click="$toggle('confirmingCategoryDeletion')"
                            wire:loading.attr="disabled"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Continue, Delete
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Cancel
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endif
