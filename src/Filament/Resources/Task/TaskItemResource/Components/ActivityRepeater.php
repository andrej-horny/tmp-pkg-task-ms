<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskItemResource\Components;

use Dpb\Package\TaskMS\Filament\Components\ActivityTemplatePicker;
use Dpb\Package\TaskMS\Filament\Resources\Activity\ActivityTemplateGroupResource\Forms\ActivityTemplateGroupForm;
use Dpb\Package\TaskMS\Services\Task\ActivityService;
use Awcodes\TableRepeater\ComponenTask\TableRepeater;
use Awcodes\TableRepeater\Header;
use Dpb\Package\Activities\Models\ActivityTemplate;
use Dpb\Package\Activities\Models\TemplateGroup as ActivityTemplateGroup;
use Filament\Forms\Components\Component;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Set;

class ActivityRepeater
{
    public static function make(string $uri): Component
    {
        return  Forms\Components\Section::make('TO DO')
        ->description('TO DO: toto bude prepojene s fondom prac casu')
            ->schema([]);
    }

    // public static function make1(string $uri): Component
    // {
    //     return TableRepeater::make($uri)
    //         ->defaultItems(0)
    //         ->cloneable()
    //         ->columnSpan(5)
    //         ->headers([
    //             Header::make('date')->label(__('tms-ui::tasks/task-item.form.fields.activities.date')),
    //             Header::make('template')->label(__('tms-ui::tasks/task-item.form.fields.activities.template')),
    //             // Header::make('pracovne vykony'),
    //             // Header::make('e1'),
    //             // Header::make('e2'),
    //         ])
    //         ->schema([
    //             Forms\Components\DatePicker::make('date')
    //                 ->default(now()),
    //             Forms\Components\Select::make('activity_template_id')
    //                 ->label(__('tms-ui::tasks/task-item.form.fields.title'))
    //                 ->columnSpan(5)
    //                 ->options(
    //                     fn(Get $get) => ActivityTemplate::where('template_group_id', $get('../activity_template_group_id'))
    //                         ->pluck('title', 'id')
    //                 )
    //                 ->searchable(),
    //             // ActivityTemplatePicker::make('activity_template_id')
    //             //     // ->relationship('template', 'title')
    //             //     ->getOptionLabelFromRecordUsing(null)
    //             //     ->geTaskearchResulTaskUsing(null)
    //             //     ->live()
    //             //     ->afterStateUpdated(function (Set $set, Get $get) {
    //             //         $template = ActivityTemplate::find($get('activity_template_id'));
    //             //         $set('template_duration', $template?->duration);
    //             //     })
    //             //     ->searchable(),
    //             // Forms\Components\TextInput::make('template_duration')                    
    //             //     ->readOnly()
    //             //     ->dehydrated(),
    //             // WorkAssignmentRepeater::make('workAssignmenTask')
    //             //     // ->relationship('workAssignmenTask')
    //             //     ->columnSpan(5)
    //         ])
    //         // ->(function($record, ActivityService $svc) {
    //         //     return $svc->getActivities($record);  
    //         // })
    //         ->default([]);
    // }
}
