<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Forms;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Forms\ActivityRepeater;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource\ComponenTask\MaterialRepeater;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskResource\ComponenTask\ServiceRepeater;
use Dpb\Package\TaskMS\States\Task\TaskItem\Closed;
use Dpb\Package\TaskMS\States\Task\TaskItem\Created;
use Dpb\Package\TaskMS\States\Task\TaskItem\InProgress;
use Awcodes\TableRepeater\ComponenTask\TableRepeater;
use Awcodes\TableRepeater\Header;
use Dpb\Package\Fleet\Models\MaintenanceGroup;
use Dpb\Package\Tasks\Models\Task;
use Dpb\Package\Tasks\Models\TaskItemGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;

class TaskItemAssignmentForm
{
    public static function make(Form $form): Form
    {
        return $form
            ->columns(6)
            // ->schema(static::schema())
            ->schema([

                Forms\Components\Section::make('TO DO')
                    ->description('TODO: pripravujeme'),
            ]);
    }

    public static function schema(): array
    {
        return [
            // task
            Forms\Components\Select::make('task')
                ->label(__('tms-ui::tasks/task-item.form.fields.task'))
                ->columnSpan(3)
                ->relationship('task', 'title'),
            // ->getOptionLabelFromRecordUsing(fn (Task $record) => "{$record->}"),

            // date
            Forms\Components\DatePicker::make('date')
                ->label(__('tms-ui::tasks/task-item.form.fields.date'))
                ->columnSpan(1)
                ->default(now()),
            // // subject
            // Forms\Components\Select::make('subject_id')
            //     ->label(__('tms-ui::tasks/task-item.form.fields.subject'))
            //     ->columnSpan(1)
            //     // ->relationship('source', 'title', null, true)
            //     ->options(fn() => Vehicle::pluck('code_1', 'id'))
            //     ->getOptionLabelsUsing(fn($record) => "{$record->code->code} - {$record->model->title}")
            //     ->preload()
            //     ->searchable()
            //     // ->disabled(fn($record) => $record->source_id == Task::byCode('planned-maintenance')->first()->id)
            //     ->required(false)
            //     ->hiddenOn(TaskItemRelationManager::class),

            // title
            Forms\Components\Select::make('taskItem.group_id')
                ->relationship('taskItem.group', 'title')
                ->label(__('tms-ui::tasks/task-item.form.fields.title'))
                ->columnSpan(2)
                // ->options(fn() => ActivityTemplateGroup::has('parent')->pluck('title', 'id'))
                ->getOptionLabelFromRecordUsing(fn(TaskItemGroup $record) => "{$record->code} {$record->title}")
                ->searchable()
                ->preload()
                ->live(),

            // assigned to e.g. maintenance group
            Forms\Components\ToggleButtons::make('assigned_to_id')
                ->label(__('tms-ui::tasks/task-item.form.fields.assigned_to'))
                ->columnSpan(2)
                ->options(fn() => MaintenanceGroup::pluck('code', 'id'))
                // ->default(function (RelationManager $livewire) {

                //     return $livewire->getOwnerRecord()->assignedTo?->id;
                // })
                ->inline(),

            // // state
            // Forms\Components\ToggleButtons::make('state')
            //     ->label(__('tms-ui::tasks/task-item.form.fields.state'))
            //     ->columnSpan(2)
            //     ->options(fn() => [
            //         Created::$name => __('tms-ui::tasks/task-item.states.created'),
            //         InProgress::$name => __('tms-ui::tasks/task-item.states.in-progress'),
            //         Closed::$name => __('tms-ui::tasks/task-item.states.closed'),
            //     ])
            //     ->inline(),

            // // Forms\Components\TextInput::make('title')
            // //     ->columnSpan(3)
            // //     ->label(__('tms-ui::tasks/task-item.form.fields.title')),
            // Forms\Components\Textarea::make('description')
            //     ->label(__('tms-ui::tasks/task-item.form.fields.description'))
            //     ->columnSpanFull(),

            // supervised by

            // // activities 
            // Forms\Components\Tabs::make('all_tabs')
            //     ->columnSpan(4)
            //     ->tabs([
            //         // activities
            //         Forms\Components\Tabs\Tab::make('activities')
            //             ->label(__('tms-ui::tasks/task-item.form.tabs.activities'))
            //             ->badge(fn ($record) => $record->activities?->count() ?? 0)
            //             ->icon('heroicon-m-wrench')
            //             ->schema([
            //                 ActivityRepeater::make('activities')
            //                     ->label(__('tms-ui::tasks/task-item.form.fields.activities.title'))
            //                 // ->relationship('activities'),
            //             ]),
            //         // materials
            //         Forms\Components\Tabs\Tab::make('materials')
            //             ->label(__('tms-ui::tasks/task-item.form.tabs.materials'))
            //             ->icon('heroicon-m-rectangle-stack')
            //             ->badge(fn ($record) => $record->materials?->count() ?? 0)
            //             ->schema([
            //                 MaterialRepeater::make('materials')
            //                 // ->relationship('materials'),
            //             ]),
            //         // services
            //         Forms\Components\Tabs\Tab::make('services')
            //             ->label(__('tms-ui::tasks/task-item.form.tabs.services'))
            //             ->badge(0)
            //             ->icon('heroicon-m-user-group')
            //             ->schema([
            //                 ServiceRepeater::make('services')
            //                 // ->relationship('services'),
            //             ])
            //     ]),

            // history / commenTask
            // Forms\Components\Tabs::make('commenTask_tabs')
            //     ->columnSpan(3)
            //     ->tabs([
            //         // commenTask
            //         Forms\Components\Tabs\Tab::make('commenTask_tab')
            //             ->label(__('tms-ui::tasks/task-item.form.tabs.commenTask'))
            //             ->badge(3)
            //             ->icon('heroicon-m-wrench')
            //             ->schema([
            //                 TableRepeater::make('commenTask')
            //                     ->headers([
            //                         Header::make('created_at')->label(__('tms-ui::tasks/task-item.form.fields.activities.date')),
            //                         Header::make('author')->label(__('tms-ui::tasks/task-item.form.fields.activities.template')),
            //                         Header::make('body')->label(__('tms-ui::tasks/task-item.form.fields.activities.template')),
            //                     ])
            //                     ->schema([
            //                         Forms\Components\DateTimePicker::make('date1'),
            //                         Forms\Components\RichEditor::make('body')
            //                     ])
            //                     ->deletable(false)
            //                     // ->addable(false)
            //             ]),
            //         // history
            // Forms\Components\Tabs\Tab::make('history_tab')
            //     ->label(__('tms-ui::tasks/task-item.form.tabs.history'))
            //     ->icon('heroicon-m-rectangle-stack')
            //     ->badge(2)
            //     ->schema([
            //         TableRepeater::make('history')
            //             ->headers([
            //                 Header::make('date')->label(__('tms-ui::tasks/task-item.form.fields.activities.date')),
            //                 Header::make('template')->label(__('tms-ui::tasks/task-item.form.fields.activities.template')),
            //             ])
            //             ->schema([
            //                 Forms\Components\DatePicker::make('date'),
            //                 Forms\Components\TextInput::make('title')
            //             ])
            //             ->deletable(false)
            //             ->addable(false)
            //     ]),
            // ]),
        ];
    }
}
