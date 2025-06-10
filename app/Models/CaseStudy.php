<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    protected $fillable = [
        'title',
        'image',
        'category',
        'duration',
        'role',
        'description',
        'link',
        'order',
        'is_featured'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'tags' => 'array',
        'stats' => 'array'
    ];

    public static function getCategories()
    {
        return [
            'web_dev' => 'Web Development',
            'app_dev' => 'App Development',
            'ui_ux' => 'UI/UX Design',
            'branding' => 'Branding'
        ];
    }
}