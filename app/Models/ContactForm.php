<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    use HasFactory;
    /**
     * Get the public URL for IndexNow ping (optional, example).
     */
    public function getIndexNowUrl()
    {
        return url('/contact-us');
    }
    use HasFactory;
    protected $table = 'contact_forms';
    protected $fillable = [
        'name',
        'email',
        'number',
        'message',
    ];
}
