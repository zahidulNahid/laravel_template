<?php

namespace App\Http\Controllers;

use App\Models\ReviewData;
use Illuminate\Http\Request;

class ReviewDataController extends Controller
{
    // GET /api/review-data
    public function index()
    {
        try {
            $data = ReviewData::all();
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to fetch data', 'error' => $e->getMessage()], 500);
        }
    }
    public function getReviewData()
    {
        try {
            $data = ReviewData::all();
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to fetch data', 'error' => $e->getMessage()], 500);
        }
    }

    // POST /api/review-data
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'star' => 'required|integer|min:1|max:5',
                'content' => 'required|string',
            ]);

            $review = ReviewData::create($request->only(['name', 'star', 'content']));

            return response()->json(['success' => true, 'message' => 'Review created successfully', 'data' => $review], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to create review', 'error' => $e->getMessage()], 500);
        }
    }

    // GET /api/review-data/{id}
    public function show($id)
    {
        try {
            $review = ReviewData::findOrFail($id);
            return response()->json(['success' => true, 'data' => $review]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Review not found', 'error' => $e->getMessage()], 404);
        }
    }

    // PUT /api/review-data/{id}
    public function update(Request $request, $id)
    {
        try {
            $review = ReviewData::findOrFail($id);

            // $request->validate([
            //     'name' => 'sometimes|required|string',
            //     'star' => 'sometimes|required|integer|min:1|max:5',
            //     'content' => 'sometimes|required|string',
            // ]);

            $review->update($request->only(['name', 'star', 'content']));

            return response()->json(['success' => true, 'message' => 'Review updated successfully', 'data' => $review]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update review', 'error' => $e->getMessage()], 500);
        }
    }

    // DELETE /api/review-data/{id}
    public function destroy($id)
    {
        try {
            $review = ReviewData::findOrFail($id);
            $review->delete();

            return response()->json(['success' => true, 'message' => 'Review deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete review', 'error' => $e->getMessage()], 500);
        }
    }
}
