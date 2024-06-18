<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        return view('cart.index', compact('cart'));
    }

    public function add($productId)
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $product = Product::findOrFail($productId);

        $cartItem = CartItem::updateOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $product->id],
            ['quantity' => DB::raw('quantity + 1')]
        );

        return redirect()->route('cart.index');
    }

    public function update(Request $request, $itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json(['success' => true]);
    }

    public function remove($itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->delete();

        return response()->json(['success' => true]);
    }

    public function getTotal()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $total = $cart->items->sum(function ($item) {
            return $item->quantity * ($item->product->discounted_price ?? $item->product->price);
        });

        return response()->json(['success' => true, 'total' => number_format($total, 0, '', ' ')]);
    }
}
