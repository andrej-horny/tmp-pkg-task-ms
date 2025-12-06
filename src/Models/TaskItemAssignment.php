<?php

namespace Dpb\Package\TaskMS\Models;

use Dpb\Package\Tasks\Models\Task;
use Dpb\Package\Tasks\Models\TaskItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskItemAssignment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'task_item_id',
        'assigned_to_id',
        'assigned_to_type',
        'author_id',
        'supervised_by',
    ];

    public function getTable()
    {
        return config('pkg-task-ms.table_prefix') . 'task_item_assignments';
    }

    public function task(): HasOneThrough
    {
        return $this->hasOneThrough(
            Task::class,   // final model you want
            TaskItem::class,   // intermediate model
            'id',  // foreign key on intermediate model (users.country_id)
            'task_id',     // foreign key on final model (posts.user_id)
            'task_id',          // local key on this model (countries.id)
            'id'           // local key on intermediate model (users.id)
        );
    }

    public function taskItem(): BelongsTo
    {
        return $this->belongsTo(TaskItem::class, "task_item_id");
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, "author_id");
        // return $this->belongsTo(EmployeeContract::class, "author_id");
    }

    public function supervisedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "supervised_by");
        // return $this->belongsTo(EmployeeContract::class, "assigned_to");
    }

    public function assignedTo(): MorphTo
    {
        return $this->morphTo();
    }
}
