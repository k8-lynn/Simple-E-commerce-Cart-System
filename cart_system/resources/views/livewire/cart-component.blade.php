<div>
    @foreach($cartItems as $item)
        <div>{{ $item->name }} - {{ $item->price }}</div>
    @endforeach
    <div>Total: {{ $totalPrice }}</div>
</div>
