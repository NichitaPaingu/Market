<x-layout :categories="$categories">
    <x-slot:heading>
        Cantare.com - интернет магазин музыкальных инструментов
    </x-slot:heading>
    <div class="can-content">
        <div class="can-content_inner">
            <x-popular-brands></x-popular-brands>
            <x-popular-products :popularProducts="$popularProducts"></x-popular-products>
            <x-categories-carousel :categories="$categories"></x-categories-carousel>
            <x-deals :dealsProducts="$dealsProducts"></x-deals>
            <x-youHaveSeen></x-youHaveSeen>
            <x-info-page></x-info-page>
            <x-reviews :reviews="$reviews"></x-reviews>
        </div>
    </div>
</x-layout>
