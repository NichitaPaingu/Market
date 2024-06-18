@props(['popularProducts'])

<div class="can-section">
    <div class="can-section_title">
        <h2>Популярные товары</h2>
    </div>
    <div class="can-products">
        <div class="can-products_carousel">
            @foreach ($popularProducts as $product)
                @if ($product->is_popular)
                <a href="/products/{{$product->id}}">  
                    <div class="can-product-card-home">
                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="can-product-image-home">
                        <div class="can-product-details">
                            <h2 class="can-product-title">{{ $product->name }}</h2>
                            <div class="can-product-card_price-deals">
                                @if ($product->discount == null)
                                    <span class="old_simple">{{ number_format($product->price, 0, '', ' ') }} лей</span>
                                @else
                                    <span class="current">{{ number_format($product->discounted_price, 0, '', ' ') }} лей</span>
                                    <span class="old">{{ number_format($product->price, 0, '', ' ') }} лей</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
                @endif
            @endforeach
        </div>
        <div class="can-products_arrows">
            <button id="product-prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button id="product-next"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </div>
</div>
