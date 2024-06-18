<x-layout>
    <x-slot:heading>
        Edit Category
    </x-slot:heading>
    <div class="can-content">
        <div class="can-content-inner">
            <div class="can-head-products">
                <h1>Edit Category</h1>
                <a href="/categories/index" class="can-button">Вернуться</a>
            </div>
            <form action="{{ route('categories.update', $category->id) }}" method="POST" class="can-form">
                @csrf
                @method('PATCH')
                <div class="can-form-group">
                    <label for="name">Category Name:</label>
                    <input type="text" id="name" name="name" value="{{ $category->name }}" required class="can-form-input">
                </div>
                <div class="can-form-group">
                    <label for="icon">Category Name:</label>
                    <input type="text" id="icon" name="icon" value="{{ $category->icon }}" nullable class="can-form-input">
                </div>
                <div id="category-types-container" class="can-form-group">
                    <label for="category_type">Category Types:</label>
                    @foreach ($category->categoryTypes as $categoryType)
                        <div class="category-type-group">
                            <input type="text" name="category_types[{{ $categoryType->id }}]" value="{{ $categoryType->name }}" class="can-form-input" required placeholder="Category Type">
                            <button type="button" class="can-button can-button-red" onclick="removeCategoryType(this)">Remove</button>
                        </div>
                    @endforeach
                    <div class="margin-10">
                        <button type="button" class="can-button can-button-add" onclick="addCategoryType()">Add more fields for type</button>
                    </div>
                </div>
                <div class="can-form-group">
                    <button type="submit" class="can-button">Update</button>
                </div>
            </form>
            <form action="/categories/{{$category->id}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="can-form-group">
                    <button type="submit" class="can-button can-button-red">Удалить категорию</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>