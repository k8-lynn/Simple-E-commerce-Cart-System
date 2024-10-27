<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
    
    <div class="scrolling-text-container">
        <div class="scrolling-text-inner" style="--marquee-speed: 35s; --direction: scroll-right" role="marquee">
            <div class="scrolling-text">
                <div class="scrolling-text-item">Sale 10% off above RM500</div>

                <div class="scrolling-text-item">Sale 15% off above RM1000</div>
                  
                <div class="scrolling-text-item">Sale 10% off above RM500</div>

                <div class="scrolling-text-item">Sale 15% off above RM1000</div>
  
                <div class="scrolling-text-item">Sale 10% off above RM500</div>

                <div class="scrolling-text-item">Sale 15% off above RM1000</div>
            </div>
        </div>
    </div>



    <!-- Shop Title Section -->
    <section class="shop-title">
        <div class="shop-title-container">
            <div class="shop-title-left">
                <img src="{{ asset('images/shop.png') }}" alt="Shop Logo">
            </div>
            <div class="shop-title-right">
                <img src="{{ asset('images/title_headphones.png') }}" alt="Headphones Image">
            </div>
            <div class="sparkle">
                <img src="{{ asset('images/sparkle.png') }}" alt="Sparkle">
            </div>
            <div class="spiral-container">
                <a href="#product-container" class="spiral">
                    <img src="{{ asset('images/spiral.png') }}" alt="Spiral">
                    <span class="hover-text">Click me</span>
                </a>
            </div>
        </div>
    </section>

    


    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <!-- Product Container Section with ID -->
    <section id="product-container" class="product-container">
        @foreach($products as $product)
            <div class="product-card">
                <div class="product-image">
                    <img 
                        src="{{ asset('images/' . strtolower(str_replace(' ', '_', $product->name)) . '.png') }}" 
                        alt="{{ $product->name }}"
                    >
                </div>
                <div class="product-info">
                    <h2 class="product-name">{{ $product->name }}</h2>
                    <p class="product-price">${{ number_format($product->price, 2) }}</p>
                    <div class="add-to-cart">
                        <livewire:add-to-cart :product="$product" />
                    </div>
                </div>
            </div>
        @endforeach
    </section>


    @livewireScripts
</body>
</html>
