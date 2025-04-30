<?php 

namespace App\Http\Controllers;

use App\Models\Possible;
use Illuminate\Http\Request;

class PossibleController extends Controller
{
    // Get the possible data
    public function show()
    {
        $possible = Possible::first();
        return response()->json($possible);
    }

    // Store or update the possible data
    public function storeOrUpdate(Request $request)
    {
        $possible = Possible::first();

        $imgName = $possible->img ?? null;
        $logoName = $possible->logo ?? null;

        // Handle image uploads
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $imgName = time() . '_img.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/possibles'), $imgName);
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $logoName = time() . '_logo.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/possibles'), $logoName);
        }

        $data = [
            'title'       => $request->input('title'),
            'logo'        => $logoName,
            'description' => $request->input('description'),
            'img'         => $imgName,
        ];

        if ($possible) {
            $possible->update($data);
        } else {
            $possible = Possible::create($data);
        }

        // Return full image URLs
        $possible->img = $possible->img ? url('uploads/possibles/' . $possible->img) : null;
        $possible->logo = $possible->logo ? url('uploads/possibles/' . $possible->logo) : null;

        return response()->json($possible);
    }
}
