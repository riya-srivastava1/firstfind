<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\FileUploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $totalItems = Category::count();

        $itemsPerPage = 15;
        $itemsPerPage = $request->query('itemsPerPage', $itemsPerPage);
        $categories = Category::orderBy('id', 'desc')->paginate($itemsPerPage);
        if ($request->ajax()) {
            $view = view('admin.category.index', compact('contacts', 'itemsPerPage', 'totalItems'))->render();
            $response = [
                'html' => $view,
            ];

            return new JsonResponse($response);
        }
        return view('admin.category.index', compact('categories', 'totalItems', 'itemsPerPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());
        $category->created_by = auth()->user()->id;
        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('category/', $request->file('image'));
            $category->image = $filename;
        }
        $category->save();
        return redirect()->route('category.index')->with(['message' => 'Added Successfully','alert-type' => 'success']);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
