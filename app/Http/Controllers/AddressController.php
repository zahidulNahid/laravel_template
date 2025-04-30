<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class AddressController extends Controller
{
    // Get address data
    public function show()
    {
        try {
            $address = Address::first();

            if ($address) {
                $address->icon = $address->icon ? url('uploads/Addresses/' . $address->icon) : null;
            }

            return response()->json([
                'success' => true,
                'message' => 'Address data retrieved successfully.',
                'data' => $address
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching address: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve address data.'
            ], 500);
        }
    }

    // Store or update address data
    public function storeOrUpdate(Request $request)
    {
        try {
            $address = Address::first();
            $icon = $address?->icon;

            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $icon = time() . '_icon.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/Addresses'), $icon);
            }

            $data = [
                'title'    => $request->input('title'),
                'location' => $request->input('location'),
                'icon'     => $icon,
            ];

            if ($address) {
                $address->update($data);
            } else {
                $address = Address::create($data);
            }

            // Convert icon to full URL
            $address->icon = $address->icon ? url('uploads/Addresses/' . $address->icon) : null;

            return response()->json([
                'success' => true,
                'message' => 'Address data saved successfully.',
                'data' => $address
            ]);
        } catch (Exception $e) {
            Log::error('Error saving address: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save address data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
