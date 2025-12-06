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
                // '0001_create_tasks_tables',
                // '0002_create_task_places_of_origin_table',
                // '0003_create_task_items_table',
                // '0004_create_task_item_groups_table',
                // '0005_add_task_items_code'
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
                    })                
                    ->publishMigrations()
                    ->publishConfigFile()
                    ->askToRunMigrations();
            });
    }    
}
