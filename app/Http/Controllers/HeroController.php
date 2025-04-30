<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class HeroController extends Controller
{
    // Get the service heading data
    public function show()
    {
        try {
            $hero = Hero::first();

            return response()->json([
                'success' => true,
                'message' => 'Service heading retrieved successfully.',
                'data' => $hero
            ]);
        } catch (Exception $e) {
            \Log::error('Error fetching service heading: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve service heading.'
            ], 500);
        }
    }


    // Store or update the service heading
    public function storeOrUpdate(Request $request)
    {
        try {
            $hero = Hero::first();

            $data = [
                'title'         => $request->input('title'),
                'subtitle'      => $request->input('subtitle'),
                'description'   => $request->input('description'),
                'button_title'  => $request->input('button_title'),
                'button_name'   => $request->input('button_name'),
                'button_url'    => $request->input('button_url'),
            ];

            if ($hero) {
                $hero->update($data);
            } else {
                $hero = Hero::create($data);
            }

            return response()->json([
                'success' => true,
                'message' => 'Service heading saved successfully.',
                'data' => $hero
            ]);
        } catch (Exception $e) {
            Log::error('Error saving service heading: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save service heading.'
            ], 500);
        }
    }
}
