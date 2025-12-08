<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Forms;

use Awcodes\TableRepeater\ComponenTask\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\Component;
use Filament\Forms;
use Dpb\Package\TaskMS\Filament\Components\ContractPicker;
use Dpb\Package\TaskMS\Models\Datahub\EmployeeContract;

class WorkAssignmentRepeater
{
    public static function make(string $uri): Component
    {
        return TableRepeater::make($uri)
            ->defaultItems(0)
            ->cloneable()
            ->columnSpan(7)
            ->headers([
                Header::make('date')
                    ->label(__('tms-ui::tasks/task-item.form.fields.activities.work_log.date')),
                Header::make('time_from')
                    ->label(__('tms-ui::tasks/task-item.form.fields.activities.work_log.time_from')),
                Header::make('time_to')
                    ->label(__('tms-ui::tasks/task-item.form.fields.activities.work_log.time_to')),
                Header::make('contract')
                    ->label(__('tms-ui::tasks/task-item.form.fields.activities.work_log.contract')),
                // Header::make('poznamka'),
                // Header::make('status'),
            ])
            ->schema([
                // Forms\Components\Group::make()
                //     ->statePath('workInterval')
                //     ->columns(3)
                //     ->schema([
                Forms\Components\DatePicker::make('work_interval.date')
                    ->hiddenLabel()
                    ->columnSpan(1)
                    ->default(now()),

                // Forms\Components\TextInput::make('duration')
                //     ->numeric()
                //     ->integer()
                //     ->default(60),
                Forms\Components\TimePicker::make('work_interval.time_from')
                    ->hiddenLabel()
                    ->format('H:i')
                    ->columnSpan(1),
                Forms\Components\TimePicker::make('work_interval.time_to')
                    ->hiddenLabel()
                    ->columnSpan(1),
                // ]),
                // contract
                ContractPicker::make('employee_contract_id')
                    // ->relationship('employeeContract', 'pid')
                    ->options(function () {

                        return EmployeeContract::with('department')
                            ->has('department')
                            ->active()
                            // ->workers()
                            ->get()
                            ->map(function ($record) {
                                // dd($record);
                                return [$record->id => $record->formattedTitle . ' ' . $record?->department?->code];
                            });
                    })
                    // ->getOptionLabelFromRecordUsing(null)
                    ->geTaskearchResulTaskUsing(null)
                    ->searchable()
                    ->columnSpan(2),
                // // note
                // Forms\Components\Textarea::make('note'),
            ])
            // ->mutateRelationshipDataBeforeCreateUsing(function (array $data, $get, $set, $livewire) {
            //     $taskId = $livewire->record?->id;

            //     if ($taskId) {
            //         $data['task_id'] = $taskId;
            //     }

            //     return $data;
            // });
        ;
    }
}
