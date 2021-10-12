<div class="px-4 py-6">
    <h1 class="font-semibold text-xl tracking-tight"> Create A New Category
        <a href="{{ route('product-categories.index') }}"
            class="text-sm float-right bg-gray-900 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-900 rounded shadow inset-y-0.right-0">
            &laquo; Back to Categories
        </a>
    </h1>
    <br>
    <hr>
    <form class="w-full max-w-xxl py-6">

        <div class="md:flex md:items-center mb-10">
            <div class="md:w-2/12">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-category-name">
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
                    class="shadow bg-gray-900 hover:bg-gray-700 text-white focus:outline-none text-white font-bold py-2 px-4 rounded"
                    type="button" wire:click.prevent="store()">
                    Create Category
                </button>
            </div>
        </div>
    </form>
</div>