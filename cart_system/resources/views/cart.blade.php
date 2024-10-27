<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&display=swap" rel="stylesheet">
    @livewireStyles
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <a href="{{ route('welcome') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </a>
        <nav>
            <a href="{{ route('show-cart') }}" class="cart-link">
                <x-pixelarticons-cart class="cart-icon" /> Cart (<span>@livewire('cart-count')</span>)
            </a>
        </nav>
    </header>

    <div style="text-align: left; margin-left: 20px;">
        <a href="{{ route('welcome') }}" class="back-to-shop">← Back to Shop</a>
    </div>

    <h1 style="text-align: center;">Your Cart</h1>

    @if(empty($cartItems))
        <p style="text-align: center;">Your cart is empty.</p>
        <div class="cart-container">
            <a href="{{ route('welcome') }}" class="add-to-cart-button">Return to Shop</a>
        </div>
    @else
        <ul>
            @foreach($cartItems as $item)
                <li class="cart-item">
                    <div class="cart-item-container rounded-container"> <!-- Added class here -->
                        <!-- Product Image -->
                        <div class="product-image">
                            <img src="{{ asset('images/' . strtolower(str_replace(' ', '_', $item['product']->name)) . '.png') }}" alt="{{ $item['product']->name }}">
                        </div>
                        <div class="product-details">
                            <div class="product-title">{{ $item['product']->name }}</div>
                            <div class="product-quantity">
                                <!-- Form to update quantity -->
                                <form action="{{ route('update-quantity') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item['product']->id }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="quantity-input">
                                    <button type="submit" class="update-quantity-button">Update Quantity</button>
                                </form>
                            </div>
                            <div class="product-price">${{ number_format($item['product']->price * $item['quantity'], 2) }}</div>
                            <!-- Form to remove item from cart -->
                            <form action="{{ route('remove-from-cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item['product']->id }}">
                                <button type="submit" class="remove-button">Remove</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        <!-- Display subtotal, discounts, and total -->
        <div class="cart-summary" style="text-align: center; margin-top: 20px;">
            @php
                // Calculate subtotal
                $subtotal = 0;
                foreach ($cartItems as $item) {
                    $subtotal += $item['product']->price * $item['quantity'];
                }

                // Determine discount
                $discount = 0;
                if ($subtotal > 1000) {
                    $discount = 0.15; // 15% discount
                } elseif ($subtotal > 500) {
                    $discount = 0.10; // 10% discount
                }

                // Calculate discount amount and final total
                $discountAmount = $subtotal * $discount;
                $finalTotal = $subtotal - $discountAmount;
            @endphp

            <p class="{{ $discount > 0 ? 'strikethrough' : '' }}">Subtotal: ${{ number_format($subtotal, 2) }}</p>

            @if($discount > 0)
                <p>Discount Applied: {{ $discount * 100 }}%</p>
                <p>Your Total: ${{ number_format($finalTotal, 2) }}</p>
            @else
                <p>Discount Applied: None</p>
                <p>Your Total: ${{ number_format($subtotal, 2) }}</p>
            @endif
        </div>
    @endif

    @livewireScripts
</body>
</html>
