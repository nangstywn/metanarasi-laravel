<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Eloquent\CategoryRepository;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    private $category;
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        $categories = $this->category->paginate();
        // dd($categories);
        return view('admin.category.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            $this->category->store($request->data());
            return response()->json([
                'status' => 200,
                'message' => 'Category berhasil disimpan'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Terjadi kesalahan, silahkan hubungi admin'
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(CategoryRequest $request, $uuid)
    {
        try {
            $this->category->update($uuid, $request->data());
            return response()->json([
                'status' => 200,
                'message' => 'Category berhasil diubah'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Terjadi kesalahan, silahkan hubungi admin'
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}