<x-layout>
    <x-slot:heading>
        Edit product
    </x-slot:heading>
    <div class="can-content">
        <div class="can-content-inner">
            <div class="can-head-products">
                <h1>Edit Product</h1>
                <div class="can-head-products-links">
                    <a href="/products/index">Вернуться</a>
                </div>
            </div>
            <form action="/products/{{$product->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="can-form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ $product->name }}" required class="can-form-input">
                </div>
                <div class="can-form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="can-form-textarea">{{ $product->description }}</textarea>
                </div>
                <div class="can-form-group">
                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price" value="{{ $product->price }}" required class="can-form-input">
                </div>
                <div class="can-form-group">
                    <label for="discount">Discount:</label>
                    <input type="number" id="discount" value="{{ $product->discount }}" name="discount" min="0" max="100" step="0.01" class="can-form-input">
                </div>
                <div class="can-form-group">
                    <div class="can-checkbox">
                        <label for="is_popular">Popular:</label>
                        <input type="checkbox" id="is_popular" name="is_popular" {{ $product->is_popular ? 'checked' : '' }} class="can-form-input-checkbox">    
                    </div>
                </div>
                <div class="can-form-group">
                    <label for="stock">Stock:</label>
                    <input type="text" id="stock" name="stock" value="{{ $product->stock }}" required class="can-form-input">
                </div>
                <div class="can-form-group">
                    <label for="category_type_id">Category Type:</label>
                    <select id="category_type_id" name="category_type_id" required class="can-form-select">
                        @foreach ($categoryTypes as $categoryType)
                            <option value="{{ $categoryType->id }}" {{ $product->category_type_id == $categoryType->id ? 'selected' : '' }}>
                                {{ $categoryType->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="can-form-group">
                    <label for="images">Old Images:</label>
                    @foreach ($product->images as $image)
                        <div class="can-checkbox">
                            <input type="checkbox" name="remove_images[]" value="{{ $image->id }}"> Remove image
                        </div>
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" class="can-product-image">
                    @endforeach
                </div>
                <div class="can-form-group">
                    <label for="images">Add new images:</label>
                    <div id="images-container">
                        <div class="image-group">
                            <input type="file" name="images[]" class="can-form-input">
                            <button type="button" class="can-button can-button-add" onclick="addImage()">Add more</button>
                        </div>
                    </div>
                </div>
                <div class="can-form-group">
                    <button type="submit" class="can-button">Update</button>
                </div>
            </form>
            <form action="/products/{{$product->id}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="can-form-group">
                    <button type="submit" class="can-button can-button-red">Удалить</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
