@props(['reviews'])
@if($reviews->isEmpty())
@else
<div class="can-section">
    <div class="can-section_title">
        <h2>Отзывы про наши товары</h2>
    </div>
    <div class="can-products">
        <div class="can-products_carousel4">
            @foreach ($reviews as $review)
                <div class="can-review-card">
                    <div class="can-review-details">
                        <h3>{{ $review->user->first_name }} {{ $review->user->last_name }}</h3>
                        <span>Дата: {{ $review->created_at->format('d.m.Y') }}</span>
                        <p><strong>Достоинства:</strong> {{ $review->advantages }}</p>
                        @if($review->disadvantages)
                            <p><strong>Недостатки:</strong> {{ $review->disadvantages }}</p>
                        @endif
                        <p><strong>Комментарий:</strong> {{ $review->comment }}</p>
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

<script>
$(document).ready(function(){
    $('.can-products_carousel4').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
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
        $('.can-products_carousel4').slick('slickPrev');
    });

    $('#review-next').on('click', function() {
        $('.can-products_carousel4').slick('slickNext');
    });
});
</script>
