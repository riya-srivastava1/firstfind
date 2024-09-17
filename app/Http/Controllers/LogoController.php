<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Services\FileUploadService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoController extends Controller
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

        $totalItems = Logo::count();

        $itemsPerPage = 15;
        $itemsPerPage = $request->query('itemsPerPage', $itemsPerPage);
        $logos = Logo::orderBy('id', 'desc')->paginate($itemsPerPage);
        if ($request->ajax()) {
            $view = view('admin.logo.index', compact('contacts', 'itemsPerPage', 'totalItems'))->render();
            $response = [
                'html' => $view,
            ];

            return new JsonResponse($response);
        }
        return view('admin.logo.index', compact('logos', 'totalItems', 'itemsPerPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
