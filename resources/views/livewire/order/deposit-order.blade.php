<div class="px-4 py-6">
    <h1 class="font-semibold text-xl tracking-tight"> List of all Customer Deposit Orders
    </h1>
    <br>
    <hr>

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
                <th class="px-4 py-3 text-left">Customer Email</th>
                <th class="px-4 py-3 text-left">Product</th>
                <th class="px-4 py-3 text-left">Price</th>
                <th class="px-4 py-3 text-left">Deposit</th>
                <th class="px-4 py-3 text-left">Balance</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Email Sent</th>
                <th class="px-4 py-3 text-left">Date Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customer_orders as $order)
            <tr>
                <td class="border px-4 py-2">{{ $loop->index + 1}}</td>
                <td class="border px-4 py-2">{{ $order->customer_email }}</td>
                <td class="border px-4 py-2">{{ $order->product->name }}</td>
                <td class="border px-4 py-2">{{ $order->product->price }}</td>
                <td class="border px-4 py-2">{{ $order->deposit }}</td>
                <td class="border px-4 py-2">{{ $order->balance }}</td>
                <td class="border px-4 py-2">{{ $order->status }}</td>
                <td class="border px-4 py-2">{{ $order->email_sent ? 'Yes': 'No' }}</td>
                <td class="border px-4 py-2">{{ date('d-m-Y h:i A', strtotime($order->created_at)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
