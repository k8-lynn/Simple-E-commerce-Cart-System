<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Product;
use App\Helpers\Cart;

class CartController extends Controller
{
    // add product to cart
    public function addToCart(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $price = $request->input('price');
        $quantity = $request->input('quantity', 1);

        $product = new Product($id, $name, $price);
        $cart = session()->get('cart', new Cart());
        $cart->addItem($product, $quantity);
        session(['cart' => $cart]);

        return redirect()->route('welcome')->with('success', "$name added to cart successfully!");
    }

    //remove product from cart
    public function removeFromCart(Request $request)
    {
        $productId = $request->input('id');
        $cart = session()->get('cart', new Cart());
        $cart->removeItem($productId);
        session(['cart' => $cart]);

        return redirect()->route('show-cart')->with('success', "Item removed from cart successfully!");
    }

    //update product quantity
    public function updateQuantity(Request $request)
    {
        $productId = $request->input('id');
        $newQuantity = $request->input('quantity');
        $cart = session()->get('cart', new Cart());
        $cart->updateQuantity($productId, $newQuantity);
        session(['cart' => $cart]);

        return redirect()->route('show-cart')->with('success', "Quantity updated successfully!");
    }

    //display cart total price
    public function showCart()
    {
        $cart = session('cart', new Cart());
        $totalPrice = $cart->getTotal();

        return view('cart', [
            'cartItems' => $cart->getItems(),
            'totalPrice' => $totalPrice
        ]);
    }
}
