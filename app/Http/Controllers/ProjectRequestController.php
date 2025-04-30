<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ProjectRequestReceived;
use Illuminate\Http\Request;
use App\Models\ProjectRequest;
use Mail;

class ProjectRequestController extends Controller
{
    // List all project requests
    public function index()
    {
        $data = ProjectRequest::all();
        return response()->json([
            'message' => 'Data fetched successfully.',
            'data' => $data
        ], 200);
    }

    // Create new project request
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email_address' => 'nullable|email',
            'phone_number' => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'customer_address' => 'nullable|string',
            'site_location' => 'nullable|string',
            'type_of_service' => 'nullable|string',
            'project_description' => 'nullable|string',
            'building_plans' => 'nullable|string|max:255',
            'upload_building_plans' => 'nullable|file',
            'requested_time_and_date' => 'nullable|date',
            'start_date' => 'nullable|date',
            'budget_range' => 'nullable|string|max:255',
            'how_do_you_know_about_us' => 'nullable|string|max:255',
        ]);

        // Handle file upload
        // if ($request->hasFile('upload_building_plans')) {
        //     $file = $request->file('upload_building_plans');
        //     $filePath = $file->store('uploads/Pdf', 'public'); // Save to storage/app/public/uploads
        //     $validated['upload_building_plans'] = $filePath;
        // }

        if ($request->hasFile('upload_building_plans')) {
            $file = $request->file('upload_building_plans');

            // Set upload path
            $destinationPath = public_path('uploads/Pdf');

            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Make unique file name
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Move file to public/uploads/Pdf
            $file->move($destinationPath, $fileName);

            // Save relative file path in database
            $validated['upload_building_plans'] = 'uploads/Pdf/' . $fileName;
        }


        $entry = ProjectRequest::create($validated);

        // Send Email
        Mail::to('abubdcalling@gmail.com')->send(new ProjectRequestReceived($entry));

        // return response
        return response()->json([
            'success' => true,
            'message' => 'Data saved and email sent successfully.',
            'data' => $entry
        ], 201);
    }

    // Show single project request
    public function show($id)
    {
        $entry = ProjectRequest::find($id);

        if (!$entry) {
            return response()->json(['message' => 'Data not found.'], 404);
        }

        return response()->json([
            'message' => 'Data fetched successfully.',
            'data' => $entry
        ], 200);
    }

    // Update existing project request
    public function update(Request $request, $id)
    {
        $entry = ProjectRequest::find($id);

        if (!$entry) {
            return response()->json(['message' => 'Data not found.'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email_address' => 'nullable|email',
            'phone_number' => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'customer_address' => 'nullable|string',
            'site_location' => 'nullable|string',
            'type_of_service' => 'nullable|string',
            'project_description' => 'nullable|string',
            'building_plans' => 'nullable|string|max:255',
            'upload_building_plans' => 'nullable|string|max:255',
            'requested_time_and_date' => 'nullable|date',
            'start_date' => 'nullable|date',
            'budget_range' => 'nullable|string|max:255',
            'how_do_you_know_about_us' => 'nullable|string|max:255',
        ]);

        $entry->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data updated successfully.',
            'data' => $entry
        ], 200);
    }

    // Delete project request
    public function destroy($id)
    {
        $entry = ProjectRequest::find($id);

        if (!$entry) {
            return response()->json(['message' => 'Data not found.'], 404);
        }

        $entry->delete();

        return response()->json([
            'message' => 'Data deleted successfully.'
        ], 200);
    }
}
