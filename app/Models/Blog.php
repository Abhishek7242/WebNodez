<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'content',
        'featured_image',
        'is_featured',
        'status',
        'author_id'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }
}
