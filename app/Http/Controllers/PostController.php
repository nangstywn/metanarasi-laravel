<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\Eloquent\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    private $post;
    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $categories = $this->post->categories();
        $posts = $this->post->fetch();
        $favourite = $this->post->favourite();
        $editorPicks = $this->post->editorPick();
        $populars = $this->post->popular();
        $latests = $this->post->latest();
        if (!$favourite) {
            $favourite = $this->post->getFirst();
        }
        return view('welcome', compact('posts', 'favourite', 'editorPicks', 'populars', 'categories', 'latests'));
    }

    public function detail($uuid)
    {
        $post = $this->post->find($uuid);
        $categories = $this->post->categories();
        $visitor = $this->post->storeVisitor(request()->cookie('visitor_uuid'), request()->ip(), $uuid);
        $comments = $this->post->getComments($post->id);
        $populars = $this->post->popular();
        return response(view('post.detail', compact('post', 'categories', 'comments', 'populars')))->cookie('visitor_uuid', $visitor);
    }
}