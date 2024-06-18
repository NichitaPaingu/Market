<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::with(['categoryTypes.products'])->get();
        return view('categories.index', compact('categories'));
    }
    public function create(){
        return view('categories.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'icon'=>'nullable|string|max:255',
            'category_types' => 'required|array',
            'category_types.*' => 'required|string|max:255',
        ]);

        $category = Category::create(['name' => $request->name,'icon'=>$request->icon]);

        foreach ($request->category_types as $type) {
            $category->categoryTypes()->create(['name' => $type]);
        }

        return redirect('/categories/index')->with('success', 'Category created successfully');
    }
    public function edit(Category $category){
        $category->load('categoryTypes');
        return view('categories.edit', compact('category'));
    }
    public function update(Request $request,Category $category){
        $request->validate([
            'name' => 'required|string|max:255',
            'icon'=>'nullable|string|max:255',
            'category_types' => 'required|array',
            'category_types.*' => 'required|string|max:255',
        ]);
    
        // Обновление имени категории
    $category->update(['name' => $request->name,'icon' =>$request->icon]);

    // Получение текущих типов категорий
    $existingTypes = $category->categoryTypes->pluck('id')->toArray();
    $incomingTypes = array_keys($request->category_types);

    // Удаление типов категорий, которых нет в новых данных
    foreach ($existingTypes as $existingTypeId) {
        if (!in_array($existingTypeId, $incomingTypes)) {
            CategoryType::find($existingTypeId)->delete();
        }
    }

    // Обновление существующих и создание новых типов категорий
    $newTypes = [];
    foreach ($request->category_types as $id => $name) {
        if (in_array($id, $existingTypes)) {
            $categoryType = CategoryType::find($id);
            $categoryType->update(['name' => $name]);
        } else {
            $newTypes[] = ['name' => $name];
        }
    }
    $category->categoryTypes()->createMany($newTypes);
    
        return redirect('/categories/index')->with('success', 'Category updated successfully');
    }
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }
    public function destroy(Category $category){
        $category->delete();
        return redirect('/categories/index')->with('success', 'Category deleted successfully');
    }
}
