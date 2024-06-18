<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// class ProductController extends Controller
// {
//     public function index()
//     {
//         return Category::with(['categoryTypes.products'])->get();
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required',
//             'description' => 'nullable',
//             'price' => 'required|numeric',
//             'stock' => 'required|integer',
//             'category_type_id' => 'required|exists:category_types,id',
//             'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//         ]);

//         $product = Product::create([
//             'name' => $request->name,
//             'description' => $request->description,
//             'price' => $request->price,
//             'stock' => $request->stock,
//             'category_type_id' => $request->category_type_id,
//         ]);

//         if ($request->hasFile('images')) {
//             foreach ($request->file('images') as $image) {
//                 $imagePath = $image->store('product_images', 'public');
//                 ProductImage::create([
//                     'product_id' => $product->id,
//                     'image_path' => $imagePath,
//                 ]);
//             }
//         }

//         return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
//     }

//     public function edit(Product $product)
//     {
//         return response()->json($product->load('images', 'categoryType'));
//     }

//     public function update(Request $request, Product $product)
//     {
//         $request->validate([
//             'name' => 'required',
//             'description' => 'nullable',
//             'price' => 'required|numeric',
//             'stock' => 'required|integer',
//             'category_type_id' => 'required|exists:category_types,id',
//             'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
//         ]);

//         $product->update([
//             'name' => $request->name,
//             'description' => $request->description,
//             'price' => $request->price,
//             'stock' => $request->stock,
//             'category_type_id' => $request->category_type_id,
//             'is_popular' => $request->has('is_popular'),
//         ]);

//         if ($request->has('remove_images')) {
//             foreach ($request->remove_images as $imageId) {
//                 $image = ProductImage::find($imageId);
//                 if ($image) {
//                     Storage::delete('public/' . $image->image_path);
//                     $image->delete();
//                 }
//             }
//         }

//         if ($request->hasFile('images')) {
//             foreach ($request->file('images') as $image) {
//                 $imagePath = $image->store('product_images', 'public');
//                 ProductImage::create([
//                     'product_id' => $product->id,
//                     'image_path' => $imagePath,
//                 ]);
//             }
//         }

//         return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
//     }

//     public function destroy(Product $product)
//     {
//         $product->delete();
//         return response()->json(['message' => 'Product deleted successfully']);
//     }
// }
