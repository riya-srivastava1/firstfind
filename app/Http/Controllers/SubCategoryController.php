<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Services\FileUploadService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function index(Request $request)
    {
        $totalItems = SubCategory::count();

        $itemsPerPage = 15;
        $itemsPerPage = $request->query('itemsPerPage', $itemsPerPage);
        $subcategories = SubCategory::orderBy('id', 'desc')->paginate($itemsPerPage);
        if ($request->ajax()) {
            $view = view('admin.sub-category.index', compact('contacts', 'itemsPerPage', 'totalItems'))->render();
            $response = [
                'html' => $view,
            ];

            return new JsonResponse($response);
        }
        return view('admin.sub-category.index', compact('subcategories', 'totalItems', 'itemsPerPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)
            ->whereNotNull('name')
            ->get();

        return view('admin.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subcategory = SubCategory::create($request->all());
        $subcategory->created_by = auth()->user()->id;
        $subcategory->add_category_status = 1;
        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('subcategory/', $request->file('image'));
            $subcategory->image = $filename;
        }
        $subcategory->save();
        return redirect()->route('subcategory.index')->with(['message' => 'Added Successfully', 'alert-type' => 'success']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::where('status', 1)
            ->whereNotNull('name')
            ->get();

        $subcategory = SubCategory::findOrFail($id);
        return view('admin.sub-category.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the existing subcategory by ID
        $subcategory = SubCategory::findOrFail($id);

        // Update the subcategory with the new data from the request
        $subcategory->fill($request->except('image')); // Fill all fields except 'image'

        // Set the 'created_by' field to the current user's ID
        $subcategory->created_by = auth()->user()->id;

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('subcategory/', $request->file('image'));
            $logoData['image'] = $filename;

            $this->fileUploadService->removeImage('subcategory/', $logo->image ?? null);
        }
        // Save the updated subcategory
        $subcategory->save();

        // Redirect with success message
        return redirect()->route('subcategory.index')->with([
            'message' => 'Updated Successfully',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $subcategory = SubCategory::findOrFail($id);
            $image = $subcategory->image;
            $subcategory->forceDelete();
            if ($image) {
                $this->fileUploadService->removeImage('subcategory/', $image);
            }

            return redirect()->back()->with('success', 'Deleted Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function status(Request $request)
    {
        $item = SubCategory::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }
    public function updateStatus(Request $request, $id)
    {
        // Find the subcategory by ID
        $subcategory = Subcategory::findOrFail($id);

        // Update the status based on the submitted value
        $subcategory->add_category_status = $request->input('status');
        $subcategory->save();

        // Redirect back with a success message (optional)
        return redirect()->back()->with('success', 'Status updated successfully.');
    }

}
