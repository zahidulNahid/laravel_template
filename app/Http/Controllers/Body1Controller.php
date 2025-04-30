<?php 

namespace App\Http\Controllers;

use App\Models\Body1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class Body1Controller extends Controller
{
    public function show()
    {
        try {
            $body1 = Body1::first();

            if ($body1) {
                $body1->img1 = $body1->img1 ? url('uploads/Body1/' . $body1->img1) : null;
                $body1->img2 = $body1->img2 ? url('uploads/Body1/' . $body1->img2) : null;
                $body1->img3 = $body1->img3 ? url('uploads/Body1/' . $body1->img3) : null;
            }

            return response()->json([
                'success' => true,
                'message' => 'Project Management content fetched successfully.',
                'data' => $body1
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching Project Management content: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve Project Management content.'
            ], 500);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        try {
            $body1 = Body1::first();

            $img1 = $body1->img1 ?? null;
            $img2 = $body1->img2 ?? null;
            $img3 = $body1->img3 ?? null;

            if ($request->hasFile('img1')) {
                $file = $request->file('img1');
                $img1 = time() . '_img1.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/Body1'), $img1);
            }

            if ($request->hasFile('img2')) {
                $file = $request->file('img2');
                $img2 = time() . '_img2.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/Body1'), $img2);
            }

            if ($request->hasFile('img3')) {
                $file = $request->file('img3');
                $img3 = time() . '_img3.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/Body1'), $img3);
            }

            $data = [
                'heading'       => $request->input('heading'),
                'title1'        => $request->input('title1'),
                'description1'  => $request->input('description1'),
                'title2'        => $request->input('title2'),
                'description2'  => $request->input('description2'),
                'img1'          => $img1,
                'img2'          => $img2,
                'img3'          => $img3,
                'title3'        => $request->input('title3'),
                'description3'  => $request->input('description3'),
            ];

            if ($body1) {
                $body1->update($data);
            } else {
                $body1 = Body1::create($data);
            }

            $body1->img1 = $body1->img1 ? url('uploads/Body1/' . $body1->img1) : null;
            $body1->img2 = $body1->img2 ? url('uploads/Body1/' . $body1->img2) : null;
            $body1->img3 = $body1->img3 ? url('uploads/Body1/' . $body1->img3) : null;

            return response()->json([
                'success' => true,
                'message' => 'Project Management content saved successfully.',
                'data' => $body1
            ]);
        } catch (Exception $e) {
            Log::error('Error saving Project Management content: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to save Project Management content.'
            ], 500);
        }
    }
}
