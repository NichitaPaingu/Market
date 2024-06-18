<x-layout>
    <x-slot:heading>
        Оформление заказа
    </x-slot:heading>
    <div class="can-order-content">
        <div class="can-order-content-inner">
            <h1>Оформление заказа</h1>
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="can-order-summary">
                    <h2>Ваш заказ</h2>
                    <div class="can-cart-items">
                        @foreach ($cart->items as $item)
                            <div class="can-cart-item">
                                <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="{{ $item->product->name }}" class="can-cart-item-image">
                                <div class="can-cart-item-details">
                                    <h2>{{ $item->product->name }}</h2>
                                    <p class="can-cart-item-price">{{ number_format($item->product->discounted_price, 0, '', ' ') }} лей</p>
                                    <p>Количество: {{ $item->quantity }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="can-cart-total">
                        <span>Итого: </span>
                        <span class="can-cart-total-price">{{ number_format($cart->items->sum(function($item) { return $item->quantity * $item->product->discounted_price; }), 0, '', ' ') }} лей</span>
                    </div>
                </div>
                <button type="submit" class="can-button-checkout">Подтвердить заказ</button>
            </form>
        </div>
    </div>
</x-layout>