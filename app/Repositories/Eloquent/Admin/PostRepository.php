<?php

namespace App\Repositories\Eloquent\Admin;

use App\Exceptions\ModelHasReferenceException;
use App\Models\Post;

class PostRepository
{
    public function paginate()
    {
        return Post::latest()->paginate(10);
    }

    public function find(string $uuid)
    {
        return Post::findOrFailByUuid($uuid);
    }

    public function store(array $data)
    {
        return Post::create($data);
    }

    public function update(string $uuid, array $data)
    {
        $post = $this->find($uuid);
        return $post->update($data);
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
