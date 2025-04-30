<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class BannerController extends Controller
{
    public function show()
    {
        try {
            $banner = Banner::first();

            if ($banner) {
                $banner->back_img = $banner->back_img ? url('uploads/Banners/' . $banner->back_img) : null;
            }

            return response()->json([
                'success' => true,
                'message' => 'Banner retrieved successfully.',
                'data'    => $banner
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching Banner: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve banner.'
            ], 500);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        try {
            $validated = $request->validate([
                'heading'      => 'nullable|string|max:255',
                'title'        => 'nullable|string|max:255',
                'subtitle'     => 'nullable|string|max:255',
                'description'  => 'nullable|string',
                'button_name'  => 'nullable|string|max:255',
                'button_url'   => 'nullable|string|max:255',
                'back_img'     => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:10240',
            ]);

            $banner = Banner::first();
            $back_img = $banner->back_img ?? null;

            if ($request->hasFile('back_img')) {
                $file = $request->file('back_img');
                $back_img = time() . '_banner_back_img.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/Banners'), $back_img);
            }

            $data = [
                'heading'      => $validated['heading'] ?? null,
                'title'        => $validated['title'] ?? null,
                'subtitle'     => $validated['subtitle'] ?? null,
                'description'  => $validated['description'] ?? null,
                'button_name'  => $validated['button_name'] ?? null,
                'button_url'   => $validated['button_url'] ?? null,
                'back_img'     => $back_img,
            ];

            if ($banner) {
                $banner->update($data);
            } else {
                $banner = Banner::create($data);
            }

            $banner->back_img = $banner->back_img ? url('uploads/Banners/' . $banner->back_img) : null;

            return response()->json([
                'success' => true,
                'message' => 'Banner saved successfully.',
                'data'    => $banner
            ]);
        } catch (Exception $e) {
            Log::error('Error saving banner: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save banner.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
