<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Ваша корзина пуста.');
        }
        
        return view('orders.create', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Ваша корзина пуста.');
        }

        // Валидация доступного количества товаров
        foreach ($cart->items as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->route('cart.index')->with('error', 'Недостаточное количество товара на складе для ' . $item->product->name);
            }
        }

        $totalPrice = $cart->items->sum(function($item) {
            return $item->quantity * $item->product->discounted_price;
        });

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'В ожидании'
        ]);

        foreach ($cart->items as $item) {
            // Уменьшение количества товара на складе
            $product = Product::find($item->product_id);
            $product->decrement('stock', $item->quantity);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->discounted_price,
            ]);
        }

        // Удаление товаров из корзины
        $cart->items()->delete();

        return redirect()->route('order.show', $order->id)->with('success', 'Заказ успешно оформлен.');
    }

    public function show($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);
        return view('orders.show', compact('order'));
    }
    public function history()
    {
        if (Auth::user()->is_admin) {
            $orders = Order::with('items.product', 'user')->get();
        } else {
            $orders = Order::with('items.product')->where('user_id', Auth::id())->get();
        }

        return view('orders.history', compact('orders'));
    }
}
