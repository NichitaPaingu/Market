<x-layout>
    <x-slot:heading>
        {{$category->name}}
    </x-slot:heading>
    <div class="can-content">
        <div class="can-content-inner">
            <div class="can-head-products">
                @auth
                <a href="/dashboard" class="can-button">Личный кабинет</a>
                @endauth
                @guest
                <a href="/" class="can-button">На главную</a>
                @endguest
                <h1>{{$category->name}}</h1>
            </div>
            <div class="can-product-list">
                @foreach ($category->categoryTypes as $categoryType)
                <a href="#category-{{ $categoryType->id }}">{{$categoryType->name}}</a>
                @endforeach
            </div>
            @foreach ($category->categoryTypes as $categoryType)
                <div class="can-category-row">
                    <h2 class="can-section_title" id="category-{{ $categoryType->id }}" style="margin-right: 1">{{ $categoryType->name}} </h2>
                        @if(!$categoryType->products->isEmpty())
                            <div class="can-category_type">
                                <div class="can-product-list">
                                    @foreach ($categoryType->products as $product)
                                        <div class="can-product-card">
                                            <a href="/products/{{$product->id}}">
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
                                            </a>
                                            @auth
                                                @if(Auth::user()->is_admin)
                                                    <div class="can-product-actions">
                                                        <a class="can-button" href="/products/{{$product->id}}/edit">Изменить</a>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>                     
                        @else
                            <h3>У данного типа нет товаров</h3>
                        @endif
                </div>
            @endforeach
        </div>
    </div>
</x-layout>