<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Inspection;

use Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionAssignmentResource\Forms\InspectionAssignmentFrom;
use Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionAssignmentResource\Pages;
use Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionAssignmentResource\Tables\InspectionAssignmentTable;
use Dpb\Package\TaskMS\Models\InspectionAssignment;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class InspectionAssignmentResource extends Resource
{
    protected static ?string $model = InspectionAssignment::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::inspections/inspection.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::inspections/inspection.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::inspections/inspection.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::inspections/inspection.navigation.group');
    }

    public static function getNavigationSort(): ?int
    {
        return config('pkg-inspections.navigation.inspection') ?? 999;
    }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->can('inspections.inspection.read');
    // }

    public static function form(Form $form): Form
    {
        return InspectionAssignmentFrom::make($form);
    }

    public static function table(Table $table): Table
    {
        return InspectionAssignmentTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInspectionAssignments::route('/'),
            'create' => Pages\CreateInspectionAssignment::route('/create'),
            'edit' => Pages\EditInspectionAssignment::route('/{record}/edit'),
        ];
    }

    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()
    //         // ->byVehicleType('A');
    //         ->byMaintenanceGroup('1TPA');
    // }
}
