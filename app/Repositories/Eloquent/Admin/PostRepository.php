<?php

namespace App\Repositories\Eloquent\Admin;

use App\Exceptions\ModelHasReferenceException;
use App\Models\Post;

class PostRepository
{
    public function paginate($filter)
    {
        return Post::when(isset($filter['category']), function ($q) use ($filter) {
            $q->where('category_id', $filter['category']);
        })->when(isset($filter['q']), function ($q) use ($filter) {
            $q->where('title', 'like', '%' . $filter['q'] . '%');
        })->latest()->paginate(10);
    }

    public function find(string $uuid)
    {
        return Post::findOrFailByUuid($uuid);
    }

    public function store(array $data)
    {
        $post = Post::create($data['post']);
        return $this->storePostTag($post, $data);
    }

    public function update(string $uuid, array $data)
    {
        $post = $this->find($uuid);
        return $post->update($data['post']);
        return $this->updatePostTag($post, $data);
    }
    // public function delete(string $uuid)
    // {
    //     $material = Material::withCount('ritase')->where('uuid', $uuid)->first();
    //     if ($material->ritase_count > 0) {
    //         throw new ModelHasReferenceException('Data material tidak bisa dihapus, karena menjadi referensi data lain');
    //     }
    //     return $material->delete();
    // }

    public function updatePostTag($post, $data)
    {
        return $post->tags()->sync($data['tags']);
    }
    public function storePostTag($post, $data)
    {
        return $post->tags()->attach($data['tags']);
    }
}
