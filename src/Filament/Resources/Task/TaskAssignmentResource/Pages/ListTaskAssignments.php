<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Task\TaskAssignmentResource;
use Dpb\Package\TaskMS\Services\Task\CreateTickeTaskervice;
use Dpb\Package\Tasks\Models\Task;
use Dpb\Package\Tasks\Models\TaskGroup;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class ListTaskAssignments extends ListRecords
{
    protected static string $resource = TaskAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make()
            //     ->modalWidth(MaxWidth::MaxContent) // options: sm, md, lg, xl, 2xl
            //     // ->using(function (array $data, string $model, SubjecTaskervice $tasksubjecTaskvc, HeaderService $taskHeaderService): ?Model {
            //     // ->using(function (array $data, string $model, CreateTickeTaskervice $tasksvc): ?Model {
            //     //     dd('hh');
            //     //     return $tasksvc->create($data);
            //     // })

            //     ->using(function (array $data, TaskAssignmentRepository $taskAssignmentRepository): ?Model {
            //         // dd('hh');
            //         return $taskAssignmentRepository->create($data);
            //     })
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return '';
    }    

    public function getTabs(): array
    {
        $tabs = [];

        // Default “all” tab
        $tabs['all'] = Tab::make('Všetky');

        // Dynamic tabs
        foreach (TaskGroup::get() as $group) {
            $tabs[$group->code] = Tab::make($group->title)
                ->modifyQueryUsing(
                    function(Builder $query) use ($group) {
                        $query->whereHas('task', function($q) use ($group) {
                            $q->byGroup($group->code);
                        });
                        // return Task::query()->merge($query)->byGroup($group->code);
                    }
                );
        }

        return $tabs;
    }
}
