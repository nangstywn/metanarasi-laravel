<?php

namespace App\Models;

use App\Repositories\Traits\WithUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    use HasFactory, WithUuid, SoftDeletes;
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

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    private function getEstimateReadingTime($content, $wpm = 200)
    {
        $wordCount = str_word_count(strip_tags($content));

        $minutes = (int) floor($wordCount / $wpm);
        $seconds = (int) floor($wordCount % $wpm / ($wpm / 60));

        // if ($minutes === 0) {
        //     return $seconds . " " . Str::of('sec read')->plural($seconds);
        // } else {
        //     return $minutes . " " . Str::of('min read')->plural($minutes);
        // }
        if ($minutes === 0) {
            return $seconds . " sec read";
        } else {
            return $minutes . " min read";
        }
    }

    protected function timeToRead(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $value = $this->getEstimateReadingTime($attributes['content']);
                return $value;
            }
        );
    }
}
