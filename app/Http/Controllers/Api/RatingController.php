<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RateProductRequest;
use App\Models\Product;
use App\Models\UserRating;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * List all products with:
     * - ratings: average rating across all users
     * - user_rating: the requesting user's own rating (if any)
     * - time_passed: minutes since the user's rating_datetime
     * - active_time: "active" if time_passed > 30, otherwise "inactive"
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $products = Product::withAvg('ratings', 'rating')->get();

        // Fetch this user's ratings for all products in one query (avoid N+1)
        $myRatings = UserRating::where('user_id', $userId)
            ->get()
            ->keyBy('product_id');

        $products = $products->map(function (Product $product) use ($myRatings) {
            $mine = $myRatings->get($product->id);

            $userRating = $mine?->rating;
            $timePassed = null;
            $activeTime = null;

            if ($mine) {
                $timePassed = (int) $mine->rating_datetime->diffInMinutes(Carbon::now());
                $activeTime = $timePassed > 30 ? 'active' : 'inactive';
            }

            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'ratings' => $product->ratings_avg_rating !== null
                    ? round((float) $product->ratings_avg_rating, 2)
                    : null,
                'user_rating' => $userRating,
                'time_passed' => $timePassed,
                'active_time' => $activeTime,
            ];
        });

        return response()->json($products);
    }

    /**
     * Rate a product. Fails if the user has already rated this product
     * (use the "change rating" endpoint to update it instead).
     */
    public function rate(RateProductRequest $request, Product $product)
    {
        $userId = $request->user()->id;

        $exists = UserRating::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'You have already rated this product. Use the update endpoint to change your rating.',
            ], 409);
        }

        $rating = UserRating::create([
            'user_id' => $userId,
            'product_id' => $product->id,
            'rating' => $request->validated('rating'),
            'rating_datetime' => Carbon::now(),
        ]);

        return response()->json($rating, 201);
    }

    /**
     * Change an existing rating for a product.
     */
    public function update(RateProductRequest $request, Product $product)
    {
        $userId = $request->user()->id;

        $rating = UserRating::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if (! $rating) {
            return response()->json([
                'message' => 'You have not rated this product yet.',
            ], 404);
        }

        $rating->update([
            'rating' => $request->validated('rating'),
            'rating_datetime' => Carbon::now(),
        ]);

        return response()->json($rating);
    }

    /**
     * Remove a rating from a product.
     */
    public function destroy(Request $request, Product $product)
    {
        $userId = $request->user()->id;

        $deleted = UserRating::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->delete();

        if (! $deleted) {
            return response()->json([
                'message' => 'You have not rated this product yet.',
            ], 404);
        }

        return response()->json(['message' => 'Rating removed successfully']);
    }
}
