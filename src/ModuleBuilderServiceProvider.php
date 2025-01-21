<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder;

use Abacus\ModuleBuilder\Communication\Commands\ControllerMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\CreateModule;
use Abacus\ModuleBuilder\Communication\Commands\Creator\AbstractCreatorMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\Creator\CreatorMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\Creator\InterfaceCreatorMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\DataCollectionMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\DataMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\Deleter\DeleterMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\Deleter\InterfaceDeleterMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\FacadeMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\ProviderMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\Saver\AbstractSaverMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\Saver\InterfaceSaverMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\Saver\SaverMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\Updater\AbstractUpdaterMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\Updater\InterfaceUpdaterMakeCommand;
use Abacus\ModuleBuilder\Communication\Commands\Updater\UpdaterMakeCommand;
use Illuminate\Support\ServiceProvider;

class ModuleBuilderServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AbstractSaverMakeCommand::class,
                AbstractCreatorMakeCommand::class,
                DataCollectionMakeCommand::class,
                AbstractUpdaterMakeCommand::class,
                InterfaceUpdaterMakeCommand::class,
                InterfaceSaverMakeCommand::class,
                InterfaceCreatorMakeCommand::class,
                InterfaceDeleterMakeCommand::class,
                CreatorMakeCommand::class,
                UpdaterMakeCommand::class,
                SaverMakeCommand::class,
                DeleterMakeCommand::class,
                ControllerMakeCommand::class,
                CreateModule::class,
                DataMakeCommand::class,
                FacadeMakeCommand::class,
                ProviderMakeCommand::class
            ]);
        }
    }
}
