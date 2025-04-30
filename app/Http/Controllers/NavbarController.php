<?php

namespace App\Http\Controllers;

use App\Models\Navbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class NavbarController extends Controller
{
    // Show the first navbar
    public function show()
    {
        try {
            $navbar = Navbar::first();

            if ($navbar) {
                $navbar->logo = $navbar->logo ? url('uploads/Navbars/' . $navbar->logo) : null;
                // $navbar->back_img = $navbar->back_img ? url('uploads/Navbars/' . $navbar->back_img) : null;
            }

            return response()->json([
                'success' => true,
                'message' => 'Navbar data retrieved successfully.',
                'data' => $navbar
            ]);
        } catch (Exception $e) {
            Log::error('NavbarController@show: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve navbar data.'
            ], 500);
        }
    }

    // Store or update the navbar
    public function storeOrUpdate(Request $request)
    {
        try {
            $navbar = Navbar::first();

            $logo = $navbar?->logo;
            // $back_img = $navbar?->back_img;

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $logo = time() . '_logo.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/Navbars'), $logo);
            }

            // Handle back_img upload
            // if ($request->hasFile('back_img')) {
            //     $file = $request->file('back_img');
            //     $back_img = time() . '_back_img.' . $file->getClientOriginalExtension();
            //     $file->move(public_path('uploads/Navbars'), $back_img);
            // }

            $data = [
                'logo'        => $logo,
                'back_img'    => $request->input('back_img'),
                'itemname1'   => $request->input('itemname1'),
                'itemlink1'   => $request->input('itemlink1'),
                'itemname2'   => $request->input('itemname2'),
                'itemlink2'   => $request->input('itemlink2'),
                'itemname3'   => $request->input('itemname3'),
                'itemlink3'   => $request->input('itemlink3'),
                'itemname4'   => $request->input('itemname4'),
                'itemlink4'   => $request->input('itemlink4'),
            ];

            if ($navbar) {
                $navbar->update($data);
            } else {
                $navbar = Navbar::create($data);
            }

            // Return with URLs
            $navbar->logo = $navbar->logo ? url('uploads/Navbars/' . $navbar->logo) : null;
            // $navbar->back_img = $navbar->back_img ? url('uploads/Navbars/' . $navbar->back_img) : null;

            return response()->json([
                'success' => true,
                'message' => 'Navbar saved successfully.',
                'data' => $navbar
            ]);
        } catch (Exception $e) {
            Log::error('NavbarController@storeOrUpdate: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save navbar data.'
            ], 500);
        }
    }
}
