<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $post;
    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $posts = $this->post->fetch();
        $favourite = $this->post->favourite();
        $editorPicks = $this->post->editorPick();
        // dd($editorPicks);
        return view('welcome', compact('posts', 'favourite', 'editorPicks'));
    }
}
