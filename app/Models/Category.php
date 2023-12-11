<?php

namespace App\Models;

use App\Repositories\Traits\WithUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, WithUuid;
    protected $guarded = ['id'];
}
