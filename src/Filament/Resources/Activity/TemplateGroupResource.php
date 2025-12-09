<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Activity;

use Dpb\Package\TaskMS\Filament\Resources\Activity\TemplateGroupResource\Forms\ActivityTemplateGroupForm;
use Dpb\Package\TaskMS\Filament\Resources\Activity\TemplateGroupResource\Tables\ActivityTemplateGroupTable;
use Dpb\Package\TaskMS\Filament\Resources\Activity\TemplateGroupResource\Pages;
use Dpb\Package\Activities\Models\TemplateGroup;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class TemplateGroupResource extends Resource
{
    protected static ?string $model = TemplateGroup::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::activities/activity-template-group.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::activities/activity-template-group.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::activities/activity-template-group.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::activities/activity-template-group.navigation.group');
    }

    public static function form(Form $form): Form
    {
        return ActivityTemplateGroupForm::make($form);
    }

    public static function getNavigationSort(): ?int
    {
        return config('pkg-activities.navigation.template-group') ?? 999;
    }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->can('activities.activity-template-group.read');
    // }

    public static function table(Table $table): Table
    {
        return ActivityTemplateGroupTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTemplateGroups::route('/'),
            'create' => Pages\CreateTemplateGroup::route('/create'),
            'edit' => Pages\EditTemplateGroup::route('/{record}/edit'),
        ];
    }
}
