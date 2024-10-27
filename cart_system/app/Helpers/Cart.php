<?php
//cart class
namespace App\Helpers;

class Cart
{
    private $items = [];

    // Add item to the cart
    public function addItem(Product $product, int $quantity)
    {
        $productId = $product->id;

        // If the product is already in the cart, increase the quantity
        if (isset($this->items[$productId])) {
            $this->items[$productId]['quantity'] += $quantity;
        } else {
            // Otherwise, add the product to the cart
            $this->items[$productId] = ['product' => $product, 'quantity' => $quantity];
        }
    }

    // Remove item from the cart
    public function removeItem(int $productId)
    {
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
        }
    }

    // Update quantity (increase or decrease)
    public function updateQuantity(int $productId, int $newQuantity)
    {
        if (isset($this->items[$productId])) {
            // If the new quantity is less than 1, remove the item from the cart
            if ($newQuantity < 1) {
                $this->removeItem($productId);
            } else {
                $this->items[$productId]['quantity'] = $newQuantity;
            }
        }
    }

    // Get all items in the cart
    public function getItems()
    {
        return $this->items;
    }

    // Get distinct item count
    public function getDistinctItemCount()
    {
        return count($this->items);
    }

    // Get total price with discount applied
    public function getTotal()
    {
        $total = array_reduce($this->items, function ($total, $item) {
            return $total + ($item['product']->price * $item['quantity']);
        }, 0);

        // Apply discounts
        if ($total > 1000) {
            $total *= 0.85; // Apply 15% discount
        } elseif ($total > 500) {
            $total *= 0.90; // Apply 10% discount
        }

        return $total;
    }
}
