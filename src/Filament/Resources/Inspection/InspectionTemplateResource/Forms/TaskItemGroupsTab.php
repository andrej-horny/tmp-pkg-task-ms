<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionTemplateResource\Forms;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\Vehicle\BrandResource\Forms\BrandPicker;
use Dpb\Package\TaskMS\Filament\Resources\Fleet\Vehicle\VehicleTypeResource\Forms\VehicleTypePicker;
use Dpb\Package\Activities\Models\ActivityTemplate;
use Dpb\Package\Activities\Models\TemplateGroup as ActivityTemplateGroup;
use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\Fleet\Models\VehicleModel;
use Dpb\Package\tasks\Models\taskItemGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;

class TaskItemGroupsTab
{
    public static function make(): array
    {
        return [
            Forms\Components\Section::make()
                // @todo
                ->description('zoznam typov podzákazok / normočinností alebo niečoho, čo sa viaže k danej kontrole, takže keď sa vytorí zákazka z kontroly, tak by sa automaticky mohli založiť príslušné podzákazky')
                ->schema([
                    Forms\Components\ToggleButtons::make('main_task_item_groups')
                        ->label(__('tms-ui::inspections/inspection-template.form.fields.task_item_groups'))
                        ->options(function () {
                            return ActivityTemplateGroup::whereNull('parent_id')
                                ->get()
                                ->mapWithKeys(fn($taskItemGroup) => [
                                    $taskItemGroup->id => $taskItemGroup->title
                                ]);
                        })
                        // ->inline()
                        ->live()
                        ->columns(4),
                    //
                    Forms\Components\CheckboxList::make('task_item_groups')
                        ->label(__('tms-ui::inspections/inspection-template.form.fields.task_item_groups'))
                        ->options(function (Get $get) {
                            // return taskItemGroup::get()
                            $templateGroupId = $get('main_task_item_groups');
                            if ($templateGroupId === null) {
                                return [];
                            }

                            return ActivityTemplate::byTemplateGroupId($templateGroupId)
                                ->get()
                                ->mapWithKeys(fn($taskItemGroup) => [
                                    $taskItemGroup->id => $taskItemGroup->title
                                ]);
                        })
                        ->searchable()
                        ->bulkToggleable(true)
                        ->columnSpanFull()
                        ->columns(6)
                ]),
        ];
    }
}
