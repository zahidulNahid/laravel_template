<?php

namespace App\Http\Controllers;

use App\Models\AboutSec2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class AboutSec2Controller extends Controller
{
    // Show the first about section (Sec2)
    public function show()
    {
        try {
            $aboutSec2 = AboutSec2::first();

            if ($aboutSec2) {
                $aboutSec2->img = $aboutSec2->img ? url('uploads/AboutSec2/' . $aboutSec2->img) : null;
                $aboutSec2->video = $aboutSec2->video ? url('uploads/AboutSec2/' . $aboutSec2->video) : null;

                $aboutSec2->icon = $aboutSec2->icon ? url('uploads/AboutSec2/icons/' . $aboutSec2->icon) : null;


                for ($i = 1; $i <= 5; $i++) {
                    $iconField = 'icon' . $i;
                    $aboutSec2->{$iconField} = $aboutSec2->{$iconField} ? url('uploads/AboutSec2/icons/' . $aboutSec2->{$iconField}) : null;
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'About Section 2 retrieved successfully.',
                'data' => $aboutSec2
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching AboutSec2: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve About Section 2.'
            ], 500);
        }
    }

    // Store or update the About Section 2
    public function storeOrUpdate(Request $request)
    {
        try {
            $aboutSec2 = AboutSec2::first();

            $imgName = $aboutSec2->img ?? null;
            $videoName = $aboutSec2->video ?? null;

            // Handle main image upload
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $imgName = time() . '_img.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/AboutSec2'), $imgName);
            }

            // Handle video upload
            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $videoName = time() . '_video.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/AboutSec2'), $videoName);
            }

            // Handle icon images (icon1 to icon5)
            $iconData = [];
            for ($i = 1; $i <= 5; $i++) {
                $field = 'icon' . $i;
                $iconName = $aboutSec2->{$field} ?? null;

                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $iconName = time() . "_{$field}." . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/AboutSec2/icons'), $iconName);
                }

                $iconData[$field] = $iconName;
            }

            $data = [
                'title1'       => $request->input('title1'),
                'description1' => $request->input('description1'),
                'title2'       => $request->input('title2'),
                'description2' => $request->input('description2'),
                'title3'       => $request->input('title3'),
                'description3' => $request->input('description3'),
                'title4'       => $request->input('title4'),
                'description4' => $request->input('description4'),
                'title5'       => $request->input('title5'),
                'description5' => $request->input('description5'),
                'img'          => $imgName,
                'video'        => $videoName,
            ] + $iconData;

            if ($aboutSec2) {
                $aboutSec2->update($data);
            } else {
                $aboutSec2 = AboutSec2::create($data);
            }

            // Convert file names to URLs
            $aboutSec2->img = $aboutSec2->img ? url('uploads/AboutSec2/' . $aboutSec2->img) : null;
            $aboutSec2->video = $aboutSec2->video ? url('uploads/AboutSec2/' . $aboutSec2->video) : null;

            for ($i = 1; $i <= 5; $i++) {
                $field = 'icon' . $i;
                $aboutSec2->{$field} = $aboutSec2->{$field} ? url('uploads/AboutSec2/icons/' . $aboutSec2->{$field}) : null;
            }

            return response()->json([
                'success' => true,
                'message' => 'About Section 2 saved successfully.',
                'data' => $aboutSec2
            ]);
        } catch (Exception $e) {
            Log::error('Error saving AboutSec2: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save About Section 2.'
            ], 500);
        }
    }
}
