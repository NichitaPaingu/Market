<x-layout>
    <x-slot:heading>
        {{$product->name}}
    </x-slot:heading>
    <div class="can-content-product">
        <div class="can-content_inner-product">
            <div class="can-product-details-container">
                <div class="can-product-images">
                    <img id="mainProductImage" src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="can-product-image-main">
                    <div class="can-product-thumbnail-container">
                        @foreach ($product->images as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" class="can-product-thumbnail" onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}')">
                        @endforeach
                    </div>
                </div>
                <div class="can-product-info">
                    <h1>Название товара: {{ $product->name }}</h1>
                    <div class="can-product-card_price-deals-show" style="margin-right: auto;">
                        @if ($product->discount == null)
                            <span class="old_simple">Стоимость: {{ number_format($product->price, 0, '', ' ') }} лей</span>
                        @else
                            <span class="current-show">Цена со скидкой: {{ number_format($product->discounted_price, 0, '', ' ') }} лей</span>
                            <span class="old-show">Старая цена: {{ number_format($product->price, 0, '', ' ') }} лей</span>
                        @endif
                    </div>
                    <div class="can-head-products actions">
                        @auth
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="can-add-to-cart">В корзину</button>
                            </form>
                            <button type="button" class="can-add-to-favorite" id="favorite-button" data-product-id="{{ $product->id }}">В Избранное</button>
                        @endauth
                        @guest
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="can-add-to-cart">В корзину</button>
                            </form>
                        @endguest
                        <a href="/" class="can-button">На главную</a>
                    </div>
                    <div class="can-product-additional-info">
                        <p>Остаток на складе: {{ $product->stock }} шт.</p>
                        <p>Код товара: P{{ $product->id }}</p>
                    </div>
                    <div class="can-product-brand">
                        <p>Категория товара: {{ $product->categoryType->category->name }}</p>
                    </div>
                </div>
            </div>
            <div class="can-product-tabs">
                <button class="tab-button active" onclick="openTab(event, 'description')">Описание</button>
                <button class="tab-button" onclick="openTab(event, 'reviews')">Отзывы</button>
            </div>
            <div id="description" class="tab-content" style="display: block;">
                <h2>Описание товара</h2>
                <p>{{ $product->description }}</p>
            </div>
            <div id="reviews" class="tab-content">
                <h2>Отзывы</h2>
                @if($product->reviews->isEmpty())
                    <p>Нет отзывов</p>
                @else
                <div class="can-index-review">
                    <div class="can-products">
                        <div class="can-products_carousel5">
                            @foreach($product->reviews as $review)
                                <div class="review-item" data-review-id="{{ $review->id }}">
                                    <div class="can-review-details">
                                        <h3>{{$review->user->first_name}} {{$review->user->last_name}}</h3>
                                        @if (Auth::id() === $review->user_id)
                                        <button type="button" class="can-button can-button-red delete-review-button" data-review-id="{{ $review->id }}">Удалить</button>
                                        @endif
                                    </div>
                                    <p><strong>Дата публикации:</strong> {{ $review->created_at->format('d.m.Y') }}</p>
                                    <div>
                                        <p><strong>Достоинства:</strong></p>
                                        <p class="review-text">{{ $review->advantages }}</p>
                                    </div>
                                    @if($review->disadvantages)
                                    <div>
                                        <p><strong>Недостатки:</strong></p>
                                        <p class="review-text">{{ $review->disadvantages }}</p>
                                    </div>
                                    @endif
                                    <div>
                                        <p><strong>Комментарий:</strong></p>
                                        <p class="review-text">{{ $review->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="can-products_arrows">
                            <button id="review-prev"><i class="fa-solid fa-arrow-left"></i></button>
                            <button id="review-next"><i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                @endif
                @auth
                    <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="review-form">
                        @csrf
                        <div class="form-group">
                            <label for="advantages">Достоинства:</label>
                            <textarea name="advantages" id="advantages" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="disadvantages">Недостатки:</label>
                            <textarea name="disadvantages" id="disadvantages"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="comment">Комментарий:</label>
                            <textarea name="comment" id="comment" required></textarea>
                        </div>
                        <button type="submit" class="submit-review-button">Оставить отзыв</button>
                    </form>
                @endauth
                @guest
                    <p>Пожалуйста, <a href="{{ route('login') }}" class="can-button">войдите</a> для того, чтобы оставить отзыв.</p>
                @endguest
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
    const product = {
        id: "{{ $product->id }}",
        name: "{{ $product->name }}",
        price: "{{ $product->price }}",
        discounted_price: "{{ $product->discounted_price }}",
        image: "{{ asset('storage/' . $product->images->first()->image_path) }}"
    };

    saveProduct(product);

    document.querySelector('.tab-button').click();

    document.getElementById('favorite-button').addEventListener('click', function(event) {
        event.preventDefault();

        let button = this;
        let productId = button.dataset.productId;
        let url = `/favorites/${productId}`;
        let method = button.textContent === 'В Избранное' ? 'POST' : 'DELETE';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(response => response.json())
          .then(data => {
            if (data.status === 'added') {
                button.textContent = 'Добавлено';
            } else if (data.status === 'removed') {
                button.textContent = 'В Избранное';
            }
          })
          .catch(error => console.error('Ошибка:', error));
    });

    document.querySelectorAll('.delete-review-button').forEach(button => {
        button.addEventListener('click', function() {
            let reviewId = this.dataset.reviewId;
            fetch(`/reviews/${reviewId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
              .then(data => {
                if (data.status === 'deleted') {
                    document.querySelector(`.review-item[data-review-id="${reviewId}"]`).remove();
                    alert('Ваш комментарий был удален');
                }
              })
              .catch(error => console.error('Ошибка:', error));
        });
    });
});

function saveProduct(product) {
    let seenProducts = JSON.parse(localStorage.getItem('seenProducts')) || [];
    
    if (!seenProducts.some(item => item.id == product.id)) {
        seenProducts.push(product);
        localStorage.setItem('seenProducts', JSON.stringify(seenProducts));
    }
}

function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tab-button");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

function changeMainImage(imageSrc) {
    document.getElementById('mainProductImage').src = imageSrc;
}
    </script>
    <script>
        
$(document).ready(function(){
        $('.can-products_carousel5').slick({
            infinite: true,
            slidesToScroll: 1,
            variableWidth: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('#review-prev').on('click', function() {
            $('.can-products_carousel5').slick('slickPrev');
        });

        $('#review-next').on('click', function() {
            $('.can-products_carousel5').slick('slickNext');
        });
    });
    </script>
</x-layout> 

