<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function show()
    {
        try {
            $home = Home::first();

            if ($home) {
                $home->img1 = $home->img1 ? url('uploads/Homes/' . $home->img1) : null;
                $home->img2 = $home->img2 ? url('uploads/Homes/' . $home->img2) : null;
                $home->img3 = $home->img3 ? url('uploads/Homes/' . $home->img3) : null;
                $home->img4 = $home->img4 ? url('uploads/Homes/' . $home->img4) : null;

                return response()->json([
                    'success' => true,
                    'message' => 'Data retrieved successfully.',
                    'data' => $home
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No home data found.',
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error retrieving home data: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving home data.',
            ], 500);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        try {
            $home = Home::first();

            $img1 = $home->img1 ?? null;
            $img2 = $home->img2 ?? null;
            $img3 = $home->img3 ?? null;
            $img4 = $home->img4 ?? null;

            if ($request->hasFile('img1')) {
                $file = $request->file('img1');
                $img1 = time() . '_img1.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/Homes'), $img1);
            }

            if ($request->hasFile('img2')) {
                $file = $request->file('img2');
                $img2 = time() . '_img2.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/Homes'), $img2);
            }

            if ($request->hasFile('img3')) {
                $file = $request->file('img3');
                $img3 = time() . '_img3.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/Homes'), $img3);
            }

            if ($request->hasFile('img4')) {
                $file = $request->file('img4');
                $img4 = time() . '_img4.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/Homes'), $img4);
            }

            $data = [
                'heading' => $request->input('heading'),
                'title1' => $request->input('title1'),
                'description1' => $request->input('description1'),
                'img1' => $img1,

                'title2' => $request->input('title2'),
                'description2' => $request->input('description2'),
                'img2' => $img2,

                'title3' => $request->input('title3'),
                'description3' => $request->input('description3'),
                'img3' => $img3,

                'title4' => $request->input('title4'),
                'description4' => $request->input('description4'),
                'img4' => $img4,
            ];

            if ($home) {
                $home->update($data);
            } else {
                $home = Home::create($data);
            }

            $home->img1 = $home->img1 ? url('uploads/Homes/' . $home->img1) : null;
            $home->img2 = $home->img2 ? url('uploads/Homes/' . $home->img2) : null;
            $home->img3 = $home->img3 ? url('uploads/Homes/' . $home->img3) : null;
            $home->img4 = $home->img4 ? url('uploads/Homes/' . $home->img4) : null;

            return response()->json([
                'success' => true,
                'message' => $home->wasRecentlyCreated ? 'Data created successfully.' : 'Data updated successfully.',
                'data' => $home
            ]);
        } catch (\Exception $e) {
            Log::error('Error saving home data: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving home data.',
            ], 500);
        }
    }
}
