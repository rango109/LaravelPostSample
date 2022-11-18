<?php

namespace App\Models;

use App\Enums\PublicStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'picture',
        'content',
        'status',
    ];

    public function getPictureUrlAttribute()
    {
        return $this->picture ? Storage::disk('public')->url($this->picture) : null;
    }

    public function getStatusLabelAttribute()
    {
        return PublicStatus::getDescription($this->status);
    }
}
