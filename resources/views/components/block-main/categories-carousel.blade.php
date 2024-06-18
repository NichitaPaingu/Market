
@props(['categories'])

<div class="can-section">
    <div class="can-section_title">
        <h2>Музыкальные инструменты, звуковое и световое оборудование с доставкой</h2>
    </div>
    <div class="can-products">
        <div class="can-products_carousel2">
            @foreach ($categories as $category)
                <a href="/category/{{$category->id}}">
                    <div class="can-product-card-home width-height">
                        <div class="can-product-icon">
                            {!! $category->icon !!}
                        </div>
                        <div class="can-product-details ">
                            <h2 class="can-product-title">{{ $category->name }}</h2>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="can-products_arrows">
            <button id="category-prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button id="category-next"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </div>
</div>
