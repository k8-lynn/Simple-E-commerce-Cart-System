<?php

namespace App\Livewire;

use Livewire\Component;
use App\Helpers\Cart;

class CartCount extends Component
{
    public $count = 0;

    protected $listeners = ['cartUpdated' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $cart = session('cart', new Cart());
        $this->count = $cart->getDistinctItemCount();
    }

    public function render()
    {
        return view('livewire.cart-count');
    }
}
