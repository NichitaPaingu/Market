<x-layout>
    <x-slot:heading>
        Create Product
    </x-slot:heading>
    <div class="can-content">
        <div class="can-content-inner">
            <div class="can-head-products">
                <h1>Create Product</h1>
                <a href="/products/index">Вернуться</a>
            </div>
            <form action="/products" method="POST" enctype="multipart/form-data" class="can-form">
                @csrf
                @method('POST')
                <div class="can-form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required class="can-form-input">
                </div>
                <div class="can-form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="can-form-textarea"></textarea>
                </div>
                <div class="can-form-group">
                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price" required class="can-form-input">
                </div>
                <div class="can-form-group">
                    <label for="discount">Discount:</label>
                    <input type="number" id="discount" value='0' name="discount" min="0" max="100" step="0.01" class="can-form-input">
                </div>
                <div class="can-form-group">
                    <label for="stock">Stock:</label>
                    <input type="text" id="stock" name="stock" required class="can-form-input">
                </div>
                <div class="can-form-group">
                    <label for="category_type_id">Category Type:</label>
                    <select id="category_type_id" name="category_type_id" required class="can-form-select">
                        @foreach ($categoryTypes as $categoryType)
                            <option value="{{ $categoryType->id }}">{{ $categoryType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="images-container" class="can-form-group">
                    <label for="images">Images:</label>
                    <div class="image-group">
                        <input type="file" name="images[]" class="can-form-input" required>
                        <div class="margin-10">
                            <button type="button" class="can-button can-button-add" onclick="addImage()">Add more</button>
                        </div>
                    </div>
                </div>
                <div class="can-form-group">
                    <button type="submit" class="can-button">Create</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
