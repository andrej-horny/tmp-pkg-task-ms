<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet\DailyExpeditionResource\Pages;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\DailyExpeditionResource;
use Dpb\Package\TaskMS\Filament\Resources\Fleet\DailyExpeditionResource\Forms\DailyExpeditionForm;
use Dpb\Package\TaskMS\Services\DailyExpeditionRepository;
use Filament\Actions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
// use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class BulkCreateDailyExpedition extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static string $resource = DailyExpeditionResource::class;
    protected static string $view = 'tms-ui::filament/forms/fleet/daily-expedition.bulk-create';
    // public static function route(string $path): string
    // {
    //     return static::$resource::getSlug() . $path;
    // }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::fleet/daily-expedition.create_heading');
    } 

    public function mount()
    {
        $this->form->fill([
            'vehicles' => DailyExpeditionForm::defaultVehicles(),
            'date' => now()->toDateString(),
        ]);
    }

    public function form(Form $form): Form
    {
        return DailyExpeditionForm::make($form)        
            ->statePath('data');;
    }

    public function create(): void
    {
        $data = $this->form->getState();

        app(DailyExpeditionRepository::class)->bulkCreate($data);

        // Notification::make()
        //     ->success()
        //     ->title('Created!')
        //     ->body('Daily expeditions created.')
        //     ->send();

        $this->redirect(DailyExpeditionResource::getUrl('index'));
    }
}
