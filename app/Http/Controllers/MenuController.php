<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Log;
use Exception;

class MenuController extends Controller
{
    public function show()
    {
        try {
            $menu = Menu::first();

            if ($menu) {
                $menu->back_img = $menu->back_img ? url('uploads/Menus/' . $menu->back_img) : null;
            }

            return response()->json([
                'success' => true,
                'message' => 'menu data retrieved successfully.',
                'data' => $menu
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching menu: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve menu data.'
            ], 500);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        try {
            $menu = Menu::first();
            $backImg = $menu->back_img ?? null;

            // Handle back_img upload
            if ($request->hasFile('back_img')) {
                $file = $request->file('back_img');
                $backImg = time() . '_back_img.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/Menus'), $backImg);
            }

            $data = ['back_img' => $backImg];

            if ($menu) {
                $menu->update($data);
            } else {
                $menu = Menu::create($data);
            }

            // Return full image URL
            $menu->back_img = $menu->back_img ? url('uploads/Menus/' . $menu->back_img) : null;

            return response()->json([
                'success' => true,
                'message' => 'Background image saved successfully.',
                'data' => $menu
            ]);
        } catch (Exception $e) {
            Log::error('MenuController@storeOrUpdate: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save menu background image.'
            ], 500);
        }
    }
}
