<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Business\Handlers\Layer;

use Abacus\ModuleBuilder\Business\Contracts\ModuleInterface;
use Abacus\ModuleBuilder\Business\Handlers\AbstractHandler;
use Abacus\ModuleBuilder\Business\Services\BusinessService;

class BusinessHandler extends AbstractHandler
{
    protected function process(ModuleInterface $module): ModuleInterface
    {
        if (!$this->getSuccessor()) {
            $this->setSuccessor(new CommunicationHandler($this->command));
        }

        $this->createModule($module);

        return $module;
    }


    private function createModule(ModuleInterface $module): void
    {
        $service = new BusinessService();

        $service->createProvider($this->command, $module);
        $service->createData($this->command, $module);
        $service->createCreator($this->command, $module);
        $service->createFacade($this->command, $module);
    }
}

