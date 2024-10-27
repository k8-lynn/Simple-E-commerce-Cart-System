<?php

namespace App\Livewire;

use Livewire\Component;
use App\Helpers\Cart;

class CartComponent extends Component
{
    public $cartItems = [];
    public $totalPrice = 0;

    protected $listeners = ['quantityUpdated' => 'updateTotalPrice'];

    public function mount()
    {
        $cart = session('cart', new Cart());
        $this->cartItems = $cart->getItems();
        $this->calculateTotalPrice();
    }

    public function updateTotalPrice($productId, $quantity)
    {
        foreach ($this->cartItems as &$item) {
            if ($item['product']->id == $productId) {
                $item['quantity'] = $quantity;
            }
        }
        $this->calculateTotalPrice();
    }

    public function calculateTotalPrice()
    {
        $this->totalPrice = 0;
        foreach ($this->cartItems as $item) {
            $this->totalPrice += $item['product']->price * $item['quantity'];
        }
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
