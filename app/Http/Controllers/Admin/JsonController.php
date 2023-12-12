<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\JsonRepository;
use Illuminate\Http\Request;

class JsonController extends Controller
{
    private $json;
    public function __construct(JsonRepository $json)
    {
        $this->json = $json;
    }
    public function getCategory(Request $request)
    {
        $cari = $request->search;
        $data = $this->json->fetchCategory($cari);
        $data->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });
        return response()->json($data);
    }
}