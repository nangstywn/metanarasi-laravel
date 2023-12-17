<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\ModelHasReferenceException;
use App\Models\Category;
use App\Models\Post;
use App\Models\Visitor;
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

    public function storeVisitor($cookie, $ip, $uuid)
    {
        $post = $this->find($uuid);

        $response = response('visitor');
        $existing_uuid = $cookie;
        $existingVisitor = Visitor::where('post_id', $post->id)->where('ip_address', $ip)->latest()->first();
        $newUuid = Str::uuid();
        if ($existingVisitor) {
            if ($existing_uuid) {
                if ($existingVisitor->cookie_uuid != $existing_uuid) {
                    $visitor = $post->visitors()->create(['ip_address' => $ip, 'cookie_uuid' => $newUuid]);
                    $response = $newUuid;
                } else {
                    $response = $existing_uuid;
                }
            } else {
                //new device
                $visitor = $post->visitors()->create(['ip_address' => $ip, 'cookie_uuid' => $newUuid]);
                $response = $newUuid;
            }
        } else {
            if ($existing_uuid) {
                $visitor = $post->visitors()->create(['ip_address' => $ip, 'cookie_uuid' => $existing_uuid]);
                $response = $existing_uuid;
            } else {
                $visitor = $post->visitors()->create(['ip_address' => $ip, 'cookie_uuid' => $newUuid]);
                $response = $newUuid;
            }
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
