<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'created_by'
    ];

    protected $casts = [
        'due_date' => 'date',  // 👈 This makes due_date a Carbon instance
    ];

    public function assignees()
    {
        return $this->belongsToMany(Admin::class, 'admin_task');
    }

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
