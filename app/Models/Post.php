<?php

namespace App\Models;

use App\Repositories\Traits\WithUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory, WithUuid;
    protected $guarded = ['id'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    protected static function boot()
    {
        parent::boot();
        $user = Auth::user();
        self::creating(function ($model) use ($user) {
            $model->created_by = $user->id ?? null;
        });

        self::updating(function ($model) use ($user) {
            $model->updated_by = $user->id ?? null;
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
