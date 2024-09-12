<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'slug',
        'status',
        'created_by',
        'is_featured',
        'priority'
    ];

    public function getImageUrlAttribute()
    {
        // Construct the full URL for the icon
        return url(Storage::url('category/' . $this->image));
    }
}
