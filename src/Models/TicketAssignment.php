<?php

namespace Dpb\Package\TaskMS\Models;

use App\Models\User;
use Dpb\Package\Tickets\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class TicketAssignment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'ticket_id',
        'author_id',
        'subject_id',
        'subject_type',
    ];

    public function getTable()
    {
        return config('pkg-task-ms.table_prefix') . 'ticket_assignments';
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, "ticket_id");
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, "author_id");
    }

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeByTicketTypeId(Builder $query, int|array $typeId)
    {
        // cast input to array
        $typeIds = Arr::wrap($typeId);

        $query->whereHas('ticket', function ($q) use ($typeIds) {
            $q->byTypeId($typeIds);
        });
    }  
    
    public function scopeByTicketTypeCode(Builder $query, string|array $typeCode)
    {
        // cast input to array
        $typeCodes = Arr::wrap($typeCode);

        $query->whereHas('ticket', function ($q) use ($typeCodes) {
            $q->byTypeCode($typeCodes);
        });
    }      
}
