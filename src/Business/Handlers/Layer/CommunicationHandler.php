<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Business\Handlers\Layer;

use Abacus\ModuleBuilder\Business\Contracts\ModuleInterface;
use Abacus\ModuleBuilder\Business\Handlers\AbstractHandler;
use Abacus\ModuleBuilder\Business\Services\CommunicationService;

class CommunicationHandler extends AbstractHandler
{
    protected function process(ModuleInterface $module): ModuleInterface
    {
        if (!$this->getSuccessor()) {
            $this->setSuccessor(new PersistenceHandler($this->command));
        }

        $this->createModule($module);

        return $module;
    }

    private function createModule(ModuleInterface $module): void
    {
        $service = new CommunicationService();

        $service->createController($this->command,$module);
        $service->createRequest($this->command,$module);
    }
}
