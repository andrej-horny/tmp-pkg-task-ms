<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionAssignmentResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Inspection\InspectionAssignmentResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class ListInspectionAssignments extends ListRecords
{
    protected static string $resource = InspectionAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make()
            // ->using(fn () => dd('gg')),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return '';
    } 

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('all'),
            'daily-maintenance' => Tab::make('DO')
                ->modifyQueryUsing(
                    fn(Builder $query) => $query->whereHas('inspection', function ($q) {
                        $q->byTemplateGroup('daily-maintenance');
                    })
                ),
            'planned-maintenance' => Tab::make('STK / EK / RK')
                ->modifyQueryUsing(
                    fn(Builder $query) => $query->whereHas('inspection', function ($q) {
                        $q->byTemplateGroup('planned-maintenance');
                    })
                ),
            // 'ek' => Tab::make('EK')
            //     ->modifyQueryUsing(
            //         fn(Builder $query) => $query->whereHas('inspection', function ($q) {
            //             $q->byTemplateGroup('ek');
            //         })
            //     ),
        ];
    }
}
