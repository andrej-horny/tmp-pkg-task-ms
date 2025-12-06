<?php

namespace Dpb\Package\TaskMS\Providers;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TaskMSServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('pkg-task-ms')
            ->hasConfigFile()
            ->hasMigrations([
                '0001_create_tms_expenses_tables',
                // '0002_create_tms_unit_rates_table',
                '0003_create_tms_activity_assignments_table',
                // '0004_create_tms_work_assignments_table',
                '0006_create_tms_department_assignments_table',
                '0007_create_tms_inspection_assignments_table',
                '0009_create_tms_ticket_assignments_table',
                '0010_create_tms_dispatch_reports_table',
                '0011_create_tms_incident_assignments_table',
                '0012_create_tms_activity_templatables_table',
                '0013_create_tms_ticket_item_assignments_table',
                '0014_create_tms_daily_expeditions_table',
                '0016_create_tms_vehicle_status_report_view',
            ])
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->startWith(function(InstallCommand $command) {
                        $command->info('Installing pkg-tasks...');
                        $command->call('pkg-tasks:install');
                        $command->info('Installing pkg-tickets...');
                        $command->call('pkg-tickets:install');
                        $command->info('Installing pkg-inspections...');
                        $command->call('pkg-inspections:install');
                        $command->info('Installing pkg-activities...');
                        $command->call('pkg-activities:install');
                        $command->info('Installing pkg-fleet...');
                        $command->call('pkg-fleet:install');
                    })
                    ->publishMigrations()
                    ->publishConfigFile()
                    ->askToRunMigrations();
            });
    }
}
