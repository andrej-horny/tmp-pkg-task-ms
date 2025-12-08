<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\ComponenTask;

use Awcodes\TableRepeater\ComponenTask\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\Component;
use Filament\Forms;
use Dpb\Package\TaskMS\Filament\Components\ContractPicker;


class WorkAssignmentRepeater
{
    public static function make(string $uri): Component
    {
        return TableRepeater::make($uri)
            ->defaultItems(0)
            ->cloneable()
            ->columnSpan(3)
            ->headers([
                Header::make('date'),
                Header::make('time_from'),
                Header::make('time_to'),
                Header::make('contract'),
                // Header::make('poznamka'),
                // Header::make('status'),
            ])
            ->schema([
                Forms\Components\Group::make()
                    // ->relationship('workInterval')
                    ->columns(3)
                    ->schema([
                        Forms\Components\DatePicker::make('date')
                            ->hiddenLabel()
                            ->columnSpan(1)
                            ->default(now()),

                        // Forms\Components\TextInput::make('duration')
                        //     ->numeric()
                        //     ->integer()
                        //     ->default(60),
                        Forms\Components\TimePicker::make('time_from')
                            ->hiddenLabel()
                            ->columnSpan(1),
                        Forms\Components\TimePicker::make('time_to')
                            ->hiddenLabel()
                            ->columnSpan(1),
                    ]),
                // contract
                ContractPicker::make('employee_contract_id')
                    ->relationship('employeeContract', 'pid')
                    ->getOptionLabelFromRecordUsing(null)
                    ->geTaskearchResulTaskUsing(null)
                    ->searchable(),
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
