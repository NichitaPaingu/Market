<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::with(['categoryTypes.products'])->get();
        $popularProducts = Product::with(['categoryType.category'])->get();
        $reviews=Review::with(['user'])->get();
        $dealsProducts = Product::with('categoryType.category')
            ->whereNotNull('discount')
            ->inRandomOrder()
            ->take(5)
            ->get();
        return view('home', compact('categories', 'popularProducts', 'dealsProducts','reviews'));
    }
}
