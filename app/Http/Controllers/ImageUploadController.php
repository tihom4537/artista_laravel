<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);

        if ($request->hasFile('image')) {
            // Store the uploaded file in the filesystem
            $imagePath = $request->file('image')->store('public/images'); // Adjust the storage path as needed
            
            // Remove the 'public/' prefix from the image path
            $imagePath = str_replace('public/', '', $imagePath);
        
            // Optionally, you can also store the image path in the database here
        
            // Return the image path or URL as a response
            return response()->json(['imagePath' => $imagePath], 200);
        }
        

        // If no file is present in the request, return an error response
        return response()->json(['error' => 'No image uploaded'], 400);
    }
}
