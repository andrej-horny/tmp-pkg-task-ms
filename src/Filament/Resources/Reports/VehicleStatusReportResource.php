<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Reports;

use Dpb\Package\TaskMS\Filament\Resources\Reports\VehicleStatusReportResource\Pages;
use Dpb\Package\TaskMS\Filament\Resources\Reports\VehicleStatusReportResource\Tables\DailyExpeditionStatusReportTable;
use Dpb\Package\TaskMS\Filament\Resources\Reports\VehicleStatusReportResource\Tables\VehicleStatusReportTable;
use Dpb\Package\TaskMS\Models\DailyExpedition;
use Dpb\Package\TaskMS\Models\ReadOnly\Reports\VehicleStatusReport;
// use Dpb\Package\TaskMS\Models\Reports\VehicleStatusReport;
use Dpb\Package\Fleet\Models\Vehicle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VehicleStatusReportResource extends Resource
{
    // protected static ?string $model = Vehicle::class;
    // protected static ?string $model = DailyExpedition::class;
    protected static ?string $model = VehicleStatusReport::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::reports/vehicle-status-report.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::reports/vehicle-status-report.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::reports/vehicle-status-report.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::reports/vehicle-status-report.navigation.group');
    }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->can('reports.vehicle-status-reports');
    // }

    public static function table(Table $table): Table
    {
        // return DailyExpeditionStatusReportTable::make($table) ;
        return VehicleStatusReportTable::make($table) ;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicleStatusReports::route('/'),
            // 'index' => Pages\ListVehicleStatusReportsPage::route('/'),
            // 'create' => Pages\CreateVehicleStatusReport::route('/create'),
            // 'edit' => Pages\EditVehicleStatusReport::route('/{record}/edit'),
        ];
    }

    // public static function getEloquentQuery(): Builder
    // {
        // return parent::getEloquentQuery()
        // ->when(!auth()->user()->hasRole('super-admin'), function($q) {
        //         $userHandledVehicleTypes = auth()->user()->vehicleTypes();
        //         $q->byType($userHandledVehicleTypes);
        //     });
        // return parent::getEloquentQuery()
        // ->whereHas('vehicle', function($q) {
        //     $q->byMa
        // })
    // }        
}
