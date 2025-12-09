<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Forms;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemGroupResource\Forms\TaskItemGroupPicker;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Components\MaterialRepeater;
use Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Components\ServiceRepeater;
use Dpb\Package\TaskMS\States\Task\TaskItem\Closed;
use Dpb\Package\TaskMS\States\Task\TaskItem\Created;
use Dpb\Package\TaskMS\States\Task\TaskItem\InProgress;
use Dpb\Package\Fleet\Models\MaintenanceGroup;
use Dpb\Package\Tasks\Models\TaskItemGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;

class TaskItemForm
{
    public static function make(Form $form): Form
    {
        return $form
            ->columns(7)
            ->schema(static::schema());
        // ->schema([

        //     Forms\Components\Section::make('TO DO')
        //         ->description('TODO: pripravujeme'),
        // ]);
    }

    public static function schema(): array
    {
        return [
            // date
            Forms\Components\DatePicker::make('date')
                ->label(__('tms-ui::tasks/task-item.form.fields.date'))
                ->columnSpan(1)
                ->default(now()),

            // title
            TaskItemGroupPicker::make('group_id')
                ->getOptionLabelFromRecordUsing(fn(TaskItemGroup $record) => "{$record->code} {$record->title}")
                ->columnSpan(2)
                ->options(fn() => TaskItemGroup::pluck('title', 'id'))
                ->live(),
            // Forms\Components\Select::make('group_id')
            //     ->label(__('tms-ui::tasks/task-item.form.fields.title'))
            //     // ->options(fn() => ActivityTemplateGroup::has('parent')->pluck('title', 'id'))
            //     ->searchable()
            //     ->preload()
            //     ->live(),

            // assigned to e.g. maintenance group
            Forms\Components\ToggleButtons::make('assigned_to')
                ->label(__('tms-ui::tasks/task-item.form.fields.assigned_to'))
                ->columnSpan(2)
                ->options(fn() => MaintenanceGroup::pluck('code', 'id'))
                ->default(function (RelationManager $livewire) {
                    return $livewire->getOwnerRecord()->assignedTo?->id;
                })
                ->inline(),

            // state
            Forms\Components\ToggleButtons::make('state')
                ->label(__('tms-ui::tasks/task-item.form.fields.state'))
                ->columnSpan(2)
                ->options(fn() => [
                    Created::$name => __('tms-ui::tasks/task-item.states.created'),
                    InProgress::$name => __('tms-ui::tasks/task-item.states.in-progress'),
                    Closed::$name => __('tms-ui::tasks/task-item.states.closed'),
                ])
                ->inline(),

            // Forms\Components\TextInput::make('title')
            //     ->columnSpan(3)
            //     ->label(__('tms-ui::tasks/task-item.form.fields.title')),
            Forms\Components\Textarea::make('description')
                ->label(__('tms-ui::tasks/task-item.form.fields.description'))
                ->columnSpanFull(),

            // supervised by

            // activities 
            // self::tabsSection()
            //     ->columnSpan(5),

            // // history / commenTask
            // self::historySection()
            //     ->columnSpan(2),
        ];
    }

    private static function tabsSection()
    {
        return Forms\Components\Tabs::make('all_tabs')
            ->tabs([
                // activities
                Forms\Components\Tabs\Tab::make('activities')
                    ->label(__('tms-ui::tasks/task-item.form.tabs.activities'))
                    // ->badge(fn ($record) => $record->activities?->count() ?? 0)
                    ->icon('heroicon-m-wrench')
                    ->schema([
                        Forms\Components\Section::make('TO DO')
                             ->description('TO DO: pripravujeme. Toto bude integrované s fondom pracovného času')
                        // ActivityRepeater::make('activities')
                        //     ->label(__('tms-ui::tasks/task-item.form.fields.activities.title'))
                        // ->relationship('activities'),
                    ]),
                // materials
                Forms\Components\Tabs\Tab::make('materials')
                    ->label(__('tms-ui::tasks/task-item.form.tabs.materials'))
                    ->icon('heroicon-m-rectangle-stack')
                    // ->badge(fn ($record) => $record->materials?->count() ?? 0)
                    ->schema([
                        Forms\Components\Section::make('TO DO')
                            ->description('TO DO: pripravujeme')
                            ->schema([
                                MaterialRepeater::make('materials')
                                // ->relationship('materials'),
                            ]),
                    ]),
                // services
                Forms\Components\Tabs\Tab::make('services')
                    ->label(__('tms-ui::tasks/task-item.form.tabs.services'))
                    ->badge(0)
                    ->icon('heroicon-m-user-group')
                    ->schema([
                        Forms\Components\Section::make('TO DO')
                            ->description('TO DO: pripravujeme')
                            ->schema([
                                ServiceRepeater::make('services')
                                // ->relationship('services'),
                            ]),
                    ])
            ]);
    }
    private static function historySection(): Forms\Components\Section
    {
        return Forms\Components\Section::make('TO DO')
            ->description('TO DO: pripravujeme. ')
            ->schema([
                Forms\Components\Tabs::make('commenTask_tabs')
                    ->tabs([
                        // commenTask
                        Forms\Components\Tabs\Tab::make('commenTask_tab')
                            ->label(__('tms-ui::tasks/task-item.form.tabs.comments'))
                            ->badge(3)
                            ->icon('heroicon-m-wrench')
                            ->schema([
                                Forms\Components\TextInput::make('h1')->readOnly()->placeholder('...')->hiddenLabel(),
                                Forms\Components\TextInput::make('h2')->readOnly()->placeholder('...')->hiddenLabel(),
                                Forms\Components\RichEditor::make('body')->disabled()->hiddenLabel(),
                                // ->addable(false)
                            ]),
                        // history
                        Forms\Components\Tabs\Tab::make('history_tab')
                            ->label(__('tms-ui::tasks/task-item.form.tabs.history'))
                            ->icon('heroicon-m-rectangle-stack')
                            ->badge(2)
                            ->schema([
                                Forms\Components\TextInput::make('h1')->readOnly()->placeholder('...')->hiddenLabel(),
                                Forms\Components\TextInput::make('h2')->readOnly()->placeholder('...')->hiddenLabel(),
                                Forms\Components\TextInput::make('h3')->readOnly()->placeholder('...')->hiddenLabel(),
                            ]),
                    ]),
            ]);
    }
}
