<?php

namespace Dpb\Package\TaskMS\Models;

use App\Models\User;
use Dpb\Package\TaskMS\Contracts\TaskAssignmentSubjectLabelResolver;
use Dpb\Package\TaskMS\Models\Datahub\Department;
use Dpb\Package\TaskMS\Models\Datahub\EmployeeContract;
use Dpb\Package\TaskMS\Resolvers\TaskSubjectLabelResolver;
use Dpb\Package\Tasks\Models\Task;
use Dpb\Package\Tasks\Models\TaskItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class TaskAssignment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'task_id',
        'department_id',
        'author_id',
        'assigned_to_id',
        'assigned_to_type',
        'source_id',
        'source_type',
        'subject_id',
        'subject_type',
    ];

    protected static TaskSubjectLabelResolver $subjectLabelResolver;

    public static function booted()
    {
        parent::booted();

        // Inject resolver from the app container
        self::$subjectLabelResolver = app(TaskSubjectLabelResolver::class);
    }

    public function getTable()
    {
        return config('pkg-task-ms.table_prefix') . 'task_assignments';
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, "task_id");
    }

    public function taskItems(): HasManyThrough
    {
        return $this->hasManyThrough(
            TaskItem::class,
            Task::class,
            'id',          // Task primary key
            'task_id',   // TaskItem FK
            'task_id',   // TaskAssignment FK to Task
            // 'id'           // Task PK
        );
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, "department_id");
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, "author_id");
        // return $this->belongsTo(EmployeeContract::class, "author_id");
    }

    public function assignedTo(): MorphTo
    {
        return $this->morphTo();
    }

    public function source(): MorphTo
    {
        return $this->morphTo();
    }

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function getTitleAttribute(): string
    {
        $taskGroupShort = Str::of($this->task->group->title)
            ->explode(' ')                 // split by space
            ->map(fn($word) => strtoupper(substr($word, 0, 1)))  // first char uppercase
            ->implode('');
        $date = $this->task->date->format('ymd');
        $subject = $this->subject->code?->code;

        return join('-', [$taskGroupShort, $date, $subject]);
    }

    public function getSubjectLabelAttribute(): string
    {
        if (!isset(self::$resolver)) {
            throw new \LogicException('Resolver not set');
        }

        return self::$subjectLabelResolver->getLabel($this->subject);
    }
}
