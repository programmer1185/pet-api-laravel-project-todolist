<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model implements Transformable
{
    use HasFactory, TransformableTrait;

    public CONST TASK_STATUS_TODO = 1;

    public CONST TASK_STATUS_DONE = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'priority',
        'description',
        'status',
        'user_id',
        'parent_id',
        'completed_at'
    ];

    /**
     * Get all of the sub tasks for the current task
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_id');
    }
}
