<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(TagRequest $request)
    {
        try {
            Tag::create($request->data());
            toastr('Tag Berhasil ditambahkan!');
            return response()->json();
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Terjadi kesalahan, silahkan hubungi admin'
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    public function delete($uuid)
    {
        try {
            $tag = Tag::findOrFailByUuid($uuid);
            $tag->delete($uuid);
            // toastr('Tag berhasil dihapus');
            return response()->json(['success' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            //throw $th;
        }
    }
}
