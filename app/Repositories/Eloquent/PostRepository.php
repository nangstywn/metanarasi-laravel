<?php

namespace App\Repositories\Eloquent;

use App\Constant\IsActive;
use App\Constant\Status;
use App\Exceptions\ModelHasReferenceException;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class PostRepository
{
    public function fetch()
    {
        return Post::latest()->where([['status', Status::APPROVED], ['is_active', IsActive::YES]])->get();
    }

    public function find(string $uuid)
    {
        return Post::findOrFailByUuid($uuid);
    }
    public function findBySlug(string $slug)
    {
        return Post::where('slug', $slug)->first();
    }

    public function getByCategory($categoryId, $page = null)
    {
        $posts = Post::where('category_id', $categoryId)->where([['status', Status::APPROVED], ['is_active', IsActive::YES]]);
        if ($page) {
            return $posts->paginate($page);
        }
        return $posts->get();
    }

    public function favourite()
    {
        return Post::where('favourite', 1)->where([['status', Status::APPROVED], ['is_active', IsActive::YES]])->first();
    }
    public function getFirst()
    {
        return Post::where([['status', Status::APPROVED], ['is_active', IsActive::YES]])->first();
    }

    public function editorPick()
    {
        return Post::where('editor_pick', 1)->where([['status', Status::APPROVED], ['is_active', IsActive::YES]])->take(5)->get();
    }
    public function popular()
    {
        return Post::withCount('visitors')->where([['status', Status::APPROVED], ['is_active', IsActive::YES]])->orderBy('visitors_count', 'desc')->take(3)->get();
    }

    public function latest()
    {
        return Post::latest()->where([['status', Status::APPROVED], ['is_active', IsActive::YES]])->take(4)->get();
    }
    public function categories()
    {
        return Category::withCount('posts')->get();
    }

    public function getComments($postId)
    {
        return Comment::with('post')->where('post_id', $postId)->get();
    }

    public function store(array $data)
    {
        if ($data['user']) {
            $user = User::where('name', $data['user']['name'])->where('email', $data['user']['email'])->first();
            if (!$user) {
                $user = User::create($data['user']);
            }
            $data['post']['created_by'] = $user->id;
        }
        return Post::create($data['post']);
    }


    public function storeVisitor($cookie, $ip, $uuid)
    {
        $post = $this->find($uuid);

        $response = response('visitor');
        $existing_uuid = $cookie;
        $existingVisitor = Visitor::where('post_id', $post->id)->where('ip_address', $ip)->latest()->first();
        $newUuid = Str::uuid();
        if (!$existingVisitor) {
            if ($existing_uuid) {
                $post->visitors()->create(['ip_address' => $ip, 'cookie_uuid' => $existing_uuid]);
                $response = $existing_uuid;
            } else {
                $post->visitors()->create(['ip_address' => $ip, 'cookie_uuid' => $newUuid]);
                $response = $newUuid;
            }
        }
        return $response;
    }

    public function storeComment($data, $id)
    {
        $post = $this->find($id);
        return $post->comments()->create($data);
    }
    // public function delete(string $uuid)
    // {
    //     $material = Material::withCount('ritase')->where('uuid', $uuid)->first();
    //     if ($material->ritase_count > 0) {
    //         throw new ModelHasReferenceException('Data material tidak bisa dihapus, karena menjadi referensi data lain');
    //     }
    //     return $material->delete();
    // }

}
