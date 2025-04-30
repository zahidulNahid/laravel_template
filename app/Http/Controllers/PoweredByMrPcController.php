<?php

namespace App\Http\Controllers;

use App\Models\PoweredByMrPc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class PoweredByMrPcController extends Controller
{
    public function show()
    {
        try {
            $data = PoweredByMrPc::first();

            if ($data) {
                $data->img = $data->img ? url('uploads/mrpc/' . $data->img) : null;
                $data->logo = $data->logo ? url('uploads/mrpc/' . $data->logo) : null;

                return response()->json([
                    'success' => true,
                    'message' => 'Data Updated',
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Update Failed',
                ], 404);
            }
        } catch (Exception $e) {
            Log::error('Error fetching Managed IT Services: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Data Retrieved  Failed',
            ], 500);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        try {
            $core = PoweredByMrPc::first();

            $imgName = $core->img ?? null;
            $logoName = $core->logo ?? null;

            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $imgName = time() . '_managed_it_img.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/mrpc'), $imgName);
            }

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $logoName = time() . '_managed_it_logo.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/mrpc'), $logoName);
            }

            $data = [
                'title'       => $request->input('title'),
                'description' => $request->input('description'),
                'img'         => $imgName,
                'logo'        => $logoName,
            ];

            if ($core) {
                $core->update($data);
            } else {
                $core = PoweredByMrPc::create($data);
            }

            $core->img = $core->img ? url('uploads/mrpc/' . $core->img) : null;
            $core->logo = $core->logo ? url('uploads/mrpc/' . $core->logo) : null;

            return response()->json([
                'success' => true,
                'message' => 'Data Updated',
                'data' => $core,
            ]);
        } catch (Exception $e) {
            Log::error('Error saving Managed IT Services: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Data Update Failed',
            ], 500);
        }
    }
}
