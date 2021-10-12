<div id="checkout1" class="modal p-2 py-10 sm:p-28" wire:ignore.self>
    <h1 class="font-bold text-center text-xl md:text-4xl p-5">Checkout</h1>
    {{-- <hr class="w-2/5 border-1 mt-3 mx-auto border-red-600"> --}}
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

    <form class="mt-5">
        <div class="mx-20">
            <div class="p-2">
                <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 border-0 rounded" type="email"
                    required="" placeholder="E-mail Address" wire:model="email">
                @error('email') <span class="text-red-500 py-2">{{ $message }}</span>@enderror
            </div>
        </div>
        {{-- <div class="mx-20">
            <div class="p-2">
                <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 border-0 rounded" type="text"
                    required="" placeholder="Name on Card" wire:model="name_on_card">
                @error('name_on_card') <span class="text-red-500 py-2">{{ $message }}</span>@enderror
            </div>
            <div class="p-2">
                <input class="w-full px-5 py-2 text-gray-700 bg-gray-200 border-0 rounded" type="text"
                    required="" placeholder="Card Number" wire:model="card_number">
                @error('card_number') <span class="text-red-500 py-2">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="mx-20 grid grid-cols-1 sm:grid-cols-3">
            <div class="p-2">
                <input class="w-full px-5 py-2 text-gray-100 bg-gray-700 border-0 rounded" type="text"
                    placeholder="Expiry Month (MM)" wire:model="expiry_month">
                @error('first_name') <span class="text-red-500 py-2">{{ $message }}</span>@enderror
            </div>
            <div class="p-2">
                <input class="w-full px-5 py-2 text-gray-100 bg-gray-700 border-0 rounded" type="text"
                    placeholder="Expiry Year (YY)" wire:model="expiry_year">
                @error('expiry_year') <span class="text-red-500 py-2">{{ $message }}</span>@enderror
            </div>
            <div class="p-2">
                <input class="w-full px-5 py-2 text-gray-100 bg-gray-700 border-0 rounded" type="text"
                    placeholder="CVV" wire:model="cvv">
                @error('cvv') <span class="text-red-500 py-2">{{ $message }}</span>@enderror
            </div>
        </div> --}}
        <div class="mt-5 mx-20">
            <div class="flex flex-col justify-center space-x-5 lg:flex-row pb-10 mt-8">

                <button type="button"
                    class="flex mx-auto mt-6 w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    wire:click.prevent="createSession()">
                    Proceed with Payment
                </button>
            </div>
        </div>
    </form>
</div>
