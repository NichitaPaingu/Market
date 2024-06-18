<x-layout>
    <x-slot:heading>
        Заказ #{{ $order->id }}
    </x-slot:heading>
    <x-succes message="{{session('succes')}}"></x-succes>
    <div class="can-order-content">
        <div class="can-order-content-inner">
            <div class="can-head-products">
                <a href="/dashboard" class="can-button">Личный кабинет</a>
                <h1>Заказ #{{ $order->id }}</h1>
                <h3>Статус: {{ $order->status }}</h3>
            </div>   
            <h1>Заказ #{{ $order->id }}</h1>
            <div class="can-cart-items">
                @foreach ($order->items as $item)
                    <div class="can-cart-item">
                        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="{{ $item->product->name }}" class="can-cart-item-image">
                        <div class="can-cart-item-details">
                            <h2>{{ $item->product->name }}</h2>
                            <p class="can-cart-item-price">{{ number_format($item->price, 0, '', ' ') }} лей</p>
                            <p>Количество: {{ $item->quantity }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="can-cart-total">
                <span>Итого: </span>
                <span class="can-cart-total-price">{{ number_format($order->total_price, 0, '', ' ') }} лей</span>
            </div>
        </div>
    </div>
</x-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.can-quantity-decrease').forEach(button => {
        button.addEventListener('click', function() {
            updateQuantity(this, -1);
        });
    });

    document.querySelectorAll('.can-quantity-increase').forEach(button => {
        button.addEventListener('click', function() {
            updateQuantity(this, 1);
        });
    });

    document.querySelectorAll('.can-button-remove').forEach(button => {
        button.addEventListener('click', function() {
            removeItem(this);
        });
    });

    function updateQuantity(button, change) {
        const cartItem = button.closest('.can-cart-item');
        const itemId = cartItem.dataset.itemId;
        const quantityInput = cartItem.querySelector('.can-cart-item-quantity-input');
        let newQuantity = parseInt(quantityInput.value) + change;

        if (newQuantity < 1) {
            newQuantity = 1;
        }

        // Update the quantity input value
        quantityInput.value = newQuantity;

        // Send AJAX request to update quantity in the backend
        fetch(`/cart/update/${itemId}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ quantity: newQuantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartTotal();
            }
        });
    }

    function removeItem(button) {
        const cartItem = button.closest('.can-cart-item');
        const itemId = cartItem.dataset.itemId;

        // Send AJAX request to remove item from the cart
        fetch(`/cart/remove/${itemId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                cartItem.remove();
                updateCartTotal();
            }
        });
    }

    function updateCartTotal() {
        fetch('/cart/total', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector('.can-cart-total-price').textContent = data.total + ' лей';
            }
        });
    }
});
</script>

</script>