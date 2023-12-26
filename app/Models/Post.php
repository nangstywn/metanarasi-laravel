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
use Illuminate\Support\Facades\Storage;
use App\Models\Visitor;
use Illuminate\Support\Facades\App;

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
    public function visitors()
    {
        return $this->hasMany(Visitor::class, 'post_id');
    }

    private function getEstimateReadingTime($content, $wpm = 200)
    {
        $wordCount = str_word_count(strip_tags($content));

        $minutes = (int) floor($wordCount / $wpm);
        $seconds = (int) floor($wordCount % $wpm / ($wpm / 60));
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

    protected function filePath(): string
    {
        return 'post/thumb';
    }

    public function getAttachmentUrlAttribute()
    {
        return $this->getFileUrl($this->attributes['attachment']);
    }
    public function fileSystem()
    {
        if (App::environment(['staging', 'production'])) {
            return 's3';
        } else {
            return 'public';
        }
    }

    protected function getFileUrl($fileName)
    {
        // Assuming the file path follows the defined file path structure
        $filePath = $this->filePath() . '/' . $fileName;

        // Use Storage facade to generate the URL
        return Storage::disk($this->fileSystem())->url($filePath);
    }
}