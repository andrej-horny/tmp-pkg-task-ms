<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\DailyExpeditionResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\DailyExpeditionResource;
use Dpb\Package\TaskMS\Filament\Resources\Fleet\DailyExpeditionResource\Forms\DailyExpeditionForm;
use Dpb\Package\TaskMS\Models\DailyExpedition;
use Dpb\Package\TaskMS\Services\DailyExpeditionRepository;
use Filament\Actions;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Model;

class CustomListDailyExpeditions extends Page
{

    public ?array $data = [];

    protected static string $resource = DailyExpeditionResource::class;
    protected static string $view = 'filament.resources.tms-ui::fleet/daily-expedition.custom-index';

    public $dailyExpeditions;
    public ?string $filterDate = null;

    // public getTitle

    public function mount(): void
    {
        $this->filterDate = now()->toDateString(); // default today
        $this->loadFilteredData();
    }

    public function updatedFilterDate()
    {
        $this->loadFilteredData();
        print_r($this->filterDate);
    }

    public function loadFilteredData()
    {
        print_r($this->filterDate);
        $this->dailyExpeditions = app(DailyExpedition::class)
            ->with(['vehicle.model', 'vehicle.codes'])
            ->where('date', '=', $this->filterDate)
            ->get()
            ->groupBy('vehicle.model.title')
            ->toArray();
    }
}
