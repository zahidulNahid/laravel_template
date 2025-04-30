<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class AboutController extends Controller
{
    // Show the first about record
    //zabeer test ok
    public function show()
    {
        try {
            $about = About::first();

            return response()->json([
                'success' => true,
                'message' => 'About section fetched successfully.',
                'data' => $about,
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching about content: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve about section.'
            ], 500);
        }
    }


    // Store or update the About section
    public function storeOrUpdate(Request $request)
    {
        try {
            $about = About::first();

            $data = [
                'title'         => $request->input('title'),
                'subtitle'      => $request->input('subtitle'),
                'description'   => $request->input('description'),
                'button_name'   => $request->input('button_name'),
                'button_url'    => $request->input('button_url'),
            ];

            if ($about) {
                $about->update($data);
            } else {
                $about = About::create($data);
            }

            return response()->json([
                'success' => true,
                'message' => 'About section saved successfully.',
                'data' => $about,
            ]);
        } catch (Exception $e) {
            Log::error('Error saving about content: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save about section.'
            ], 500);
        }
    }
}
