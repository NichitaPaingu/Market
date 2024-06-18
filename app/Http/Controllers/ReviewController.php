<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'advantages' => 'required|string|max:255',
            'disadvantages' => 'nullable|string|max:255',
            'comment' => 'required|string',
        ]);

        $review = new Review();
        $review->product_id = $productId;
        $review->user_id = Auth::id();
        $review->advantages = $request->input('advantages');
        $review->disadvantages = $request->input('disadvantages');
        $review->comment = $request->input('comment');
        $review->save();

        return redirect()->route('product.show', $productId)->with('success', 'Отзыв успешно добавлен');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if (Auth::id() !== $review->user_id) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        $review->delete();

        return response()->json(['status' => 'deleted']);
    }
}
