<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            Storage::delete($post->image);
        });

        static::updating(function ($post) {
            if ($post->isDirty('image') && ($post->getOriginal('image') !== null)) {
                Storage::delete($post->getOriginal('image'));
            }
        });
    }
}
