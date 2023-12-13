<?php

namespace App\Models;

use App\Repositories\Traits\WithUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, WithUuid, SoftDeletes;
    protected $guarded = ['id'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
