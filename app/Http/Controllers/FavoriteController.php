<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add($productId)
    {
        $favorite = Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

        return response()->json(['status' => 'added', 'product' => $favorite->product]);
    }

    public function remove($productId)
    {
        $favorite = Favorite::where([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ])->first();

        if ($favorite) {
            $favorite->delete();
        }

        return response()->json(['status' => 'removed']);
    }

    public function index()
    {
        $favorites = Auth::user()->favorites;
        $popularProducts = Product::where('is_popular',true)->get();
        return view('favorites.index', compact('favorites','popularProducts'));
    }
}
