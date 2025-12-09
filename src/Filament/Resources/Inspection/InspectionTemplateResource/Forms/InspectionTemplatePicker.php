<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionTemplateResource\Forms;

use Filament\Forms;

class InspectionTemplatePicker
{
    public static function make(string $uri)
    {
        return Forms\Components\Select::make($uri)
            ->label(__('tms-ui::inspections/inspection-template.components.picker.label'))
            ->searchable()
            ->preload()
            ->createOptionForm(InspectionTemplateForm::schema())            
            ->createOptionModalHeading(__('tms-ui::inspections/inspection-template.components.picker.create_heading'))
            ->editOptionForm(InspectionTemplateForm::schema())
            ->editOptionModalHeading(__('tms-ui::inspections/inspection-template.components.picker.update_heading'));
    }
}
