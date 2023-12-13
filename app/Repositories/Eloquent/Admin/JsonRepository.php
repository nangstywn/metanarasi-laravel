<?php

namespace App\Repositories\Eloquent\Admin;

use App\Exceptions\ModelHasReferenceException;
use App\Models\Category;

class JsonRepository
{
    public function fetchCategory($cari)
    {
        return Category::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
    }
}
