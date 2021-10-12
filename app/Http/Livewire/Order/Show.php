<?php

namespace App\Http\Livewire\Order;

use App\Models\CustomerOrder;
use Livewire\Component;

class Show extends Component
{
    public $message;
    public $searchTerm;

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $this->customer_orders = CustomerOrder::where('customer_email', 'like', $searchTerm)->get();

        return view('livewire.order.show');
    }
}
