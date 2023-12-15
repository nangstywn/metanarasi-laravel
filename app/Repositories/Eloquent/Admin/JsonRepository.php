<?php

namespace App\Repositories\Eloquent\Admin;

use App\Exceptions\ModelHasReferenceException;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class JsonRepository
{
    public function fetchCategory($cari)
    {
        return Category::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
    }
    public function fetchTag($cari)
    {
        return Tag::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
    }
    public function update($id, $data)
    {
        $post = Post::find($id);
        $post->update($data);
        return $post;
    }
}
