<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Tables;

use Dpb\Package\TaskMS\Filament\Components\VehiclePicker;
use Dpb\Package\Fleet\Models\MaintenanceGroup;
use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\ToggleButtons;
use Dpb\Package\TaskMS\States;

class TaskItemAssignmentTableFilters
{
    public static function make(): array
    {
        return [
            // date
            self::dateFilter(),

            // task item state
            self::stateFilter(),
            // subject
            // self::subjectFilter(),
        ];
    }

    private static function dateFilter()
    {
        return Tables\Filters\Filter::make('date')
            ->form([
                DatePicker::make('date')
                    ->label(__('tms-ui::tasks/task-item.table.filters.date')),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                    ->when(
                        $data['date'],
                        fn(Builder $query, $date): Builder =>
                        $query->whereHas('taskItem', function ($q) use ($date) {
                            $q->whereDate('date', '=', $date);
                        })
                    );
            });
    }

    private static function stateFilter()
    {
        return Tables\Filters\Filter::make('state')
            ->form([
                ToggleButtons::make('state')
                    ->options([
                        States\Task\TaskItem\Closed::$name => __('tms-ui::tasks/task-item.states.closed'),
                        States\Task\TaskItem\Cancelled::$name => __('tms-ui::tasks/task-item.states.cancelled'),
                        States\Task\TaskItem\InProgress::$name => __('tms-ui::tasks/task-item.states.in-progress'),
                        States\Task\TaskItem\AwaitingParTask::$name => __('tms-ui::tasks/task-item.states.awaiting-parTask'),
                    ])
                    ->multiple()
                    ->inline()
                    ->label(__('tms-ui::tasks/task-item.table.filters.state')),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                    ->when(
                        $data['state'],
                        fn(Builder $query, $state): Builder =>
                        $query->whereHas('taskItem', function ($q) use ($state) {
                            $q->whereIn('state', $state);
                        })
                    );
            });
    }

    private static function subjectFilter()
    {
        return Tables\Filters\Filter::make('subject')
            ->form([
                VehiclePicker::make('subject')
                    ->options(
                        Vehicle::query()
                            ->has('codes')
                            ->with(['codes' => fn($q) => $q->orderByDesc('date_from'), 'model'])
                            ->get()
                            ->mapWithKeys(function (Vehicle $vehicle) {
                                $latestCode = $vehicle->codes->first();
                                if (!$latestCode) {
                                    return []; // important: return empty array if no code
                                }
                                return [
                                    $vehicle->id => $latestCode->code,
                                ];
                            })
                            ->toArray()
                    )
                    ->geTaskearchResulTaskUsing(null)
                    ->getOptionLabelFromRecordUsing(null)
                    ->searchable()
                    ->multiple()
                    ->label(__('tms-ui::tasks/task-item.table.filters.subject')),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                    ->when(
                        $data['subject'],
                        fn(Builder $query, $subject): Builder =>
                        $query->whereHas('taskItem.task', function ($q) use ($subject) {
                            $q->whereMorphedTo(
                                'subject',
                                Dpb\Package\TaskMS(Vehicle::class)->getMorphClass(),
                            )
                                ->whereIn('subject_id', $subject);
                        })
                    );
            });
    }
}
