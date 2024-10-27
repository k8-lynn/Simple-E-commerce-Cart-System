<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Use Product model for database interaction
use App\Helpers\Cart; // Import Cart helper

class WelcomeController extends Controller
{
    public function welcome(Request $request)
    {
        // Fetch products from the MySQL database
        $products = Product::all();

        // Access or initialize the cart from session
        $cart = session()->get('cart', new Cart());

        // Calculate total price and apply discounts
        $total = $cart->getTotal();
        $discount = 0;

        if ($total > 1000) {
            $discount = 0.15 * $total;
        } elseif ($total > 500) {
            $discount = 0.10 * $total;
        }

        // Final total after applying discount
        $finalTotal = $total - $discount;

        // Pass the products and cart data to the view
        return view('welcome', compact('products', 'cart', 'total', 'discount', 'finalTotal'));
    }
}
