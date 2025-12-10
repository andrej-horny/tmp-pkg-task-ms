<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\DailyExpeditionResource\Forms\DailyExpeditionForm;
use Dpb\Package\TaskMS\Filament\Resources\Fleet\DailyExpeditionResource\Pages;
use Dpb\Package\TaskMS\Filament\Resources\Fleet\DailyExpeditionResource\Tables\DailyExpeditionTable;
use Dpb\Package\Fleet\Models\DailyExpedition;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class DailyExpeditionResource extends Resource
{
    protected static ?string $model = DailyExpedition::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::fleet/daily-expedition.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::fleet/daily-expedition.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::fleet/daily-expedition.navigation.label');
    }

    // public static function getNavigationGroup(): ?string
    // {
    //     return __('tms-ui::fleet/daily-expedition.navigation.group');
    // }
    
    public static function form(Form $form): Form
    {
        return DailyExpeditionForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return DailyExpeditionTable::make($table) ;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDailyExpeditions::route('/'),
            'custom-index' => Pages\CustomListDailyExpeditions::route('/custom-index'),
            // 'create' => Pages\CreateDailyExpedition::route('/create'),
            'bulk-create' => Pages\BulkCreateDailyExpedition::route('/bulk-create'),
            'bulk-create-2' => Pages\BulkCreateDailyExpedition2::route('/bulk-create-2'),
            'edit' => Pages\EditDailyExpedition::route('/{record}/edit'),
        ];
    }
}
