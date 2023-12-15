<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\ModelHasReferenceException;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class PostRepository
{
    public function fetch()
    {
        return Post::latest()->get();
    }

    public function find(string $uuid)
    {
        return Post::findOrFailByUuid($uuid);
    }

    public function favourite()
    {
        return Post::where('favourite', 1)->first();
    }
    public function getFirst()
    {
        return Post::first();
    }

    public function editorPick()
    {
        return Post::where('editor_pick', 1)->take(5)->get();
    }
    public function popular()
    {
        return Post::withCount('visitors')->orderBy('visitors_count', 'desc')->take(4)->get();
    }
    public function categories()
    {
        return Category::withCount('posts')->get();
    }

    public function storeVisitor($ip, $uuid)
    {
        $post = $this->find($uuid);

        $response = new Response();
        $existing_uuid = Cookie::get('visitor_uuid');
        dd($existing_uuid);
        if (!$existing_uuid) {
            $uuid = Str::uuid();
            $visitor = $post->visitors()->firstOrCreate(['ip_address' => $ip, 'cookie_uuid' => $uuid]);
            $cookie = Cookie::make('visitor_uuid', $uuid, 60 * 24 * 365);
            $response->withCookie($cookie);
        } else {
            $visitor = $post->visitors()->firstOrCreate(['ip_address' => $ip, 'cookie_uuid' => $existing_uuid]);
        }
        return $response;
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
