<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
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

    public function create()
    {
        $categories = $this->post->categories();
        return view('post.create', compact('categories'));
    }

    public function store(PostCreateRequest $reqeuest)
    {
        try {
            $data = $reqeuest->data();
            $this->post->store($data);
            toastr('Post Berhasil ditambahkan!, Silahkan tunggu untuk di verifikasi');
        } catch (\Exception $e) {
            toastr('Terjadi kesalahan, silahkan hubungi admin', 'error');
        }
        return redirect()->route('post.index');
    }

    public function detail($slug)
    {
        $post = $this->post->findBySlug($slug);
        $categories = $this->post->categories();
        $visitor = $this->post->storeVisitor(request()->cookie('visitor_uuid'), request()->ip(), $post->uuid);
        $comments = $this->post->getComments($post->id);
        $populars = $this->post->popular();
        return response(view('post.detail', compact('post', 'categories', 'comments', 'populars')))->cookie('visitor_uuid', $visitor);
    }
}
