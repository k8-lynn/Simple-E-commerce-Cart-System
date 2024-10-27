<?php

namespace App\Livewire;

use Livewire\Component;
use App\Helpers\Product;
use App\Helpers\Cart;

class AddToCart extends Component
{
    public $product;
    public $quantity = 1;

    public function addToCart()
    {
        $cart = session()->get('cart', new Cart());
        $cart->addItem(new Product($this->product->id, $this->product->name, $this->product->price), $this->quantity);
        session(['cart' => $cart]);

        // Emit the 'cartUpdated' event
        $this->dispatch('cartUpdated');
        session()->flash('success', "{$this->product->name} added to cart successfully!");
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
