<x-layout>
    <x-slot:heading>
        Избранное
    </x-slot:heading>
    <div class="can-favorites-content">
        <div class="can-favorites-content-inner">
            <div class="can-head-products">
                <h1>Избранные товары</h1>
                <a href="/" class="can-button">На главную</a>
            </div>
            @if($favorites->count() > 0)
                <div class="can-favorites-items">
                    @foreach ($favorites as $product)
                        <div class="can-favorites-item">
                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="can-favorites-item-image">
                            <div class="can-favorites-item-details">
                                <div class="can-head-products width360">
                                    <h2>{{ $product->name }}</h2>
                                    <a href="/products/{{$product->id}}" class="can-button">Посмотреть продукт</a>
                                </div>
                                <p>{{ number_format($product->discounted_price ?? $product->price, 0, '', ' ') }} лей</p>
                                <button class="favorite-button" data-product-id="{{ $product->id }}" data-action="remove">Удалить из избранного</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Нет избранных товаров.</p>
            @endif
            <x-popular-products :popularProducts="$popularProducts"></x-popular-products>
        </div>
    </div>
</x-layout>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.favorite-button').forEach(button => {
        button.addEventListener('click', function() {
            let productId = this.dataset.productId;
            let action = this.dataset.action;
            let url = `/favorites/${productId}`;
            let method = action === 'remove' ? 'DELETE' : 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
              .then(data => {
                if (data.status === 'removed') {
                    button.closest('.can-favorites-item').remove();
                } else if (data.status === 'added') {
                    button.textContent = 'Добавлено';
                    button.dataset.action = 'remove';
                }
            });
        });
    });
});
</script>