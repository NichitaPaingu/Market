<x-layout>
    <x-slot:heading>
        Categories
    </x-slot:heading>
    
    <div class="can-content">
        <x-succes message="{{session('succes')}}"></x-succes>
        <div class="can-content-inner">
            <div class="can-head-products">
                <a href="/dashboard" class="can-button">Личный кабинет</a>
                <h1>Categories List</h1>
                <a href="/categories/create" class="can-button">Создать категорию</a>
            </div>
            <div class="can-category-list">
                @foreach ($categories as $category)
                    <div class="can-category-card">
                        <div class="can-category-details">
                            <h2 class="can-category-title">{{ $category->name }}</h2>
                            <p class="can-category-count">Количество типов: {{ $category->categoryTypes->count() }}</p>
                        </div>
                        <div class="can-category-actions">
                            <a href="/categories/{{$category->id}}/edit" class="can-button">Изменить</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
