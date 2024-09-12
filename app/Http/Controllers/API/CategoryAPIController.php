<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CategoryAPIController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::select('id', 'name', 'image')
                ->where('status', 1)
                ->orderByDesc('is_featured') // Show featured categories first
                ->orderByDesc('created_at')  // Then order by creation date
                ->get()
                ->map(function ($category) {
                    // Include the URLs in the response
                    $category->image = $category->image_url; // This will call the accessor for the URL
                    return $category;
                });

            // Check if categories are found
            if ($categories->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No categories found.',
                    'data' => []
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'message' => 'categories retrieved successfully.',
                'data' => $categories
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error retrieving categories: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving categories.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
