<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function filePath(): string
    {
        return 'user';
    }

    public function getPhotoUrlAttribute()
    {
        return $this->getFileUrl($this->attributes['photo']);
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
