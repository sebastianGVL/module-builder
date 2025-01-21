<?php

declare(strict_types=1);


namespace Abacus\ModuleBuilder\Business\Services;

use Abacus\ModuleBuilder\Business\Handlers\Layer\BusinessHandler;
use Abacus\ModuleBuilder\Business\Module;
use Illuminate\Console\Command;


class CreateModuleCommandService
{
    public function setHandlers(bool $translated, string $moduleName, Command $moduleCommand): void
    {
        $module = new Module();
        $module->setName($moduleName);
        $module->setTranslated($translated);

        (new BusinessHandler($moduleCommand))->handle($module);
    }
}
