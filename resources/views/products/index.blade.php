<x-layout>
    <x-slot:heading>
        All the products
    </x-slot:heading>
    <x-succes message="{{session('succes')}}"></x-succes>
    <div class="can-content">
        <div class="can-content-inner">
            <div class="can-head-products">
                <span><a href="/dashboard" class="can-button">Личный кабинет</a></span>
                <span><h1>Product List</h1></span>
                <span><a href="/products/create" class="can-button-create">Создать продукт</a></span>
            </div>
            <div class="can-product-list">
                @foreach ($categories as $category)
                <a href="#category-{{ $category->id }}">{{$category->name}}</a>
                @endforeach
            </div>
            @foreach ($categories as $category)
                <div class="can-category-row">
                    <h2 class="can-section_title" id="category-{{ $category->id }}">{{ $category->name }}</h2>
                    @foreach ($category->categoryTypes as $categoryType)
                        <div class="can-category_type">
                            @if(!$categoryType->products->isEmpty())
                                <h3 class="can-category_type_title">{{ $categoryType->name }}</h3>
                            @endif
                            <div class="can-product-list">
                                @foreach ($categoryType->products as $product)
                                    <div class="can-product-card">
                                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="can-product-image">
                                        <div class="can-product-details">
                                            <h2 class="can-product-title">{{ $product->name }}</h2>
                                            <div class="can-product-description">
                                                <p>{{ $product->description }}</p>
                                            </div>
                                            <div class="can-product-card_price-deals">
                                                @if ($product->discount == null)
                                                    <span class="old_simple">{{ number_format($product->price, 0, '', ' ') }} лей</span>
                                                @else
                                                    <span class="current">{{ number_format($product->discounted_price, 0, '', ' ') }} лей</span>
                                                    <span class="old">{{ number_format($product->price, 0, '', ' ') }} лей</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="can-product-actions">
                                            <a class="can-button" href="/products/{{$product->id}}/edit">Изменить</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
