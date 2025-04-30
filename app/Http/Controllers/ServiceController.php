<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ServiceController extends Controller
{
    // Get the service data
    public function show()
    {
        try {
            $service = Service::first();

            if ($service) {
                // Convert icon paths to full URLs
                $service->icon = $service->icon ? url('uploads/Services/icons/' . $service->icon) : null;

                for ($i = 1; $i <= 7; $i++) {
                    $iconField = 'icon' . $i;
                    $service->{$iconField} = $service->{$iconField} ? url('uploads/Services/icons/' . $service->{$iconField}) : null;
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Service data retrieved successfully.',
                'data' => $service
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching Service: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve service data.'
            ], 500);
        }
    }

    // Store or update the service data
    public function storeOrUpdate(Request $request)
    {
        try {
            $service = Service::first();

            $iconFields = ['icon', 'icon1', 'icon2', 'icon3', 'icon4', 'icon5', 'icon6', 'icon7'];
            $iconData = [];

            foreach ($iconFields as $field) {
                $iconName = $service->{$field} ?? null;

                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $iconName = time() . "_{$field}." . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/Services/icons'), $iconName);
                }

                $iconData[$field] = $iconName;
            }

            $data = [
                'heading' => $request->input('heading'),
                'title1'  => $request->input('title1'),
                'title2'  => $request->input('title2'),
                'title3'  => $request->input('title3'),
                'title4'  => $request->input('title4'),
                'title5'  => $request->input('title5'),
                'title6'  => $request->input('title6'),
                'title7'  => $request->input('title7'),
                'title'  => $request->input('title'),
            ] + $iconData;

            if ($service) {
                $service->update($data);
            } else {
                $service = Service::create($data);
            }

            // Return full URLs for icons
            $service->icon = $service->icon ? url('uploads/Services/icons/' . $service->icon) : null;
            for ($i = 1; $i <= 7; $i++) {
                $iconField = 'icon' . $i;
                $service->{$iconField} = $service->{$iconField} ? url('uploads/Services/icons/' . $service->{$iconField}) : null;
            }

            return response()->json([
                'success' => true,
                'message' => 'Service data saved successfully.',
                'data' => $service
            ]);
        } catch (Exception $e) {
            Log::error('Error saving Service: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save service data.'
            ], 500);
        }
    }
}
