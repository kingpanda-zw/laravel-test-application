<?php

namespace App\Http\Livewire\Order;

use App\Models\CustomerDepositPayment;
use Livewire\Component;

class DepositOrder extends Component
{

    public $message;
    public $searchTerm;

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $this->customer_orders = CustomerDepositPayment::where('customer_email', 'like', $searchTerm)->get();

        return view('livewire.order.deposit-order');
    }
}
