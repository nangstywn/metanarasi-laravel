<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Repositories\Eloquent\PostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    private $post;
    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    public function comment(CommentRequest $request, $uuid)
    {

        try {
            $post = $this->post->storeComment($request->data(), $uuid);
            $comments = $this->post->getComments($post->post_id);
            return view('post.comment', compact('comments'))->render();
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Terjadi kesalahan, silahkan hubungi admin'
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}