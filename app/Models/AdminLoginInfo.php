<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;

class AdminLoginInfo extends Model
{
    use HasFactory;

    protected $table = 'adminlogininfo';

    protected $fillable = [
        'admin_id',
        'name',
        'ip_address',
        'status',
        'user_agent',
        'created_at',
    ];

    public $timestamps = false;

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
