<?php

namespace App\Http\Controllers;

use App\Models\OurContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class OurContactController extends Controller
{
    public function show()
    {
        try {
            $contact = OurContact::first();

            if ($contact) {
                $contact->email_icon = $contact->email_icon ? url('uploads/OurContacts/' . $contact->email_icon) : null;
                $contact->phone_icon = $contact->phone_icon ? url('uploads/OurContacts/' . $contact->phone_icon) : null;
            }

            return response()->json([
                'success' => true,
                'message' => 'Contact information retrieved successfully.',
                'data'    => $contact
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching contact information: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve contact information.'
            ], 500);
        }
    }

    public function storeOrUpdate(Request $request)
    {
        try {
            $validated = $request->validate([
                'heading'       => 'nullable|string|max:255',
                'email'         => 'nullable|email|max:255',
                'phone'         => 'nullable|string|max:20',
                'email_icon'    => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:10240',
                'phone_icon'    => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:10240',
                'copyright'     => 'nullable|string|max:255',
            ]);

            $contact = OurContact::first();
            $email_icon = $contact->email_icon ?? null;
            $phone_icon = $contact->phone_icon ?? null;

            if ($request->hasFile('email_icon')) {
                $file = $request->file('email_icon');
                $email_icon = time() . '_email_icon.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/OurContacts'), $email_icon);
            }

            if ($request->hasFile('phone_icon')) {
                $file = $request->file('phone_icon');
                $phone_icon = time() . '_phone_icon.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/OurContacts'), $phone_icon);
            }

            $data = [
                'heading'     => $validated['heading'] ?? null,
                'email'       => $validated['email'] ?? null,
                'phone'       => $validated['phone'] ?? null,
                'email_icon'  => $email_icon,
                'phone_icon'  => $phone_icon,
                'copyright'   => $validated['copyright'] ?? null,
            ];

            if ($contact) {
                $contact->update($data);
            } else {
                $contact = OurContact::create($data);
            }

            $contact->email_icon = $contact->email_icon ? url('uploads/OurContacts/' . $contact->email_icon) : null;
            $contact->phone_icon = $contact->phone_icon ? url('uploads/OurContacts/' . $contact->phone_icon) : null;

            return response()->json([
                'success' => true,
                'message' => 'Contact information saved successfully.',
                'data'    => $contact
            ]);
        } catch (Exception $e) {
            Log::error('Error saving contact information: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save contact information.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
