<x-layout>
    <x-slot:heading>
        Create Category
    </x-slot:heading>
    <div class="can-content">
        <div class="can-content-inner">
            <div class="can-head-products">
                <h1>Create Category</h1>
                <a href="/categories/index" class="can-button-create">Вернуться</a>
            </div>
            <form action="/categories" method="POST" class="can-form">
                @csrf
                @method('POST')
                <div class="can-form-group">
                    <label for="name">Category Name:</label>
                    <input type="text" id="name" name="name" required class="can-form-input">
                </div>
                <div class="can-form-group">
                    <label for="icon">Icon Category</label>
                    <input type="text" id="icon" name="icon" nullable class="can-form-input" placeholder="Input FontAwesome tag">
                </div>
                <div id="category-types-container" class="can-form-group">
                    <label for="category_type">Category Types:</label>
                    <div class="category-type-group">
                        <input type="text" name="category_types[]" class="can-form-input" required placeholder="Category Type">
                        <button type="button" class="can-button can-button-add" onclick="addCategoryType()">Add more</button>
                    </div>
                </div>
                <div class="can-form-group">
                    <button type="submit" class="can-button">Create</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>