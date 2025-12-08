<?php

namespace Dpb\Package\TaskMS\Filament\Resources\Fleet;

use Dpb\Package\TaskMS\Filament\Resources\Fleet\BrandResource\Forms\BrandForm;
use Dpb\Package\TaskMS\Filament\Resources\Fleet\BrandResource\Pages;
use Dpb\Package\TaskMS\Filament\Resources\Fleet\BrandResource\Tables\BrandTable;
use Dpb\Package\Fleet\Models\Brand;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::fleet/vehicle-brand.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::fleet/vehicle-brand.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::fleet/vehicle-brand.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::fleet/vehicle-brand.navigation.group');
    }

    public static function getNavigationSort(): ?int
    {
        return config('pkg-fleet.navigation.vehicle-brand') ?? 999;
    }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->can('fleet.vehicle-vehicle-brand.read');
    // }

    public static function form(Form $form): Form
    {
        return BrandForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return BrandTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
