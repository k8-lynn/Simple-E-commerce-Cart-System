<div>
    <div class="add-to-cart">
        <input type="number" wire:model="quantity" min="1" value="1" class="quantity-input">
        <button class="add-to-cart-button" wire:click="addToCart">Add to Cart</button>
    </div>

    <style>
        .add-to-cart {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            margin-top: 10px;
        }

        .quantity-input {
            width: 50px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        .add-to-cart-button {
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family: 'Fira Code', monospace;
        }

        .add-to-cart-button:hover {
            background-color: #333;
        }
    </style>
</div>
