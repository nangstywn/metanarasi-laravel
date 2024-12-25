<?php

namespace App\Http\Controllers\Admin;

use App\Constant\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Repositories\Eloquent\Admin\PostRepository;
use Illuminate\Database\Eloquent\MissingAttributeException;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $post;
    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }
    public function index(Request $request)
    {
        $posts = $this->post->paginate($request->all());
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

    public function approve($uuid)
    {
        try {
            $data['post'] = [
                'status' => Status::APPROVED
            ];
            $this->post->update($uuid, $data);
            return response()->json(['message' => 'Post Berhasil diapprove!']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function edit($uuid)
    {
        $post = $this->post->find($uuid);
        return view('admin.post.edit', compact('post'));
    }

    public function update(PostRequest $request, $uuid)
    {
        try {
            $this->post->update($uuid, $request->data());
            toastr('Post Berhasil diubah!');
        } catch (\Exception $e) {
            toastr('Terjadi kesalahan, silahkan hubungi admin', 'error');
        }
        return redirect()->route('admin.post.index');
    }

    public function delete($uuid)
    {
        try {
            $this->post->delete($uuid);
            return response()->json(['message' => 'Post Berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
