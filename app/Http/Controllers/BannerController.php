<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Services\FileUploadService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $banners = Banner::orderBy('id', 'desc')->paginate($itemsPerPage);
        if ($request->ajax()) {
            $view = view('admin.banner.index', compact('contacts', 'itemsPerPage', 'totalItems'))->render();
            $response = [
                'html' => $view,
            ];

            return new JsonResponse($response);
        }
        return view('admin.banner.index', compact('banners', 'totalItems', 'itemsPerPage'));
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
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->fill($request->except('image')); // Fill all fields except 'image'
        $banner->created_by = auth()->user()->id;
        $logoData = $request->except('image');
        if ($request->hasFile('image')) {
            $filename = $this->fileUploadService->uploadImage('banner/', $request->file('image'));
            $logoData['image'] = $filename;
            $this->fileUploadService->removeImage('banner/', $logo->image ?? null);
        }
        // Save the updated subbanner
        $banner->update($logoData);
        return redirect()->route('banner.index')->with([
            'message' => 'Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Banner::findOrFail($id);
            $image = $category->image;
            $category->forceDelete();
            if ($image) {
                $this->fileUploadService->removeImage('category/', $image);
            }
            return redirect()->back()->with('success', 'Deleted Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
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
