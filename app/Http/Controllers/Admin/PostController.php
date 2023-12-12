<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
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
        $posts = $this->post->paginate();
        return view('admin.post.index', compact('posts'));
    }
    public function create()
    {
        return view('admin.post.create');
    }
    public function store(PostRequest $request)
    {
        try {
            $this->post->store($request->data());
            toastr('Post Berhasil ditambahkan!');
        } catch (\Exception $e) {
            toastr('Terjadi kesalahan, silahkan hubungi admin', 'error');
        }
        return redirect()->route('admin.post.index');
    }
}
