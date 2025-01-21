<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Business\Handlers\Layer;

use Abacus\ModuleBuilder\Business\Contracts\ModuleInterface;
use Abacus\ModuleBuilder\Business\Handlers\AbstractHandler;
use Abacus\ModuleBuilder\Business\Services\PersistenceService;

class PersistenceHandler extends AbstractHandler
{
    protected function process(ModuleInterface $module): ModuleInterface
    {
        $this->createModule($module);

        return $module;
    }

    private function createModule(ModuleInterface $module): void
    {
        $service = new PersistenceService();

        $service->createModel($this->command, $module);
        $service->createMigration($this->command, $module);
        $service->createSaver($this->command, $module);
        $service->createUpdater($this->command, $module);
        $service->createDeleter($this->command, $module);
    }
}
