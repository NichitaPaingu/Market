<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Http\Request;

// class CategoryController extends Controller
// {
//     public function index()
//     {
//         return Category::with('categoryTypes')->get();
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'category_types' => 'required|array',
//             'category_types.*' => 'required|string|max:255',
//         ]);

//         $category = Category::create(['name' => $request->name]);

//         foreach ($request->category_types as $type) {
//             $category->categoryTypes()->create(['name' => $type]);
//         }

//         return response()->json(['message' => 'Category created successfully', 'category' => $category], 201);
//     }

//     public function edit(Category $category)
//     {
//         return response()->json($category->load('categoryTypes'));
//     }

//     public function update(Request $request, Category $category)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'category_types' => 'required|array',
//             'category_types.*' => 'required|string|max:255',
//         ]);

//         $category->update(['name' => $request->name]);

//         $existingTypes = $category->categoryTypes->pluck('id')->toArray();
//         $incomingTypes = array_keys($request->category_types);

//         foreach ($existingTypes as $existingTypeId) {
//             if (!in_array($existingTypeId, $incomingTypes)) {
//                 CategoryType::find($existingTypeId)->delete();
//             }
//         }

//         $newTypes = [];
//         foreach ($request->category_types as $id => $name) {
//             if (in_array($id, $existingTypes)) {
//                 $categoryType = CategoryType::find($id);
//                 $categoryType->update(['name' => $name]);
//             } else {
//                 $newTypes[] = ['name' => $name];
//             }
//         }
//         $category->categoryTypes()->createMany($newTypes);

//         return response()->json(['message' => 'Category updated successfully', 'category' => $category]);
//     }

//     public function destroy(Category $category)
//     {
//         $category->delete();
//         return response()->json(['message' => 'Category deleted successfully']);
//     }
// }
