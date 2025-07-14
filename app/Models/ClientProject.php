<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ClientProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'project_name',
        'description',
        'image',
        'status',
        'progress_percentage',
        'start_date',
        'expected_completion_date',
        'design_completed',
        'development_completed',
        'testing_completed',
        'deployment_completed',
        'client_email'
    ];

    protected $casts = [
        'start_date' => 'date',
        'expected_completion_date' => 'date',
        'design_completed' => 'boolean',
        'development_completed' => 'boolean',
        'testing_completed' => 'boolean',
        'deployment_completed' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid();
            }
        });
    }

    public function getStatusBadgeClass()
    {
        switch ($this->status) {
            case 'in_progress':
                return 'bg-blue-100 text-blue-800';
            case 'completed':
                return 'bg-green-100 text-green-800';
            case 'on_hold':
                return 'bg-yellow-100 text-yellow-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }

    public function getStatusText()
    {
        switch ($this->status) {
            case 'in_progress':
                return 'In Progress';
            case 'completed':
                return 'Completed';
            case 'on_hold':
                return 'On Hold';
            default:
                return 'Unknown';
        }
    }

    public function getPhaseProgress()
    {
        $completedPhases = 0;
        if ($this->design_completed) $completedPhases++;
        if ($this->development_completed) $completedPhases++;
        if ($this->testing_completed) $completedPhases++;
        if ($this->deployment_completed) $completedPhases++;

        return ($completedPhases / 4) * 100;
    }

    public function getCurrentPhase()
    {
        if (!$this->design_completed) return 'Design';
        if (!$this->development_completed) return 'Development';
        if (!$this->testing_completed) return 'Testing';
        if (!$this->deployment_completed) return 'Deployment';
        return 'Completed';
    }

    public function getPhaseStatus($phase)
    {
        switch ($phase) {
            case 'design':
                return $this->design_completed ? 'completed' : 'pending';
            case 'development':
                return $this->development_completed ? 'completed' : 'pending';
            case 'testing':
                return $this->testing_completed ? 'completed' : 'pending';
            case 'deployment':
                return $this->deployment_completed ? 'completed' : 'pending';
            default:
                return 'pending';
        }
    }

    public function getPhaseCompletionDate($phase)
    {
        return null;
    }
}
