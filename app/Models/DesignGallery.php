<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DesignGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'image',
        'link',
        'category',
        'is_featured',
        'order'
    ];

    protected $casts = [
        'order' => 'integer'
    ];

    public static function getCategories()
    {
        return [
            'web_dev' => 'Web Development',
            'app_dev' => 'App Development',
            'ui_ux' => 'UI/UX Design'
        ];
    }
}
