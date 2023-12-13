<?php

namespace App\Repositories\Eloquent\Admin;

use App\Exceptions\ModelHasReferenceException;
use App\Models\Category;

class CategoryRepository
{
    public function paginate()
    {
        return Category::latest()->paginate(10);
    }

    public function find(string $uuid)
    {
        return Category::findOrFailByUuid($uuid);
    }

    public function store(array $data)
    {
        return Category::create($data);
    }

    public function update(string $uuid, array $data)
    {
        $category = $this->find($uuid);
        dd($category);
        return $category->update($data);
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
