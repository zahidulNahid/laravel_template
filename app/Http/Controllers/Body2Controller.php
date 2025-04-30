<?php

namespace App\Http\Controllers;

use App\Models\Body2;
use Illuminate\Http\Request;

class Body2Controller extends Controller
{
    public function show()
    {
        try {
            $body2 = Body2::first();

            if ($body2 && $body2->icon) {
                $body2->icon = url('uploads/Body2/' . $body2->icon);
            }

            if ($body2) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data retrieved successfully.',
                    'data' => $body2,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No data found.',
                ], 404);
            }
        } catch (\Exception $e) {
            \Log::error('Error retrieving Body2 data: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve data.',
            ], 500);
        }
    }


    // public function storeOrUpdate(Request $request)
    // {
    //     $body2 = Body2::first();

    //     $icon = $body2->icon ?? null;

    //     if ($request->hasFile('icon')) {
    //         $file = $request->file('icon');
    //         $icon = time() . '_icon.' . $file->getClientOriginalExtension();
    //         $file->move(public_path('uploads/Body2'), $icon);
    //     }

    //     $data = [
    //         'title' => $request->input('title'),
    //         'icon'  => $icon,
    //     ];

    //     if ($body2) {
    //         $body2->update($data);
    //     } else {
    //         $body2 = Body2::create($data);
    //     }

    //     $body2->icon = $body2->icon ? url('uploads/Body2/' . $body2->icon) : null;

    //     return response()->json($body2);
    // }

    public function storeOrUpdate(Request $request)
    {
        try {
            $body2 = Body2::first();

            $icon = $body2->icon ?? null;

            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $icon = time() . '_icon.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/Body2'), $icon);
            }

            $data = [
                'title' => $request->input('title'),
                'icon' => $icon,
            ];

            if ($body2) {
                $body2->update($data);
                $message = 'Data updated successfully.';
            } else {
                $body2 = Body2::create($data);
                $message = 'Data created successfully.';
            }

            $body2->icon = $body2->icon ? url('uploads/Body2/' . $body2->icon) : null;

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $body2,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error storing/updating Body2 data: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to store or update data.',
            ], 500);
        }
    }

}
