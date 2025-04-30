<?php

namespace App\Http\Controllers;

use App\Models\ReviewContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ReviewContentController extends Controller
{
    
    public function show()
    {
        try {
            $review = ReviewContent::first();

            if ($review) {
                $review->back_img = $review->back_img ? url('uploads/ReviewContents/' . $review->back_img) : null;
            }

            return response()->json([
                'success' => true,
                'message' => 'Review content retrieved successfully.',
                'data'    => $review
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching review content: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve review content.'
            ], 500);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        try {
            $validated = $request->validate([
                'back_img' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:10240',
            ]);

            $review = ReviewContent::first();
            $back_img = $review->back_img ?? null;

            if ($request->hasFile('back_img')) {
                $file = $request->file('back_img');
                $back_img = time() . '_review_back_img.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/ReviewContents'), $back_img);
            }

            $data = [
                'back_img' => $back_img,
            ];

            if ($review) {
                $review->update($data);
            } else {
                $review = ReviewContent::create($data);
            }

            $review->back_img = $review->back_img ? url('uploads/ReviewContents/' . $review->back_img) : null;

            return response()->json([
                'success' => true,
                'message' => 'Review content saved successfully.',
                'data'    => $review
            ]);
        } catch (Exception $e) {
            Log::error('Error saving review content: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save review content.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
