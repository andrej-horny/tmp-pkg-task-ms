<?php

namespace Dpb\Package\TaskMS\Models;

use Dpb\Package\Inspections\Models\InspectionTemplate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InspectionTemplatable extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'template_id',
        'templatable_id',
        'templatable_type',
    ];

    public function getTable()
    {
        return config('pkg-task-ms.table_prefix') . 'inspection_templatables';
    }

    public function template(): BelongsTo 
    {
        return $this->belongsTo(InspectionTemplate::class);
    } 

    public function templatable(): MorphTo
    {
        return $this->morphTo();
    }    
}
