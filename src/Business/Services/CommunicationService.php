<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Business\Services;

use Abacus\ModuleBuilder\Business\Contracts\ModuleInterface;
use Illuminate\Console\Command;

class CommunicationService
{
    private const COMMUNICATION_PATH_ROOT = 'App\\Communication\\%s\\';

    public function createController(Command $command, ModuleInterface $module): void
    {
        $command->call(
            'abacus:make:controller',
            ['name' => $this->getBasePath($module) . 'Controllers\\' . $module->getName()]
        );
    }

    public function createRequest(Command $command, ModuleInterface $module): void
    {
        $command->call(
            'make:request',
            ['name' => $this->getBasePath($module) . 'Requests\\' . $module->getName() . 'Request']
        );
    }


    private function getBasePath(ModuleInterface $module): string
    {
        return sprintf(self::COMMUNICATION_PATH_ROOT, $module->getName());
    }
}
