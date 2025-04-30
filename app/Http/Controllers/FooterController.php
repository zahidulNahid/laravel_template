<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class FooterController extends Controller
{
     // Get Footer data
     public function show()
     {
         try {
             $Footer = Footer::first();
 
             
 
             return response()->json([
                 'success' => true,
                 'message' => 'Footer data retrieved successfully.',
                 'data' => $Footer
             ]);
         } catch (Exception $e) {
             Log::error('Error fetching Footer: ' . $e->getMessage());
 
             return response()->json([
                 'success' => false,
                 'message' => 'Failed to retrieve Footer data.'
             ], 500);
         }
     }
 
     // Store or update Footer data
     public function storeOrUpdate(Request $request)
     {
         try {
             $Footer = Footer::first();
 
             
 
             $data = [
                 'title'    => $request->input('title'),
                 'sub_title' => $request->input('sub_title'),
                 'back_img'     => $request->input('back_img'),
             ];
 
             if ($Footer) {
                 $Footer->update($data);
             } else {
                 $Footer = Footer::create($data);
             }
 
             // Convert back_img to full URL
            //  $Footer->back_img = $Footer->back_img ? url('uploads/Footers/' . $Footer->back_img) : null;
 
             return response()->json([
                 'success' => true,
                 'message' => 'Footer data saved successfully.',
                 'data' => $Footer
             ]);
         } catch (Exception $e) {
             Log::error('Error saving Footer: ' . $e->getMessage());
 
             return response()->json([
                 'success' => false,
                 'message' => 'Failed to save Footer data.',
                 'error' => $e->getMessage()
             ], 500);
         }
     }
}
