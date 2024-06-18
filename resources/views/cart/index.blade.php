<x-layout>
    <x-slot:heading>
        Моя корзина
    </x-slot:heading>
    <div class="can-cart-content">
        <div class="can-cart-content-inner">
            <div class="can-head-products">
                <h1>Моя корзина</h1>
                <a href="/dashboard" class="can-button">Личный кабинет</a>
            </div>
            @if($cart && $cart->items->count() > 0)
                <div class="can-cart-summary">
                    <div class="can-cart-items">
                        @foreach ($cart->items as $item)
                            <div class="can-cart-item" data-item-id="{{ $item->id }}" data-stock="{{ $item->product->stock }}">
                                <a href="/products/{{$item->product->id}}">
                                    <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="{{ $item->product->name }}" class="can-cart-item-image">
                                </a>
                                <div class="can-cart-item-details">
                                    <div class="can-head-products width360">
                                        <h2>{{ $item->product->name }}</h2>
                                        <a href="/products/{{$item->product->id}}" class="can-button">Посмотреть продукт</a>
                                    </div>
                                    <div class="can-product-card_price-deals-show">
                                        @if ($item->product->discount == null)
                                            <span class="old_simple">Цена: {{ number_format($item->product->price, 0, '', ' ') }} лей</span>
                                        @else
                                            <span class="current-show">Цена со скидкой: {{ number_format($item->product->discounted_price, 0, '', ' ') }} лей</span>
                                            <span class="old-show">Старая цена: {{ number_format($item->product->price, 0, '', ' ') }} лей</span>
                                        @endif
                                    </div>
                                    <div class="can-cart-item-quantity">
                                        <h2>Количество:</h2>
                                        <div class="width360">
                                        <button class="can-quantity-decrease">-</button>
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{$item->product->stock}}" class="can-cart-item-quantity-input">
                                        <button class="can-quantity-increase">+</button>
                                        </div>
                                    </div>
                                    <button class="can-button-remove">Удалить</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="can-cart-total">
                        <span>Итого: </span>
                        <span class="can-cart-total-price">{{ number_format($cart->items->sum(function($item) { return $item->quantity * ($item->product->discounted_price ?? $item->product->price); }), 0, '', ' ') }} лей</span>
                    </div>
                    <a href="{{ route('order.create') }}" class="can-button-checkout">Оформить заказ</a>
                </div>
            @else
                <p>Ваша корзина пуста.</p>
            @endif
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
            const stock = parseInt(cartItem.dataset.stock);
            let newQuantity = parseInt(quantityInput.value) + change;

            if (newQuantity < 1) {
                newQuantity = 1;
            } else if (newQuantity > stock) {
                newQuantity = stock;
                alert('Извините, нельзя заказать больше, чем есть на складе.');
            }

            quantityInput.value = newQuantity;

            fetch(`/cart/update/${itemId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartTotal();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function removeItem(button) {
            const cartItem = button.closest('.can-cart-item');
            const itemId = cartItem.dataset.itemId;

            fetch(`/cart/remove/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    cartItem.remove();
                    updateCartTotal();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function updateCartTotal() {
            fetch('/cart/total', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector('.can-cart-total-price').textContent = data.total + ' лей';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
</script>
