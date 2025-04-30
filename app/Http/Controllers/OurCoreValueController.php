<?php

namespace App\Http\Controllers;

use App\Models\OurCoreValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class OurCoreValueController extends Controller
{
    public function show()
    {
        try {
            $data = OurCoreValue::first();

            if ($data) {
                $data->img = $data->img ? url('uploads/OurCoreValue/' . $data->img) : null;
                $data->icon1 = $data->icon1 ? url('uploads/OurCoreValue/' . $data->icon1) : null;
                $data->icon2 = $data->icon2 ? url('uploads/OurCoreValue/' . $data->icon2) : null;

                return response()->json([
                    'success' => true,
                    'message' => 'Managed IT Services retrieved successfully.',
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Managed IT Services not found.',
                ], 404);
            }
        } catch (Exception $e) {
            Log::error('Error fetching Managed IT Services: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve Managed IT Services.',
            ], 500);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        try {
            $core = OurCoreValue::first();

            $imgName = $core->img ?? null;
            $icon1Name = $core->icon1 ?? null;
            $icon2Name = $core->icon2 ?? null;

            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $imgName = time() . '_managed_it_img.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/OurCoreValue'), $imgName);
            }

            if ($request->hasFile('icon1')) {
                $file = $request->file('icon1');
                $icon1Name = time() . '_managed_it_icon1.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/OurCoreValue'), $icon1Name);
            }

            if ($request->hasFile('icon2')) {
                $file = $request->file('icon2');
                $icon2Name = time() . '_managed_it_icon2.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/OurCoreValue'), $icon2Name);
            }

            $data = [
                'title'        => $request->input('title'),
                'description1' => $request->input('description1'),
                'description2' => $request->input('description2'),
                'img'          => $imgName,
                'icon1'        => $icon1Name,
                'icon2'        => $icon2Name,
            ];

            if ($core) {
                $core->update($data);
            } else {
                $core = OurCoreValue::create($data);
            }

            $core->img = $core->img ? url('uploads/OurCoreValue/' . $core->img) : null;
            $core->icon1 = $core->icon1 ? url('uploads/OurCoreValue/' . $core->icon1) : null;
            $core->icon2 = $core->icon2 ? url('uploads/OurCoreValue/' . $core->icon2) : null;

            return response()->json([
                'success' => true,
                'message' => 'Managed IT Services saved successfully.',
                'data' => $core,
            ]);
        } catch (Exception $e) {
            Log::error('Error saving Managed IT Services: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save Managed IT Services.',
            ], 500);
        }
    }
}
