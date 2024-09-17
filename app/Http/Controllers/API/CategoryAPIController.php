<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\SubCategory;

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

    public function subCategoryList()
    {
        try {
            $subcategories = SubCategory::select('id', 'category_id', 'name', 'image')
                ->where('status', 1)
                ->where('add_category_status', 1)
                ->orderByDesc('is_featured') // Show featured subcategories first
                ->orderByDesc('created_at')  // Then order by creation date
                ->get()
                ->map(function ($category) {
                    // Include the URLs in the response
                    $category->image = $category->image_url; // This will call the accessor for the URL
                    return $category;
                });

            // Check if subcategories are found
            if ($subcategories->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No subcategories found.',
                    'data' => []
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'message' => 'subcategories retrieved successfully.',
                'data' => $subcategories
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error retrieving subcategories: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving subcategories.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request, $id)
    {
        // Check if the category exists
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'The selected category does not exist.',
            ], 404);
        }

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:sub_categories,name',
        ]);

        // Check validation
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Store the details in the database
        $detail = new SubCategory();
        $detail->category_id = $id;
        $detail->name = $request->name;
        $detail->save();

        // Return success response with id first, then name
        return response()->json([
            'success' => true,
            'message' => 'Your item add request has been sent to the admin for approval.',
            'data' => [
                'id' => $detail->id,
                'category_id' => $detail->category_id,
                'name' => $detail->name
            ],
        ], 201);
    }


    // public function store(Request $request,$id)
    // {
    //     // Define validation rules
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255|unique:sub_categories,name',
    //     ]);

    //     // Check validation
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validation errors',
    //             'errors' => $validator->errors(),
    //         ], 400);
    //     }

    //     // Store the details in the database
    //     $detail = new SubCategory();
    //     $detail->category_id = $id;
    //     $detail->name = $request->name;
    //     $detail->save();

    //     // Return success response with id first, then name
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Your item add request has been sent to the admin for approval.',
    //         'data' => [
    //             'id' => $detail->id,
    //             'category_id' => $detail->category_id,
    //             'name' => $detail->name
    //         ],
    //     ], 201);
    // }


}
