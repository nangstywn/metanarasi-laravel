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
        $post->update($data['post']);
        if (isset($data['tags'])) {
            $this->updatePostTag($post, $data);
        }
        return $post;
    }
    public function delete(string $uuid)
    {
        $post = Post::where('uuid', $uuid)->first();
        $post->comments()->delete();
        $post->tags()->detach();
        return $post->delete();
    }

    public function updatePostTag($post, $data)
    {
        return $post->tags()->sync($data['tags']);
    }
    public function storePostTag($post, $data)
    {
        return $post->tags()->attach($data['tags']);
    }
}
