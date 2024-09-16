<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\FileUploadService;

class BannerController extends Controller
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

        $totalItems = Banner::count();

        $itemsPerPage = 15;
        $itemsPerPage = $request->query('itemsPerPage', $itemsPerPage);
        $categories = Banner::orderBy('id', 'desc')->paginate($itemsPerPage);
        if ($request->ajax()) {
            $view = view('admin.banner.index', compact('contacts', 'itemsPerPage', 'totalItems'))->render();
            $response = [
                'html' => $view,
            ];

            return new JsonResponse($response);
        }
        return view('admin.banner.index', compact('categories', 'totalItems', 'itemsPerPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $banner = Banner::create($request->all());
        $banner->created_by = auth()->user()->id;
        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('banner/', $request->file('image'));
            $banner->image = $filename;
        }
        $banner->save();
        return redirect()->route('banner.index')->with(['message' => 'Added Successfully', 'alert-type' => 'success']);

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
        return view('admin.banner.edit');
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

    public function status(Request $request)
    {
         $item = Banner::find($request->id);
        if ($item) {
            $item->status = $request->status;
            $item->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }
}
