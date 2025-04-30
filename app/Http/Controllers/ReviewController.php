<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ReviewController extends Controller
{
    // Show the first review
    public function show()
    {
        try {
            $review = Review::first();

            if ($review) {
                $review->img = $review->img ? url('uploads/Reviews/' . $review->img) : null;
            }

            return response()->json([
                'success' => true,
                'message' => 'Data retrieved successfully.',
                'data' => $review
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching Review data: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Store or update review data
    public function storeOrUpdate(Request $request)
    {
        try {
            $review = Review::first();

            $img = $review?->img;

            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $img = time() . '_review_img.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/Reviews'), $img);
            }

            $data = [
                'title' => $request->input('title'),
                'back_color' => $request->input('back_color'),
                'img' => $img
            ];

            if ($review) {
                $review->update($data);
                $message = 'Data updated successfully.';
            } else {
                $review = Review::create($data);
                $message = 'Data created successfully.';
            }

            $review->img = $review->img ? url('uploads/Reviews/' . $review->img) : null;

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $review
            ]);
        } catch (Exception $e) {
            Log::error('Error storing/updating Review data: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to store or update data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
