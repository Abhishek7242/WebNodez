<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\IndexNowHelper;
use Illuminate\Support\Facades\Log;

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

    /**
     * Blog Author relationship
     */
    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    /**
     * Get the public URL for IndexNow ping.
     */
    public function getIndexNowUrl()
    {
        return url('/blog/' . $this->slug);
    }

    /**
     * Auto-submit to IndexNow when a blog is created/updated/deleted.
     */
    protected static function booted()
    {
        // On create/update
        static::saved(function ($blog) {
            if ($blog->status === 'published') {
                try {
                    IndexNowHelper::submitUrl($blog->getIndexNowUrl());
                    Log::info("IndexNow ping success (saved)", ['blog_id' => $blog->id]);
                } catch (\Exception $e) {
                    Log::warning("IndexNow ping failed on save", [
                        'blog_id' => $blog->id,
                        'error'   => $e->getMessage()
                    ]);
                }
            }
        });

        // On delete
        static::deleted(function ($blog) {
            try {
                IndexNowHelper::submitUrl($blog->getIndexNowUrl());
                Log::info("IndexNow ping success (deleted)", ['blog_id' => $blog->id]);
            } catch (\Exception $e) {
                Log::warning("IndexNow ping failed on delete", [
                    'blog_id' => $blog->id,
                    'error'   => $e->getMessage()
                ]);
            }
        });
    }

    /**
     * Manual trigger for IndexNow submission
     */
    public function submitToIndexNow()
    {
        try {
            IndexNowHelper::submitUrl($this->getIndexNowUrl());
            Log::info("IndexNow manual ping success", ['blog_id' => $this->id]);
            return true;
        } catch (\Exception $e) {
            Log::warning("IndexNow manual ping failed", [
                'blog_id' => $this->id,
                'error'   => $e->getMessage()
            ]);
            return false;
        }
    }
}
