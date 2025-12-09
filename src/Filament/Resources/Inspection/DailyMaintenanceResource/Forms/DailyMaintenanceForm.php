<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Inspection\DailyMaintenanceResource\Forms;

use App\Models\Datahub\Filament\Components\DepartmentPicker;
use App\Models\Datahub\Models\Datahub\Department;
use App\Models\Datahub\EmployeeContract;
use Dpb\Package\TaskMS\Services\Inspection\TemplateAssignmentService;
use Carbon\Carbon;
use Dpb\Package\Activities\Models\ActivityTemplate;
use Dpb\Package\Fleet\Models\MaintenanceGroup;
use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\Inspections\Models\InspectionTemplate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Illuminate\Support\Collection;

class DailyMaintenanceForm
{
    public static function make(Form $form): Form
    {
        return $form
            ->columns(9)
            ->schema(self::schema());
    }

    public static function schema(): array
    {
        return [
            // date
            Forms\Components\DatePicker::make('date')
                ->label(__('tms-ui::inspections/daily-maintenance.form.fields.date'))
                ->default(Carbon::now())
                ->columnSpan(2),
            // inspection template
            Forms\Components\ToggleButtons::make('inspection-template')
                ->label(__('tms-ui::inspections/daily-maintenance.form.fields.template'))
                ->inline()
                ->options(
                    fn() =>
                    InspectionTemplate::byGroup('daily-maintenance')
                        // InspectionTemplate::whereIn('title', [
                        //     'Odstavná plocha',
                        //     'Pristavovanie vozidla',
                        //     'Programovanie',
                        //     'Strojové čistenie vozidla',
                        // ])
                        ->pluck('title', 'id')
                )
                ->live()
                ->columnSpan(7),

            // maintenance group
            self::maintenanceGroupField()
                ->columnSpanFull(),

            Forms\Components\Group::make([
                // vehicles
                self::vehicelsSection()
                    ->columnSpan(9),

                // // contracts
                // self::contractsSection()
                //     ->columnSpan(2),

                // // activites
                // self::activitiesSection()
                //     ->columnSpan(2),
            ])
                ->columns(9)
                ->columnSpanFull()
        ];
    }

    private static function vehicelsSection()
    {
        return Forms\Components\Section::make()
            ->schema([
                Forms\Components\CheckboxList::make('vehicles')
                    ->label(__('tms-ui::inspections/daily-maintenance.form.fields.vehicles'))
                    ->options(function (Get $get) {
                        $mgId = $get('assigned_to_id');

                        if ($mgId !== null) {
                            return Vehicle::with(['codes', 'model'])
                                // ->when(!auth()->user()->hasRole('super-admin'), function ($q) {
                                //     $userHandledVehicleTypes = auth()->user()->vehicleTypes();
                                //     $q->byType($userHandledVehicleTypes);
                                // })
                                ->whereNotNull('maintenance_group_id')
                                ->byMaintenanceGroupId($mgId)
                                ->get()
                                ->mapWithKeys(function ($vehicle) {
                                    return [
                                        $vehicle->id => $vehicle->code?->code
                                    ];
                                });
                        }

                        return [];
                    })
                    ->searchable()
                    ->bulkToggleable()
                    ->columns(10)
                // ->columnSpan(2),
            ]);
    }

    private static function contractsSection()
    {
        return Forms\Components\Section::make()
            ->schema([
                Forms\Components\CheckboxList::make('contracts')
                    ->label(__('tms-ui::inspections/daily-maintenance.form.fields.contracts'))
                    ->options(fn(): Collection => EmployeeContract::workers()->byDepartment('2516')->pluck('pid', 'id'))
                    ->searchable()
                    ->bulkToggleable()
                    ->columns(3)
            ]);
    }

    private static function activitiesSection()
    {
        return Forms\Components\Section::make()
            ->schema([
                Forms\Components\CheckboxList::make('activity-templates')
                    ->label(__('tms-ui::inspections/daily-maintenance.form.fields.activity-templates'))
                    ->options(function (Get $get, TemplateAssignmentService $tplAssignmentSvc, InspectionTemplate $inspectionTemplate, ActivityTemplate $activityTemplate): Collection {
                        // dd($activityTemplate->getMorphClass());
                        if ($get('inspection-template') == null) {
                            return collect([]);
                        }
                        return $tplAssignmentSvc
                            ->getSubjectsByTemplate(
                                // $inspectionTemplate->where('title', '=', 'Strojové čistenie vozidla')->first(),
                                $inspectionTemplate->find($get('inspection-template')),
                                [$activityTemplate->getMorphClass()]
                            )
                            ->pluck('title', 'id');
                    })
                    ->searchable()
                    ->bulkToggleable()
                    ->columns(1)
            ]);
    }

    private static function maintenanceGroupField()
    {
        return Forms\Components\ToggleButtons::make('assigned_to_id')
            ->label(__('tickets/ticket.form.fields.assigned_to'))
            ->options(
                fn() =>
                MaintenanceGroup::when(!auth()->user()->hasRole('super-admin'), function ($q) {
                    $userHandledVehicleTypes = auth()->user()->vehicleTypes();
                    $q->byVehicleType($userHandledVehicleTypes);
                })
                    ->pluck('code', 'id')
            )
            ->dehydrated()
            ->live()
            ->inline();
    }
}
