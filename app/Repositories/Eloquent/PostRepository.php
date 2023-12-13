<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\ModelHasReferenceException;
use App\Models\Post;

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

    public function editorPick()
    {
        return Post::where('editor_pick', 1)->take(5)->get();
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
