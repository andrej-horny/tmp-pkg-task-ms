<?php

namespace Dpb\Package\TaskMS\Providers;

use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Enums\MaxWidth;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

// resources
use Dpb\Package\TaskMS\Filament\Resources;

class TaskMSFilamentPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        // dd('gg');
        return $panel
            ->id('tms')                     // required
            ->path('tms')                   // URL path
            ->maxContentWidth(MaxWidth::Full)
            ->breadcrumbs(false)
            ->topNavigation()
            ->resources([
                // activities
                // Resources\Activity\ActivityResource::class,
                // Resources\Activity\ActivityTemplateResource::class,
                // Resources\Activity\TemplateGroupResource::class,
                // // tasks
                Resources\Task\TaskGroupResource::class,
                Resources\Task\TaskItemGroupResource::class,
                Resources\Task\TaskAssignmentResource::class,
                Resources\Task\PlaceOfOriginResource::class,
                // tickets
                Resources\Ticket\TicketAssignmentResource::class,
                Resources\Ticket\TicketTypeResource::class,
                // inspections
                // Resources\Inspection\InspectionResource::class,
                // Resources\Inspection\InspectionTemplateGroupResource::class,
                // Resources\Inspection\InspectionTemplateResource::class,
                // Resources\Inspection\UpcomingInspectionResource::class,
                // // fleet
                Resources\Fleet\MaintenanceGroupResource::class,
                Resources\Fleet\VehicleResource::class,
                Resources\Fleet\BrandResource::class,
                Resources\Fleet\VehicleGroupResource::class,
                Resources\Fleet\VehicleModelResource::class,
                Resources\Fleet\VehicleTypeResource::class,

            ])
            // ->discoverResources(in: 'Dpb/Package/TaskMSFilament/Resources', for: 'Dpb\\Package\\TaskMSFilament\\Filament\\Resources')
            // ->discoverPages(in: app_path('Filament/Fleet/Pages'), for: 'App\\Filament\\Fleet\\Pages')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);            
        
    }

}