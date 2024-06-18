@props(['dealsProducts'])

<div class="can-section">
    <div class="can-section_title">
        <h2>Лучшие цены</h2>
    </div>
    <div class="can-big-deals">
        <div class="can-big-deals_col">
            @if(isset($dealsProducts[0]))
            <a href="/products/{{ $dealsProducts[0]->id }}" class="can-big-deals-card-link">
                <div class="can-big-deals-card">
                    <div class="can-big-deals-card_image">
                        <img src="{{ asset('storage/' . $dealsProducts[0]->images->first()->image_path) }}" alt="{{ $dealsProducts[0]->name }}">
                    </div>
                    <div class="can-big-deals-card_title">{{ $dealsProducts[0]->name }}</div>
                    <div class="can-big-deals-card_price">
                        <span class="current">{{ number_format($dealsProducts[0]->discounted_price, 0, '', ' ') }} лей</span>
                        @if ($dealsProducts[0]->discount)
                            <span class="old">{{ number_format($dealsProducts[0]->price, 0, '', ' ') }} лей</span>
                        @endif
                    </div>
                </div>
                </a>
            @endif
        </div>
        <div class="can-big-deals_col can-big-deals_col_cards">
            <div class="can-product-grid">
                @foreach($dealsProducts->slice(1) as $product)
                    <div class="can-product-card-deals">
                        <a href="/products/{{ $product->id }}" class="can-product-card-deals-link">
                        <div class="can-product-card_main-content">
                            <div class="can-product-card_image-deals">
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}">
                            </div>
                            <h5 class="can-product-card_title-deals">{{ $product->name }}</h5>
                            <div class="can-product-card_price-deals">
                                @if ($product->discount == null)
                                    <span class="old_simple">{{ number_format($product->price, 0, '', ' ') }} лей</span>
                                @else
                                    <span class="current">{{ number_format($product->discounted_price, 0, '', ' ') }} лей</span>
                                    <span class="old">{{ number_format($product->price, 0, '', ' ') }} лей</span>
                                @endif
                            </div>
                            
                        </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
